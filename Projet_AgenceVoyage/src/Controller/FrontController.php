<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{

    // Page Accueil
    /**
     * @Route("/front", name="front")
     */
    public function index(): Response
    {
        return $this->render('front/base-front.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    //Page Voyage Organisés
    /**
     * @Route("/voyage", name="voyage")
     */
    public function voyage(): Response
    {
        return $this->render('front/voyage.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    //Page Attraction
    /**
     * @Route("/attraction", name="attraction")
     */
    public function attraction(): Response
    {
        return $this->render('front/attraction.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

}
