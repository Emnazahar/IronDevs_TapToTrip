<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Entity\CompteBancaire;
use App\Entity\Transport;
use App\Entity\User;
use App\Form\DateReservationType;
use App\Form\FindTransportType;
use App\Form\ReservationTransportType;
use App\Form\TransportType;
use App\Repository\BilletRepository;
use App\Repository\TransportRepository;
use DateTime;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;

class TransportController extends AbstractController
{
    private $mailer;
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/addTransport", name="add_transport")
     */
    public function addTransport(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $transport = new Transport();
        $form = $this->createForm(TransportType::class, $transport);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            //upload image
            $uploadFile = $form['image']->getData();
            if($uploadFile != null) {
                $filename = $uploadFile->getClientOriginalName();

                $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/produit_image', $filename);

                $transport->setImage($filename);
            }
            $em->persist($transport);
            $em->flush();
            return $this->redirectToRoute('read_transport');
        }
        return $this->render('back/transport/addTransport.html.twig', array("formTransport" => $form->createView()));
    }

    /**
     * @Route("/readTransport",name="read_transport")
     */
    public function readTransport()
    {
        $transport= $this->getDoctrine()->getRepository(Transport::class)->findAll();

        return $this->render("back/transport/readTransport.html.twig",array('tabTransport'=>$transport));
    }

    /**
     * @Route("/editTransport/{id}", name="edit_transport")
     */
    public function editTransport(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $transport = $em->getRepository(Transport::class)->find($id);
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

       /*
        $imageDB = $transport->getImage();
        if($imageForm == null) {

        } else {
            $filename = $imageForm->getClientOriginalName();//crypté image
            $imageForm->move($this->getParameter('kernel.project_dir') . '/public/uploads/produit_image', $filename);
            $transport->setImage($filename);
        }*/

            //$filename = uniqid();//crypté image

      /*  $uploadFile = $request->file('image');
        if($uploadFile != null) {
            $filename = uniqid();//crypté image
            $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/produit_image', $filename);
            $transport->setImage($filename);
        }*/

        if ($form->isSubmitted() && $form->isValid()) {
            //upload image
            $uploadFile = $form['image']->getData();
            if($uploadFile != null) {
                $filename = $uploadFile->getClientOriginalName();

                $uploadFile->move($this->getParameter('kernel.project_dir') . '/public/uploads/produit_image', $filename);

                $transport->setImage($filename);
            }
            $em->flush();
            return $this->redirectToRoute('read_transport');
        }
        return $this->render('back/transport/editTransport.html.twig', array("formTransport" => $form->createView()));
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

    /**
     * @Route("/frontReadTransport",name="front_read_transport")
     */
    public function frontReadTransport() {

        $transport= $this->getDoctrine()->getRepository(Transport::class)->findAllByUserIDNull();
        $form = $this->createForm(FindTransportType::class,null);
        return $this->render("front/transport/readTransport.html.twig",array('tabTransport'=>$transport, "formSearchTransport" => $form->createView()));
    }

    /**
     * @Route("/verifBillet/{idTransport}",name="verif_billet")
     */
    public function verifBillet(Request $request,BilletRepository $repository, $idTransport): Response
    {
        $idUserConnected = $this->getParameter('app.userID');

        $billet = new Billet();
        $idBillet = null;
        $dateReservation = null;
        //$repository = new BilletRepository();
        $form = $this->createForm(ReservationTransportType::class,null,['idBillet' => $idBillet, 'dateReservation' => $dateReservation]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $billet = $repository->find($form['idBillet']->getData());

            if ($billet == null){
                echo "<script type='text/javascript'>alert('This id does not belong to any billet, please verify');</script>";
                return $this->render('front/transport/reserverTransport.html.twig', array("formReservationTransport" => $form->createView()));
            }

            if ($idUserConnected != $billet->getUser()->getId()){
                echo "<script type='text/javascript'>alert('This billet does not belong to you, please verify');</script>";
                return $this->render('front/transport/reserverTransport.html.twig',  array("formReservationTransport" => $form->createView()));
            }

            $dateReservationTimeStamp = $form['dateReservation']->getData()->getTimestamp();
            $dateArriveVol = $billet->getVol()->getDatearrive();
            $dateArriveVolTimeStamp = $dateArriveVol->getTimestamp();
            var_dump("//////////////////",$dateReservationTimeStamp);
            var_dump("//////////////////",$dateArriveVolTimeStamp);
            if ($dateReservationTimeStamp < $dateArriveVolTimeStamp){
                echo "<script type='text/javascript'>alert('Invalid Date, date before date of lending! Please verify');</script>";
                return $this->render('front/transport/reserverTransport.html.twig',  array("formReservationTransport" => $form->createView()));
            } else{
                $this->payReservationTransport($idUserConnected,$idTransport);
                $em = $this->getDoctrine()->getManager();
                $transport= $this->getDoctrine()->getRepository(Transport::class)->findByUserID($idUserConnected);
                return $this->render('front/transport/readMyTransports.html.twig' ,array('tabTransportByUser'=>$transport));
            }
        }

        return $this->render('front/transport/reserverTransport.html.twig', array("formReservationTransport" => $form->createView()));
    }

    public function payReservationTransport($idUser,$idTransport)
    {
        $em = $this->getDoctrine()->getManager();
        $transport = $em->getRepository(Transport::class)->find($idTransport);
        $user = $em->getRepository(User::class)->find($idUser);
        $compte = $em->getRepository(CompteBancaire::class)->findOneByUserId($idUser);

        if($transport->getPrix() > $compte->getSolde()) {
            echo "<script type='text/javascript'>alert('Solde insuffisant');</script>";
            return $this->redirectToRoute('front_read_my_transport');
        }
        else {
            $compte->setSolde($compte->getSolde() - $transport->getPrix());
            $transport->setUser($user);
            $em->flush();
            //$this->sendMail();
        }
    }

    /**
     * @Route("/readMyTransports",name="front_read_my_transport")
     */
    public function readMyTransports()
    {
        $idUserConnected = $this->getParameter('app.userID');
        $transport= $this->getDoctrine()->getRepository(Transport::class)->findByUserID($idUserConnected);

        return $this->render('front/transport/readMyTransports.html.twig' ,array('tabTransportByUser'=>$transport));
    }

    public function sendMail()
    {
        $message = new Swift_Message('Test email');
        $message->setFrom('dahmenitesnim1@gmail.com');
        $message->setTo('yosrdahmeni6@gmail.com');
        $message->setBody('azerzrz');

        $this->mailer->send($message);
//var_dump("///////////////",$this->mailer);

    }

    /**
     * @Route("/findTransportByCriteria",name="find_transport_by_criteria")
     */
    public function findTransportByCriteria(Request $request): Response
    {
        $categorie = null;
        $prixMin = null;
        $prixMax = null;

        $form = $this->createForm(FindTransportType::class,null,['categorie' => $categorie, 'prixMin' => $prixMin,
            'prixMax' => $prixMax]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $categorie = $form['categorie']->getData();
            $prixMin = $form['prixMin'];
            $prixMax = $form['prixMax'];

            if ($prixMin != null) {
                $prixMin = $form['prixMin']->getData();
            }
            if ($prixMax != null) {
                $prixMax = $form['prixMax']->getData();
            }

            $transport= $this->getDoctrine()->getRepository(Transport::class)->findByCriteria($categorie, $prixMin, $prixMax);
            return $this->render("front/transport/readTransport.html.twig",array('tabTransport'=>$transport, "formSearchTransport" => $form->createView()));
        }

        return $this->redirectToRoute('front_read_transport');
    }



}
