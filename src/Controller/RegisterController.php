<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\RegisterType;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request,UserPasswordEncoderInterface $passEncoder)
    {
        $user = new User();
        $repository = $this->getDoctrine()->getRepository('App:User');
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $data = $form->getData();
            $username = $data->getUserName();
            $pass = $data->getPassword();
            $variable = $repository->findOneBy(array('username' => $username));

            if($variable != null){
                $this->addFlash('error', 'Utilisateur déja inscrit ! ');
            }
            else{
                $data->setpassword(
                    $passEncoder->encodePassword($user,$pass)
                );
                //$data->setRoles(["ROLE_ADMIN"]);
                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();
                return $this->redirect($this->generateUrl('app_login'));
            }
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
