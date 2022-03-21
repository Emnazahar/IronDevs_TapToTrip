<?php

namespace App\Controller;

use App\Entity\filtrage;
use App\Entity\Hotel;
use App\Form\FiltrageType;
use App\Form\HotelType;
use App\Form\MailType;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;

class HotelController extends Controller
{
    /**
     * @Route("/back", name="hotel")
     */
    public function index(): Response
    {
        return $this->render('base-back.html.twig', [
            'controller_name' => 'HotelController',
        ]);
    }

    /**
     * @param HotelRepository $repository
     * @return Response
     * @Route ("/hfront", name="afffront")
     */
    public function afficherFront(HotelRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $allhotel=$repository->findAll();

        $hotel = $paginator->paginate(
        // Doctrine Query, not results
            $allhotel,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );
        return $this->render('hotel/consulterfrontH.html.twig',
            ['hotels'=>$hotel

            ]);
    }
    /**
     * @param HotelRepository $repository
     * @return Response
     * @Route ("/afficheH",name="affichage")
     */


    public function afficher(HotelRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        //$search=new filtrage();
      //  $filtre=$this->createForm(FiltrageType::class,$search);
       // $filtre->handleRequest($request);
        $allhotel=$repository->findAll();

        $hotel = $paginator->paginate(
        // Doctrine Query, not results
            $allhotel,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            4
        );
        return $this->render('hotel/consulterH.html.twig',
            ['hotel'=>$hotel
            // 'filtre'=>$filtre->createView()
            ]);
    }

    /**
     * @Route("/delete/{id}",name="delete")
     */
    function delete($id,HotelRepository $repository)
    {
        $hotel=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($hotel);
        $em->flush();
        return $this->redirectToRoute('affichage');

    }
    /**
     * @param Request $request
     * @return Response
     * @Route ("hotel/add",name="addH")
     */
    function ajouter(Request $request)
    {
        $hotel=new hotel();
        $form=$this->createForm(HotelType::class,$hotel);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute('affichage');
        }

        return $this->render('hotel/addH.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route ("/{id}/update",name="update")
     */
    public function edit(Request $request, Hotel $hotel): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('affichage');
        }

        return $this->render('hotel/updateH.html.twig',
            ['f'=>$form->createView()]);
    }

    /**
     * @param HotelRepository $hotrepository
     * @return Response
     * @Route ("/pdf",name ="hotel_pdf", methods={"GET"})
     */
    public function pdf(HotelRepository $hotrepository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $hotels = $hotrepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('hotel/pdf.html.twig', [
            'pdfhotel' => $hotels,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("hotels.pdf", [
            "Attachment" => true
        ]);

        return $this->render($this->redirectToRoute('affichage'));
    }

    /* /**
     * @Route("/stat", name="stat")
     */

   /* public function list1( )
    {
        $count=[];
        $nom=[];
        $entreprise = $this->getDoctrine()->getRepository(Hotel::class)->findAll();

        $nom[]=1;
        $nom[]=2;
        $nom[]=3;
        $nom[]=4;
        $nom[]=5;
        foreach($entreprise as $end)
        {
            $i=0;
            $j=1;

                if($end->getNbEtoiles()==$nom[j]){
                    $i=$i+1;
                }

            $count[]=$i;

        }

        //dd($nom);

        return   $this->render('/rtl.html.twig', ['nom'=>json_encode($nom),'count'=>json_encode($count)]);




    }*/

    /**
     * @param Request $request
     * @return Response
     * @Route ("/mailing", name="mails")
     */

    public function email(Request $request, \Swift_Mailer $mailer)
    {
        $mailingform= $this->createForm(MailType::class);
        $mailingform->handleRequest($request);
        if ($mailingform->isSubmitted() && $mailingform->isValid()) {
            $contact = $mailingform->getData();

            //ici en enverrons le mail
            //dd($contact);
            $message=(new \Swift_Message('Nouveau Contact'))
                // on attribue l'éxpediteur
                ->setFrom($contact ['email'])

                //on attribue le destinataire

                ->setTo('jalel.medsalah@esprit.tn')

                //on écrit le message
                ->setBody(
                    $this->renderView(
                        'hotel/contact.html.twig', compact('contact')
                    ), 'Votre Hotel a ete bien ajoute sur la base des donnees de notre agence !');

            // on envoie le message
            $mailer->send($message);
            $this->addFlash('message', 'le message a été envoyé');
            return $this->redirectToRoute('affichage');
        }
        return $this->render('hotel/mail.html.twig', [
            'mailingForm'=>$mailingform->createView()
        ]);
    }


}
