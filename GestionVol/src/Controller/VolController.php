<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VolRepository;

class VolController extends AbstractController
{
    /**
     * @Route("/vol", name="vol")
     */
    public function index(): Response
    {
        return $this->render('vol/index.html.twig', [
            'controller_name' => 'VolController',
        ]);
    }

    /**
     * @Route ("listeV",name="listeV")
     */
    public function liste()
    {
        $vol = $this->getDoctrine()->getRepository(Vol::class)->findAll();
        return $this->render('vol/liste.html.twig',
            array('vol' => $vol));

    }

    /**
     * @Route("/removeVol/{id}",name="removeVol")
     */
    public function delete($id){
        $vol= $this->getDoctrine()->getRepository(Vol::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($vol);
        $em->flush();
        return $this->redirectToRoute("listeV");
    }

    /**
     * @Route("/add",name="addVol")
     */
    public function add(Request$request )
    {
        $vol= new Vol();
        $form= $this->createForm(VolType::class,$vol);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($vol);
            $em->flush();
            return $this->redirectToRoute("listeV");
        }
        return $this->render("vol/add.html.twig",array("form"=>$form->createView()));
    }

    /**
     * @Route("/update/{id}",name="updateVol")
     */
    public function update(Request $request,$id){
        $vol= $this->getDoctrine()->getRepository(Vol::class)->find($id);
        $form= $this->createForm(VolType::class,$vol);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listeV");
        }
        return $this->render("vol/Update.html.twig",array("form"=>$form->createView()));
    }



}

