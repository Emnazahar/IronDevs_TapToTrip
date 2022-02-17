<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/adminlist",name="adminlist")
     */
    public function list()
    {
        $admin= $this->getDoctrine()->
        getRepository(Admin::class)->findAll();
        return $this->render("admin/listaffiche.html.twig",
            array('tabadmin'=>$admin));
    }
    /**
     * @Route("/add",name="addAdmin")
     */
    public function add(\Symfony\Component\HttpFoundation\Request $request){
        $Admin= new Admin();
        $form= $this->createForm(AdminType::class,$Admin);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($Admin);
            $em->flush();
            return $this->redirectToRoute("adminlist");

        }
        return $this->render("Admin/listadmin.html.twig",array("formadmin"=>$form->createView()));
    }



    /**
     * @Route("/update/{nsc}",name="update")
     */
    public function update(Request $request,$nsc){
        $admin= $this->getDoctrine()->getRepository(admin::class)->find($nsc);
        $form= $this->createForm(AdminType::class,$admin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("adminlist");
        }
        return $this->render("admin/update.html.twig",  array("formadmin"=>$form->createView()));
    }
    /**
     * @Route("/remove/{nsc}",name="remove")
     */
    public function delete($nsc){
        $admin= $this->getDoctrine()->getRepository(admin::class)->find($nsc);
        $em= $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();
        return $this->redirectToRoute("adminlist");
    }
}
