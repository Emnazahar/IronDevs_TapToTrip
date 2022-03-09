<?php

namespace App\Controller;

use App\Entity\Attraction;
use App\Entity\Images;
use App\Form\AttractionType;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ImagesController extends AbstractController
{
    /**
     * @Route("/imagesC", name="imagesC")
     */
    public function index(): Response
    {
        return $this->render('images/index.html.twig', [
            'controller_name' => 'ImagesController',
        ]);
    }

    /**
     * @Route("/listImages",name="listImages")
     */
    public function list(Request $request, PaginatorInterface $paginator)
    {
        $image= $this->getDoctrine()->getRepository(Images::class)->findAll();

        $images = $paginator->paginate(
            $image,
            $request->query->getInt('page', 1),
            3

        );

        return $this->render("images/listImages.html.twig",
            array('images'=>$images));
    }


    /**
     * @Route("/removeImage/{id}",name="removeImage")
     */
    public function delete($id, FlashyNotifier $flashy){
        $image= $this->getDoctrine()->getRepository(Images::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();

        //flash message
        $flashy->error('Image supprimée avec succès !', 'http://your-awesome-link.com');

        return $this->redirectToRoute("listImages");
    }




}


