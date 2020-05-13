<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\Restaurant;
use App\Entity\Veterinaire;
use App\Entity\Camping;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        $campings = $this->getDoctrine()->getRepository(Camping::class)->findAll();
        $veterinaires = $this->getDoctrine()->getRepository(Veterinaire::class)->findAll();

        return $this->render('home/home.html.twig', [
            'restaurants' => $restaurants,
            'hotels' => $hotels,
            'campings' => $campings,
            'veterinaires' => $veterinaires,
        ]);
    }

}
