<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;

class AdminCommandController extends AbstractController
{
    /**
     * @Route("/admin/command", name="admin_command")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository('App:Commande');
        $list = $repository->findAllOrderBy();
        return $this->render('admin_command/index.html.twig', [
            'list' => $list
        ]);
    }
}
