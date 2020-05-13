<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;



class RechercherController extends AbstractController
{
    /**
     * @Route("/rechercher", name="rechercher")
     * 
     */
    public function indexAction(Request $request)
    {
        if ($request->request->get('some_var_name')) {
            //make something curious, get some unbelieveable data
            $arrData = ['output' => 'here the result which will appear in div'];
            return new JsonResponse($arrData);
            
        }
        return $this->render('rechercher/rechercher.html.twig');
    }
}
