<?php

namespace App\Controller;

use App\Entity\Attraction;
use App\Form\AttractionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttractionController extends AbstractController
{
    /**
     * @Route("/attractionC", name="attractionC")
     */
    public function index(): Response
    {
        return $this->render('attraction/index.html.twig', [
            'controller_name' => 'AttractionController',
        ]);
    }

    /**
     * @Route("/listAttraction",name="listAttraction")
     */
    public function list()
    {
        $attraction= $this->getDoctrine()->
        getRepository(Attraction::class)->findAll();
        return $this->render("attraction/listAttraction.html.twig",
            array('tabAttr'=>$attraction));
    }

    /**
     * @Route("/addAttraction",name="addAttraction")
     */
    public function add(Request$request ){
        $attraction= new Attraction();
        $form= $this->createForm(AttractionType::class,$attraction);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file=$attraction->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('photo_directory'),
                    $fileName
                );
            } catch(FileException $e) {}
            $attraction->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($attraction);
            $em->flush();
            return $this->redirectToRoute("listAttraction");
        }
        return $this->render("attraction/addAttraction.html.twig",array("formAttraction"=>$form->createView()));
    }

    /**
     * @Route("/updateAttraction/{id}",name="updateAttraction")
     */
    public function update(Request $request,$id){
        $attraction= $this->getDoctrine()->getRepository(Attraction::class)->find($id);
        $form= $this->createForm(AttractionType::class,$attraction);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $file=$attraction->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('photo_directory'),
                    $fileName
                );
            } catch(FileException $e) {}
            $attraction->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listAttraction");
        }
        return $this->render("attraction/updateAttraction.html.twig",array("formAttraction"=>$form->createView()));
    }

    /**
     * @Route("/removeAttraction/{id}",name="removeAttraction")
     */
    public function delete($id){
        $attraction= $this->getDoctrine()->getRepository(Attraction::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($attraction);
        $em->flush();
        return $this->redirectToRoute("listAttraction");
    }
}
