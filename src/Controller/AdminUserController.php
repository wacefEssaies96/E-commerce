<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin.user")
     */
    public function index(PaginatorInterface $paginator,Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('App:User');
        $listUsers = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page',1),
            12
        );
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
