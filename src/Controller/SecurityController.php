<?php

namespace App\Controller;


use App\Entity\Users;
use App\Form\InscriptionType;
use App\Form\ResetPassType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_inscription")
     */
    public function inscription(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new Users();

        // utilisation du formulaire inscriptionType pour récupérer les info et les rentrer dans User
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        // si le formulaire est soumis et valid alors
        if ($form->isSubmitted() && $form->isValid()) {
            // on hash le password
            $hash = $encoder->encodePassword($user, $user->getPassword());

            // et on modifie le password avec le hash
            $user->setPassword($hash);

            // puis on fait persister en bdd
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/home", name="security_login")
     */
    public function login()
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword()

    {
        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @var string le token qui servira lors de l'oubli de mot de passe
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resetToken;

    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    /**
     * @param string $resetToken
     */
    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }

    /**
     * @Route("/oubli-pass", name="app_forgotten_password")
     */
    public function oubliPass(Request $request, UsersRepository $users, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        // On initialise le formulaire
        $form = $this->createForm(ResetPassType::class);
        // On traite le formulaire
        $form->handleRequest($request);
        // Si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid())
        {
            // On récupère les données
            $donnees = $form->getData();
            // On cherche un utilisateur ayant cet e-mail
            $user = $users->findOneByEmail($donnees['email']);
            // Si l'utilisateur n'existe pas
            if($user === null)
            {
                // On envoie une alerte disant que l'adresse e-mail est inconnue
                $this->addFlash('danger', 'Cette adresse e-mail est inconnue');
                // On retourne sur le page de connexion
                return $this->redirectToRoute('home');
            }
            // On génère un token
            $token = $tokenGenerator->generateToken();
            // On essaie d'écrire le token en base de données
            try
            {
                $user->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            } catch(\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }
            // On génère l'URL de réinitialisation de mot de passe
            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
            // On génère l'e-mail
            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('votre@adresse.fr')
                ->setTo($user->getEmail())
                ->setBody(
                    "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le site Walking-Dog.com. Veuillez cliquez sur le lien suivant : " . $url,'text/html'
                );
            // On envoie l'e-mail
            $mailer->send($message);
            // On crée le message flash de confirmation 
            $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');
            // On redirige vers la page de login
            return $this->redirectToRoute('home');
        }
        // On envoie le formulaire à la vue
        return $this->render('security/forgotten_password.html.twig', ['emailForm' => $form->createView()]);
    }

    /**
    * @Route("/reset_pass/{token}", name="app_reset_password")
    */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        // On cherche un utilisateur avec le token donné
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['reset_token' => $token]);
        // Si l'utilisateur n'existe pas
        if ($user === null)
        {
            // On affiche une erreur
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('home');
        }
        // Si le formulaire est envoyé en méthode post
        if ($request->isMethod('POST'))
        {
            // On supprime le token
            $user->setResetToken(null);
            // On chiffre le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            // On stocke
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            //On crée le message flash
            $this->addFlash('message', 'Mot de passe mis à jour');
            // On redirige vers la page de connexion
            return $this->redirectToRoute('home');
        }else{
            // Si on n'a pas reçu les données, on affiche le formulaire
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }
}
