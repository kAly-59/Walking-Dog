<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Entity\Hotel;
use App\Entity\Restaurant;
use App\Entity\Users;
use App\Entity\Veterinaire;
use App\Form\EditUserType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(UsersRepository $users)
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        $campings = $this->getDoctrine()->getRepository(Camping::class)->findAll();
        $veterinaires = $this->getDoctrine()->getRepository(Veterinaire::class)->findAll();

        return $this->render('admin/users.html.twig', [
            'users' => $users->findAll(),
            'hotels' => $hotels,
            'restaurants' => $restaurants,
            'campings' => $campings,
            'veterinaires' => $veterinaires,
        ]);
    }

    /**
     * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser(Users $user, Request $request)
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('home');
        }
        return $this->render('admin/edituser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

}
