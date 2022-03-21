<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomebController extends AbstractController
{
    /**
     * @Route("/", name="homeb")
     */
    public function index(): Response
    {
        return $this->render('homeb/accueilBack.html.twig', [
            'controller_name' => 'HomebController',
        ]);
    }
}
