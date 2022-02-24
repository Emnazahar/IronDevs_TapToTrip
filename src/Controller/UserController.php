<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class UserController extends AbstractController
{


    /**
     * @Route("/back/user_list", name="user_list")
     */
    public function user_list()
    {
        $user = $this->getDoctrine()->getRepository(User:: class)->findAll();
        return $this->render('/user/user_list.html.twig', array("user" => $user));
    }

    /**
     * @Route("/back/delete_user/{id}", name="delete_user")
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $delete=$em->getRepository(User::class)->find($id);
        $em->remove($delete);
        $em->flush();
        return $this->redirectToRoute('user_list');
    }
    /**
     * @Route("/back/create_user", name="create_user")
     * @param Request $request
     * @return Response
     */
    public function create_user(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user=new User();
        $form=$this->createForm(UserAddType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user, $form->get('password')->getData()
                )
            );


            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('user_added', 'User Added Successfully!!');
            return $this->redirectToRoute('user_list');
        }
        return $this->render('/user/create.html.twig', ['CreateForm_User'=>$form->createView() ]);
    }

    /**
     * @Route("/back/update/{id}",name="update_user")
     * @param Request $request
     */
    public function update(UserRepository $repository,$id,Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user=$repository->find($id);
        $form=$this->createForm(UserAddType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $user->setPassword($passwordEncoder->encodePassword($user, $form->get('password')->getData()) );



            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_list');
        }
        return $this->render('/admin/update_user.html.twig', ['UpdateForm_User'=>$form->createView() ]);
    }
}
