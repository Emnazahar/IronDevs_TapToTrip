<?php

namespace App\Controller;

use App\Entity\Attraction;
use App\Entity\Images;
use App\Form\AttractionType;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
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
    public function list(Request $request, PaginatorInterface $paginator)
    {
        $attraction= $this->getDoctrine()->getRepository(Attraction::class)->findAll();

        $attractions = $paginator->paginate(
            $attraction,
            $request->query->getInt('page', 1),
            3

        );

        return $this->render("attraction/listAttraction.html.twig",
            array('attractions'=>$attractions));
    }

    /**
     * @Route("/addAttraction",name="addAttraction")
     */
    public function add(Request$request , FlashyNotifier $flashy){
        $attraction= new Attraction();
        $form= $this->createForm(AttractionType::class,$attraction);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //Recuperation des images transmises
            $images = $form->get('images')->getData();

            //On boucle sur les images
            foreach($images as $image){
                //Generer un nouveau nom du fichier
                $fichier=md5(uniqid()).'.'.$image->guessExtension();

                //Copier le fichier dans le dossier upload
                $image->move(
                    $this->getParameter('photo_directory'),
                    $fichier
                );

                //Stocker l'image dans la bdd
                $img =  new Images();
                $img->setNom($fichier);
                $attraction->addImage($img);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($attraction);
            $em->flush();

            //flash message
            $flashy->success('Attraction ajouté avec succès !', 'http://your-awesome-link.com');

            return $this->redirectToRoute("listAttraction");
        }

        return $this->render('attraction/addAttraction.html.twig', [
            'attraction' => $attraction,
            "formAttraction"=>$form->createView()
        ]);

    }

    /**
     * @Route("/updateAttraction/{id}",name="updateAttraction")
     */
    public function update(Request $request,$id, FlashyNotifier $flashy){
        $attraction= $this->getDoctrine()->getRepository(Attraction::class)->find($id);
        $form= $this->createForm(AttractionType::class,$attraction);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //Recuperation des images transmises
            $images = $form->get('images')->getData();

            //On boucle sur les images
            foreach($images as $image){
                //Generer un nouveau nom du fichier
                $fichier=md5(uniqid()).'.'.$image->guessExtension();

                //Copier le fichier dans le dossier upload
                $image->move(
                    $this->getParameter('photo_directory'),
                    $fichier
                );

                //Stocker l'image dans la bdd
                $img =  new Images();
                $img->setNom($fichier);
                $attraction->addImage($img);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            //flash message
            $flashy->warning('Attraction modifié avec succès !', 'http://your-awesome-link.com');

            return $this->redirectToRoute("listAttraction");
        }

        return $this->render('attraction/updateAttraction.html.twig', [
            'attraction' => $attraction,
            "formAttraction"=>$form->createView()
        ]);

    }

    /**
     * @Route("/removeAttraction/{id}",name="removeAttraction")
     */
    public function delete($id, FlashyNotifier $flashy){
        $attraction= $this->getDoctrine()->getRepository(Attraction::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($attraction);
        $em->flush();

        //flash message
        $flashy->error('Attraction supprimé avec succès !', 'http://your-awesome-link.com');

        return $this->redirectToRoute("listAttraction");
    }


}


