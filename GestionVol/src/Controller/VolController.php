<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\SearchType;
use App\Form\VolType;
use Container2JjnkS4\PaginatorInterface_82dac15;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VolRepository;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

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
    public function liste(Request $request)
    {
        $vol = $this->getDoctrine()->getRepository(Vol::class)->findAll();
        $formSearch=$this->createForm(VolType::class);
        $formSearch->handleRequest($request);
        if($formSearch->isSubmitted() ){
            $NumVol = $formSearch->getData();
            $TSearch = $this->getDoctrine()->getRepository(Vol::class)->findVolById($NumVol);
            return $this->render("vol/indexsearch.html.twig", array('vol'=>$vol , "cath"=>$TSearch , "formSearch"=>$formSearch->createView()));
        }
        return $this->render('vol/liste.html.twig',
            array('vol' => $vol , "formSearch"=>$formSearch->createView()));

    }
    /**
     * @Route ("listeVf",name="listeVf")
     */
    public function listef(Request $request,PaginatorInterface $paginator)
    {


        $vol = $this->getDoctrine()->getRepository(Vol::class)->findAll();
        $vol = $paginator->paginate(
            $vol,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('vol/listef.html.twig',
            array('vol' => $vol  ));
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
     * @Route("/updat/{id}",name="updateVol")
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

    /**
     * @Route("/search", name="search", requirements={"id":"\d+"})

     */
    public function search(Request $request, NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $requestString = $request->get('searchValue');
        $vol = $repository->findVolById($requestString);
        $jsonContent = $Normalizer->normalize($vol, 'json',[]);

        return new Response(json_encode($jsonContent));
    }




}

