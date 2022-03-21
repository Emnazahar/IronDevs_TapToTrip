<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomefController extends AbstractController
{
    /**
     * @Route("/homef", name="homef")
     */
    public function index(): Response
    {
        return $this->render('homef/accueilFront.html.twig', [
            'controller_name' => 'HomefController',
        ]);
    }
}