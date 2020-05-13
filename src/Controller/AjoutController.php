<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Entity\Foret;
use App\Entity\Hotel;
use App\Entity\Plage;
use App\Entity\Restaurant;
use App\Entity\Veterinaire;
use App\Form\CampingType;
use App\Form\ForetType;
use App\Form\HotelType;
use App\Form\PlageType;
use App\Form\RestaurantType;
use App\Form\VeterinaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjoutController extends AbstractController
{
    /**
     * @Route("/ajouter",  name="ajouter") 
     */
    public function ajouter()
    {
        return $this->render('ajout/ajouter.html.twig');
    }

    /**
     * @Route("/hotel", name="ajout_hotel")
     */
    public function ajoutHotel(Request $request, EntityManagerInterface $manager)
    {
        $hotel = new Hotel();
        $hotel->setUsers($this->getUser());

        // utilisation du formulaire hotelType pour récupérer les infos et les rentrer dans l'objet Hotel
        $formHotel = $this->createForm(HotelType::class, $hotel);
        $formHotel->handleRequest($request);

        // si le formulaire est soumis et valide alors
        if ($formHotel->isSubmitted() && $formHotel->isValid()) {
            $manager->persist($hotel);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/ajout/hotel.html.twig', [
            'formHotel' => $formHotel->createView()
        ]);
    }


    /**
     * @Route("/camping", name="ajout_camping")
     */
    public function ajoutCamping(Request $request, EntityManagerInterface $manager)
    {
        $camping = new Camping();
        $camping->setUsers($this->getUser());

        // utilisation du formulaire AjoutCampingType pour récupérer les infos et les rentrer dans l'objet camping
        $formCamping = $this->createForm(CampingType::class, $camping);
        $formCamping->handleRequest($request);

        // si le formulaire est soumis et valide alors
        if ($formCamping->isSubmitted() && $formCamping->isValid()) {
            $manager->persist($camping);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/ajout/camping.html.twig', [
            'formCamping' => $formCamping->createView()
        ]);
    }


    /**
     * @Route("/restaurant", name="ajout_restaurant")
     */
    public function ajoutRestaurant(Request $request, EntityManagerInterface $manager)
    {
        $restaurant = new Restaurant();
        $restaurant->setUsers($this->getUser());

        // utilisation du formulaire RestaurantType pour récupérer les infos et les rentrer dans l'objet restaurant
        $formRestaurant = $this->createForm(RestaurantType::class, $restaurant);
        $formRestaurant->handleRequest($request);

        // si le formulaire est soumis et valide alors
        if ($formRestaurant->isSubmitted() && $formRestaurant->isValid()) {
            $manager->persist($restaurant);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/ajout/restaurant.html.twig', [
            'formRestaurant' => $formRestaurant->createView()
        ]);
    }


    /**
     * @Route("/veterinaire", name="ajout_veterinaire")
     */
    public function ajoutVeterinaire(Request $request, EntityManagerInterface $manager)
    {
        $veterinaire = new Veterinaire();
        $veterinaire->setUsers($this->getUser());

        // utilisation du formulaire veterinaireType pour récupérer les infos et les rentrer dans l'objet veterinaire
        $formVeterinaire = $this->createForm(VeterinaireType::class, $veterinaire);
        $formVeterinaire->handleRequest($request);

        // si le formulaire est soumis et valide alors
        if ($formVeterinaire->isSubmitted() && $formVeterinaire->isValid()) {
            $manager->persist($veterinaire);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/ajout/veterinaire.html.twig', [
            'formVeterinaire' => $formVeterinaire->createView()
        ]);
    }

    /**
     * @Route("/foret", name="ajout_foret")
     */
    public function ajoutForet(Request $request, EntityManagerInterface $manager)
    {
        $foret = new Foret();
        $foret->setUser($this->getUser());


        $formForet = $this->createForm(ForetType::class, $foret);
        $formForet->handleRequest($request);

        if ($formForet->isSubmitted() && $formForet->isValid()) {
            $manager->persist($foret);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/ajout/foret.html.twig', [
            'formForet' => $formForet->createView()
        ]);
    }


    /**
     * @Route("/plage", name="ajout_plage")
     */
    public function ajoutPlage(Request $request, EntityManagerInterface $manager)
    {
        $plage = new Plage();
        $plage->setUser($this->getUser());

        $formPlage = $this->createForm(PlageType::class, $plage);
        $formPlage->handleRequest($request);

        if ($formPlage->isSubmitted() && $formPlage->isValid()) {
            $manager->persist($plage);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/ajout/plage.html.twig', [
            'formPlage' => $formPlage->createView()
        ]);
    }
    /**
     * @Route("/parc", name="ajout_parc")
     */
    public function ajoutParc(Request $request, EntityManagerInterface $manager)
    {
        $parc = new Plage();
        $parc->setUser($this->getUser());
        $formParc = $this->createForm(PlageType::class, $parc);

        $formParc->handleRequest($request);

        if ($formParc->isSubmitted() && $formParc->isValid()) {
            $manager->persist($parc);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/ajout/parc.html.twig', [
            'formParc' => $formParc->createView()
        ]);
    }
}
