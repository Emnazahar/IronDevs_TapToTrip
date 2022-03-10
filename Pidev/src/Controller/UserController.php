<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
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
    public function add(\Symfony\Component\HttpFoundation\Request $request, UserPasswordEncoderInterface $userPasswordEncoderInterface){
        $Admin= new User();
        $form= $this->createForm(UserType::class,$Admin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Admin->setPassword(
                $userPasswordEncoderInterface->encodePassword(
                    $Admin,
                    $form->get('confirm_password')->getData()
                )
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($Admin);
            $em->flush();
            $this->addFlash('message', 'Ajout avec succée !');
            return $this->redirectToRoute("addUser");

        }
        return $this->render("Admin/listadmin.html.twig",array("formuser"=>$form->createView()));
    }



    /**
     * @Route("/update/{id}",name="update", methods={"GET","POST"})
     */
    public function update(\Symfony\Component\HttpFoundation\Request $request,$id, UserPasswordEncoderInterface $userPasswordEncoderInterface){
        $admin= $this->getDoctrine()->getRepository(user::class)->find($id);
        $form= $this->createForm(UserType::class,$admin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $admin->setPassword(
                $userPasswordEncoderInterface->encodePassword(
                    $admin,
                    $form->get('confirm_password')->getData()
                )
            );
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("adminlist");
        }
        return $this->render("Admin/update.html.twig",  array("formuser"=>$form->createView()));
    }
    /**
     * @Route("/remove/{id}",name="remove")
     */
    public function delete($id){
        $admin= $this->getDoctrine()->getRepository(user::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();
        $this->addFlash('message', 'Suppression avec succée !');
        return $this->redirectToRoute("adminlist");

    }
}
