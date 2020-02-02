<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\User;
use App\Entity\Panier;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(PaginatorInterface $paginator,Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
    /**
     * @Route("/index/categorie/ordinateurs", name="index.categorie.ordinateurs")
    */
    public function categorieOrdinateurs(PaginatorInterface $paginator,Request $request){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findBy(array('categorie' => 0));
        $list_produits = $paginator->paginate(
            $repository->findBy(array('categorie' => 0)),
            $request->query->getInt('page',1),
            6
        );
        
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
    /**
     * @Route("/index/categorie/ecrans", name="index.categorie.ecrans")
    */
    public function categorieEcrans(PaginatorInterface $paginator,Request $request){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $paginator->paginate(
            $repository->findBy(array('categorie' => 1)),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
    /**
     * @Route("/index/categorie/claviers", name="index.categorie.claviers")
    */
    public function categorieClaviers(PaginatorInterface $paginator,Request $request){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $paginator->paginate(
            $repository->findBy(array('categorie' => 2)),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
     /**
     * @Route("/index/categorie/souris", name="index.categorie.souris")
    */
    public function categorieSouris(PaginatorInterface $paginator,Request $request){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $paginator->paginate(
            $repository->findBy(array('categorie' => 3)),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
        ]);
    }
    /**
     * @Route("/index/{id}", name="index.ajouter.panier")
     */
    public function ajouterAuPanier($id){

        if($this->getUser()){
            $panier = new Panier();
            $panier->setUserId($this->getUser()->getId());
            $panier->setProdId($id);
            $panier->setQtt(1);
            $panier->setLiv(0);


            $em = $this->getDoctrine()->getManager();
            $em->persist($panier);
            $em->flush();
        }else{
           return $this->redirect($this->generateUrl('app_login'));
        }


        $this->addFlash('success','Le produit a été ajouté dans votre panier !');
        return $this->redirect($this->generateUrl('index'));
    }
}
