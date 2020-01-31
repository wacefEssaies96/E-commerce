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
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findAll();
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
    /**
     * @Route("/index/categorie/ordinateurs", name="index.categorie.ordinateurs")
    */
    public function categorieOrdinateurs(){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findBy(array('categorie' => 0));
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
    /**
     * @Route("/index/categorie/ecrans", name="index.categorie.ecrans")
    */
    public function categorieEcrans(){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findBy(array('categorie' => 1));
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
    /**
     * @Route("/index/categorie/claviers", name="index.categorie.claviers")
    */
    public function categorieClaviers(){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findBy(array('categorie' => 2));
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
     /**
     * @Route("/index/categorie/souris", name="index.categorie.souris")
    */
    public function categorieSouris(){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findBy(array('categorie' => 3));
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
}
