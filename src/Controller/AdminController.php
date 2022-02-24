<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        getRepository(user::class)->findAll();
        return $this->render("admin/listaffiche.html.twig",
            array('tabadmin'=>$admin));
    }
    /**
     * @Route("/add",name="addUser")
     */
    public function add(\Symfony\Component\HttpFoundation\Request $request){
        $Admin= new User();
        $form= $this->createForm(UserType::class,$Admin);
         $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($Admin);
            $em->flush();
            return $this->redirectToRoute("adminlist");

        }
        return $this->render("Admin/listadmin.html.twig",array("formuser"=>$form->createView()));
    }

    /**
     * @Route("/update/{id}",name="update")
     */
    public function update(Request $request,$id){
        $admin= $this->getDoctrine()->getRepository(user::class)->find($id);
        $form= $this->createForm(UserType::class,$admin);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("adminlist");

        }
        return $this->render("admin/update.html.twig",array("formuser"=>$form->createView()));
    }
    /**
     * @Route("/remove/{id}",name="remove")
     */
    public function delete($id){
        $admin= $this->getDoctrine()->getRepository(user::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();
        return $this->redirectToRoute("adminlist");
    }
}
