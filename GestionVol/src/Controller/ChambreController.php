<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    /**
     * @Route("/front", name="chambre")
     */
    public function index(): Response
    {
        return $this->render('base-front.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }
    /**
     * @param ChambreRepository $repository
     * @return Response
     * @Route ("/afficheChambre",name="affichageChambre")
     */
    public function show(ChambreRepository $repository)
    {
        $chambre=$repository->findAll();
        return $this->render('chambre/consulterCh.html.twig',
            ['chambre'=>$chambre]);
    }
    /**
     * @Route("/supp/{id}",name="del")
     */
    function delete($id,ChambreRepository $repository)
    {
        $chambre=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($chambre);
        $em->flush();
        return $this->redirectToRoute('affichageChambre');

    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("chambre/add",name="addCh")
     */

    function add(Request $request)
    {
        $chambre = new Chambre();
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();
            return $this->redirectToRoute('affichageChambre');
        }

        return $this->render('chambre/addCh.html.twig', [
            'formChambre' => $form->createView()
        ]);
    }
    /**
     * @Route ("update/{id}",name="up")
     */

    public function edit(Request $request, chambre $chambre): Response
    {
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('affichageChambre');
        }

        return $this->render('chambre/updateCh.html.twig',
            ['formup'=>$form->createView()]);
    }
    /**
     * @Route("chambre/recherche",name="recherche")
     */
    function find(ChambreRepository $repository,Request $request)
    {
        $data=$request->get('search');
        $chambre=$repository->findBy(['id'=>$data]);
        return $this->render('chambre/consulterCh.html.twig',
            ['chambre'=>$chambre]);

    }
}
