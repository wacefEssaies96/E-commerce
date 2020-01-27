<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findAll();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'list' => $list_produits,
        ]);
    }
}
