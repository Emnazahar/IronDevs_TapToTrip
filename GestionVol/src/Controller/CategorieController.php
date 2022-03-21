<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use PhpParser\Builder\Param;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/addCategorie", name="add_categorie")
     */
    public function addCategorie(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('read_categorie');
        }
        return $this->render('back/categorie/addCategorie.html.twig', array("formCategorie" => $form->createView()));
    }

    /**
     * @Route("/readCategorie",name="read_categorie")
     */
    public function readCategorie()
    {
        $categorie= $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        return $this->render("back/categorie/readCategorie.html.twig",array('tabCategorie'=>$categorie));
    }

    /**
     * @Route("/editCategorie/{id}", name="edit_categorie")
     */
    public function editCategorie(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->find($id);
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('read_categorie');
        }
        return $this->render('back/categorie/editCategorie.html.twig', array("formCategorie" => $form->createView()));
    }

    /**
     * @Route("/deleteCategorie/{id}",name="delete_categorie")
     */
    public function deleteCategorie($id, CategorieRepository $repository){
        $categorie=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('read_categorie');
    }


}
