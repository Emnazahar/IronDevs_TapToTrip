<?php

namespace App\Controller;
use App\Entity\Attraction;
use App\Entity\VoyageOrganise;
use App\Form\VoyageOrganiseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VoyageOrganiseController extends AbstractController
{
    /**
     * @Route("/voyage/organise", name="voyage_organise")
     */
    public function index(): Response
    {
        return $this->render('voyage_organise/index.html.twig', [
            'controller_name' => 'VoyageOrganiseController',
        ]);
    }


    /* Afficher liste des voyages organisés dans la partie back */
    /**
     * @Route("/listVoyage",name="listVoyage")
     */
    public function list()
    {
        $voyage= $this->getDoctrine()->
        getRepository(VoyageOrganise::class)->findAll();
        return $this->render("voyage_organise/listVoyage.html.twig",
            array('tabVoyage'=>$voyage));
    }


    /* Afficher les voyages organisés dans la partie front */
    /**
     * @Route("/showVoyages",name="showVoyages")
     */
    public function showVoyages()
    {
        $voyage= $this->getDoctrine()->
        getRepository(VoyageOrganise::class)->findAll();
        return $this->render("voyage_organise/showVoyagesFront.html.twig",
            array('tabVoyages'=>$voyage));
    }

    /* Afficher le detail d'un voyage organisé dans la partie Front */
    /**
     * @Route("/detailVoyage/{id}",name="detailVoyage")
     */
    public function detailVoyage($id)
    {
        $voyage= $this->getDoctrine()->
        getRepository(VoyageOrganise::class)->find($id);
        return $this->render("voyage_organise/detailVoyageFront.html.twig",
            array('voyage'=>$voyage));
    }


    /* Ajouter un voyage organisé */
    /**
     * @Route("/addVoyage",name="addVoyage")
     */
    public function add(Request$request ){
        $voyage= new VoyageOrganise();
        $form= $this->createForm(VoyageOrganiseType::class,$voyage);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file=$voyage->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('photo_directory'),
                    $fileName
                );
            } catch(FileException $e) {}
            $voyage->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($voyage);
            $em->flush();
            return $this->redirectToRoute("listVoyage");
        }
        return $this->render("voyage_organise/addVoyage.html.twig",array("formVoyage"=>$form->createView()));
    }


    /* modifier un voyage organisé */
    /**
     * @Route("/updateVoyage/{id}",name="updateVoyage")
     */
    public function update(Request $request,$id){
        $voyage= $this->getDoctrine()->getRepository(VoyageOrganise::class)->find($id);
        $form= $this->createForm(VoyageOrganiseType::class,$voyage);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file=$voyage->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('photo_directory'),
                    $fileName
                );
            } catch(FileException $e) {}
            $voyage->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listVoyage");
        }
        return $this->render("voyage_organise/updateVoyage.html.twig",array("formVoyage"=>$form->createView()));
    }


    /* Supprimer un voyage organisé */
    /**
     * @Route("/removeVoyage/{id}",name="removeVoyage")
     */
    public function delete($id){
        $voyage= $this->getDoctrine()->getRepository(VoyageOrganise::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($voyage);
        $em->flush();
        return $this->redirectToRoute("listVoyage");
    }





}