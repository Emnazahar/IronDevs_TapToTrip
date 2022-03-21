<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/frontvoyage", name="front")
     */
    public function index1(): Response
    {
        return $this->render('front/base-front.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/front", name="front")
     */
    public function index(): Response
    {
        return $this->render('baseFront.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/voyage", name="voyage")
     */
    public function voyage(): Response
    {
        return $this->render('front/voyage.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('accueil.html.twig', [
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
