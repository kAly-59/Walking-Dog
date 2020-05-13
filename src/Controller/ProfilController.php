<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Entity\Users;
use App\Entity\Hotel;
use App\Entity\Restaurant;
use App\Entity\Veterinaire;
use App\Form\AccountType;
use App\Form\EditHotelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil", name="profil_")
 */
class ProfilController extends AbstractController
{

    /**
     * @Route("/delete/{id}", name="delete_user") 
     */
    public function ProfilDelete(Users $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $session = new Session();
        $session->invalidate();
        return $this->redirectToRoute('security_logout');
    }

    /**
     * @Route("/", name="affichage")
     */
    public function affichage(Request $request, EntityManagerInterface $manager)
    {
        
        $user = $this->getUser();
        $idUser = $this->getUser()->getId();
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findBy(array('users' => $idUser));
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findBy(array('users' => $idUser));
        $campings = $this->getDoctrine()->getRepository(Camping::class)->findBy(array('users' => $idUser));
        $veterinaires = $this->getDoctrine()->getRepository(Veterinaire::class)->findBy(array('users' => $idUser));
        $formImage = $this->createForm(AccountType::class);


        $formImage->handleRequest($request);
        if ($formImage->isSubmitted() && $formImage->isValid())
        {
            $image = $user->getImage();
                if (is_null($image)) {
                    $file = $user->getImage();
                } else {
                    $file = $formImage->get('image')->getData();
                    $filename = md5(uniqid()) . "." .$file->guessExtension();
                    $file->move($this->getParameter('brochures_directory'), $filename);
                    $user->setImage($filename);
                }
                if (!is_null($image)) {
                    $file = $user->getImage();
                } else {
                    $file = $formImage->get('image')->getData();
                    $filename = md5(uniqid()) . "." .$file->guessExtension();
                    $file->move($this->getParameter('brochures_directory'), $filename);
                    $user->setImage($filename);
                }
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('profil_affichage');
        }

        return $this->render('profil/profil.html.twig', [
            'user' => $user,
            'hotels' => $hotels,
            'restaurants' => $restaurants,
            'campings' => $campings,
            'veterinaires' => $veterinaires,
            'formImage' => $formImage->createView(),
        ]);
    }

    // /**
    //  * @Route("/affichage/modifier", name="edit_user")
    //  */
    // public function editUser(Request $request, EntityManagerInterface $manager)
    // {
    //     $user = $this->getUser();
    //     $formProfil = $this->createForm(AccountType::class, $user);
    //     $formProfil->handleRequest($request);
    //     if ($formProfil->isSubmitted() && $formProfil->isValid()) {
            
    //         $image = $user->getImage();
            
    //         if (!is_null($image)) {
    //             $file = $user->getImage();
    //         } else {
    //             $file = $formProfil->get('image')->getData();
    //             $filename = md5(uniqid()) . "." .$file->guessExtension();
    //             $file->move($this->getParameter('brochures_directory'), $filename);
    //             $user->setImage($filename);
    //         }
    //         if (is_null($user)) {
    //             $user = $this->getUser();
    //         } else {
    //             $user->getUsername($request);
    //         }
    //         //Upload a file 
    //         $manager->persist($user);
    //         $manager->flush();
    //         return $this->redirectToRoute('profil_affichage');
    //     }

    //     return $this->render('profil/user.html.twig',[
    //         'formProfil' => $formProfil->createView(),
    //     ]);
    // }


    // /**
    //  * @Route("/", name="image_edit", methods={"GET", "POST"})
    //  */
    // public function image(Request $request, Users $user)
    // {
    //     $formImage = $this->createForm(AccountType::class, $user);
    //     $formImage->handleRequest($request);
    //     if ($formImage->isSubmitted() && $formImage->isValid())
    //     {
    //         $image = $user->getImage();
    //             if (is_null($image)) {
    //                 $file = $user->getImage();
    //             } else {
    //                 $file = $formImage->get('image')->getData();
    //                 $filename = md5(uniqid()) . "." .$file->guessExtension();
    //                 $file->move($this->getParameter('brochures_directory'), $filename);
    //                 $user->setImage($filename);
    //             }
    //             if (!is_null($image)) {
    //                 $file = $user->getImage();
    //             } else {
    //                 $file = $formImage->get('image')->getData();
    //                 $filename = md5(uniqid()) . "." .$file->guessExtension();
    //                 $file->move($this->getParameter('brochures_directory'), $filename);
    //                 $user->setImage($filename);
    //             }
    //     }
    //     return $this->render('profil/profil.html.twig', [
    //         'formImage' => $formImage->createView(),
    //         'user' => $user,
    //     ]);
    // }


    // /**
    //  * @Route("/hotel/modifier/{id}", name="edit_hotel")
    //  */
    // public function editHotel(Request $request, EntityManagerInterface $manager)
    // {
    //     $idUser = $this->getUser()->getId();
    //     $hotel = $this->getDoctrine()->getRepository(Hotel::class)->findBy(array('users' => $idUser));
    //     $formHotel = $this->createForm(EditHotelType::class, $hotel);
    //     $formHotel->handleRequest($request);

    //     if($formHotel->isSubmitted() && $formHotel->isValid())
    //     {
    //         if (!is_null($hotel))
    //         {
    //             $file = $hotel->getHotel();
    //         }
    //         else
    //         {
    //             $file = $formHotel->get('nom')->getData();
    //         }

    //         $manager->persist($file);
    //         $manager->flush();
    //         return $this->redirectToRoute('profil_affichage');
    //     }
    // }
}
