<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Panier;

class AdminCommandController extends AbstractController
{
    /**
     * @Route("/admin/command", name="admin_command")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository('App:Panier');
        $list = $repository->findAllOrderBy();
        return $this->render('admin_command/index.html.twig', [
            'list' => $list
        ]);
    }
    /**
     * @Route("/admin/command/confirm/{id}", name="admin.confirm")
     */

     public function confirm($id){
        $repository = $this->getDoctrine()->getRepository('App:Panier');
        $em = $this->getDoctrine()->getManager();
        $panier = $repository->find($id);
        $em->remove($panier);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_command'));
    }
}
