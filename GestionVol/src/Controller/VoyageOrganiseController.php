<?php

namespace App\Controller;
use App\Entity\Attraction;
use App\Entity\VoyageOrganise;
use App\Form\VoyageOrganiseType;
use App\Repository\VoyageOrganiseRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
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
    public function index()
    {
        return $this->render('voyage_organise/index.html.twig', [
            'controller_name' => 'VoyageOrganiseController',
        ]);
    }


    /* Afficher liste des voyages organisés dans la partie back */
    /**
     * @Route("/listVoyage",name="listVoyage")
     */
    public function list(Request $request, PaginatorInterface $paginator)
    {
        $voyage= $this->getDoctrine()->getRepository(VoyageOrganise::class)->findAll();

        $voyages = $paginator->paginate(
        //Passer les données
            $voyage,
            $request->query->getInt('page',1),
            3
        );

        return $this->render('voyage_organise/listVoyage.html.twig', [
            'voyages' => $voyages,
        ]);
    }


    /* Afficher les voyages organisés dans la partie front */
    /**
     * @Route("/showVoyages",name="showVoyages")
     */
    public function showVoyages(Request $request, PaginatorInterface $paginator)
    {
        $voyage= $this->getDoctrine()->getRepository(VoyageOrganise::class)->findAll();

        $voyages = $paginator->paginate(
        //Passer les données
            $voyage,
            $request->query->getInt('page',1),
            8
        );

        return $this->render('voyage_organise/showVoyagesFront.html.twig', [
            'voyages' => $voyages,
        ]);
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
    public function add(Request$request, FlashyNotifier $flashy){
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

            //flash message
            $flashy->success('Voyage organisé ajouté avec succès !', 'http://your-awesome-link.com');

            return $this->redirectToRoute("listVoyage");
        }
        return $this->render("voyage_organise/addVoyage.html.twig",array("formVoyage"=>$form->createView()));
    }


    /* modifier un voyage organisé */
    /**
     * @Route("/updateVoyage/{id}",name="updateVoyage")
     */
    public function update(Request $request,$id, FlashyNotifier $flashy){
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

            //flash message
            $flashy->warning('Voyage organisé modifié avec succès !', 'http://your-awesome-link.com');

            return $this->redirectToRoute("listVoyage");
        }
        return $this->render("voyage_organise/updateVoyage.html.twig",array("formVoyage"=>$form->createView()));
    }


    /* Supprimer un voyage organisé */
    /**
     * @Route("/removeVoyage/{id}",name="removeVoyage")
     */
    public function delete($id, FlashyNotifier $flashy){
        $voyage= $this->getDoctrine()->getRepository(VoyageOrganise::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($voyage);
        $em->flush();

        //flash message
        $flashy->error('Voyage organisé supprimé avec succès !', 'http://your-awesome-link.com');

        return $this->redirectToRoute("listVoyage");
    }





    /**
     * @Route("/sortbynameasc", name="sortname")
     */
    public function triDestAsc(VoyageOrganiseRepository $repo,Request $request)
    {
        $requestString=$request->get('searchValue');
        $events = $repo->orderByDestAscQB();

        return $this->render('voyage_organise/showVoyagesFront.html.twig', [
            "voyages"=>$events
        ]);
    }
    /**
     * @Route("/sortbynamedsc", name="sortname2")
     */
    public function triDestDesc(VoyageOrganiseRepository $repo,Request $request)
    {
        $requestString=$request->get('searchValue');
        $events = $repo->orderByDestDescQB();

        return $this->render('voyage_organise/showVoyagesFront.html.twig', [
            "voyages"=>$events
        ]);
    }
    /**
     * @Route("/sortbyprixdsc", name="sortprix")
     */
    public function triPrixDesc(VoyageOrganiseRepository $repo,Request $request)
    {
        $requestString=$request->get('searchValue');
        $events = $repo->orderByPrixDescQB();

        return $this->render('voyage_organise/showVoyagesFront.html.twig', [
            "voyages"=>$events
        ]);
    }
    /**
     * @Route("/sortbyprixasc", name="sortprix2")
     */
    public function triPrixAsc(VoyageOrganiseRepository $repo,Request $request)
    {
        $requestString=$request->get('searchValue');
        $events = $repo->orderByPrixAscQB();

        return $this->render('voyage_organise/showVoyagesFront.html.twig', [
            "voyages"=>$events
        ]);
    }






}