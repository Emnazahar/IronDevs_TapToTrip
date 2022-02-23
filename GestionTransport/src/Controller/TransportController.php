<?php

namespace App\Controller;

use App\Entity\Transport;
use App\Form\TransportType;
use App\Repository\TransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;

class TransportController extends AbstractController
{

    /**
     * @Route("/addTransport", name="add_transport")
     */
    public function addTransport(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $transport = new Transport();
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);
        //var_dump($transport->getIdcategorie());
        if ($form->isSubmitted() && $form->isValid()) {

            //upload image
            $uploadFile = $form['image']->getData(); // valeur ta3 image (ely how name ta3ha)
            if($uploadFile != null) {
                $filename = uniqid();//crypté image

                $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/produit_image', $filename);

                $transport->setImage($filename);
            }
            //var_dump($transport);
            $em->persist($transport);
            $em->flush();
            return $this->redirectToRoute('read_transport');
        }
        return $this->render('transport/addTransport.html.twig', array("formTransport" => $form->createView()));
    }

    /**
     * @Route("/readTransport",name="read_transport")
     */
    public function readTransport()
    {
        $transport= $this->getDoctrine()->getRepository(Transport::class)->findAll();

        return $this->render("transport/readTransport.html.twig",array('tabTransport'=>$transport));
    }

    /**
     * @Route("/editTransport/{id}", name="edit_transport")
     */
    public function editTransport(Request $request, $id)
    {
        //$transport = new Transport();
        //$transport = $this->getDoctrine()->getRepository(Transport::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $transport = $em->getRepository(Transport::class)->find($id);
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        /*$imageDB=$transport->getImage();


        if($imageForm==null) {
            $imageForm=$imageDB;
        }

            $filename = uniqid();//crypté image



            $transport->setImage($filename);*/

      /*  $uploadFile = $request->file('image');
        if($uploadFile != null) {
            $filename = uniqid();//crypté image

            $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/produit_image', $filename);

            $transport->setImage($filename);
        }*/

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('read_transport');
        }
        return $this->render('transport/editTransport.html.twig', array("formTransport" => $form->createView()));
    }

    /**
     * @Route("/deleteTransport/{id}",name="delete_transport")
     */
    public function deleteTransport($id, TransportRepository $repository){
        $transport=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($transport);
        $em->flush();
        return $this->redirectToRoute('read_transport');
    }


}
