<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin.user")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository('App:User');
        $listUsers = $repository->findAll();
        return $this->render('admin_user/index.html.twig', [
        'listUsers' => $listUsers  
        ]);
    }
    /**
     * @Route("/admin/user/supp/{id}", name="admin.user.supp")
     */
    public function supprimerUser($id){
        $repository = $this->getDoctrine()->getRepository('App:User');
        $user = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $this->addFlash('success',"le compte de l'utilisateur a été supprimé avec succés !");
        return $this->redirect($this->generateUrl('admin.user'));
    }
}
