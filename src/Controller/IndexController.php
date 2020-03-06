<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\User;
use App\Entity\ProduitSearch;
use App\Entity\Panier;
use App\Form\ProduitSearchType;
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
        $search = new ProduitSearch();
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $form = $this->createForm(ProduitSearchType::class,$search);
       
        $form->handleRequest($request);
        $list_produits = $paginator->paginate(
            $repository->findAllT($search),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
            'form' =>$form->createView()
        ]);
    }
    /**
     * @Route("/index/categorie/ordinateurs", name="index.categorie.ordinateurs")
    */
    public function categorieOrdinateurs(PaginatorInterface $paginator,Request $request){
        $search = new ProduitSearch();
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $form = $this->createForm(ProduitSearchType::class, $search);

        $form->handleRequest($request);
        $list_produits = $paginator->paginate(
            $repository->findAllCategorie($search,0),
            $request->query->getInt('page',1),
            6
        );
        
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
            'form' =>$form->createView()
        ]);
    }
    /**
     * @Route("/index/categorie/ecrans", name="index.categorie.ecrans")
    */
    public function categorieEcrans(PaginatorInterface $paginator,Request $request){
        $search = new ProduitSearch();
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $form = $this->createForm(ProduitSearchType::class, $search);

        $form->handleRequest($request);
        $list_produits = $paginator->paginate(
            $repository->findAllCategorie($search,1),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
            'form' =>$form->createView()
        ]);
    }
    /**
     * @Route("/index/categorie/claviers", name="index.categorie.claviers")
    */
    public function categorieClaviers(PaginatorInterface $paginator,Request $request){
        $search = new ProduitSearch();
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $form = $this->createForm(ProduitSearchType::class, $search);

        $form->handleRequest($request);
        $list_produits = $paginator->paginate(
            $repository->findAllCategorie($search,2),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
            'form' =>$form->createView()
        ]);
    }
     /**
     * @Route("/index/categorie/souris", name="index.categorie.souris")
    */
    public function categorieSouris(PaginatorInterface $paginator,Request $request){
        $search = new ProduitSearch();
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $form = $this->createForm(ProduitSearchType::class, $search);

        $form->handleRequest($request);
        $list_produits = $paginator->paginate(
            $repository->findAllCategorie($search,3),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('index/index.html.twig', [
            'list' => $list_produits,
            'form' =>$form->createView()
        ]);
    }
    /**
     * @Route("/index/{id}", name="index.ajouter.panier")
     */
    public function ajouterAuPanier($id){

        if($this->getUser()){
            $repository = $this->getDoctrine()->getRepository('App:Panier');
            $repositoryProduits = $this->getDoctrine()->getRepository('App:Produits');
            $exist = $repository->findOneBy(array('pid' => $id,'uid' => $this->getUser()->getId(), 'confirm' => 0));
            $produit = $repositoryProduits->find($id);
            $qtt = $produit->getQtt();
            if($exist == null && $qtt > 0){
                $panier = new Panier();
                $user = $this->getUser();
                $panier->setUid($user);
                $panier->setPid($produit);
                $panier->setQtt(1);
                $panier->setLiv(0);
                $panier->setConfirm(0);
                $em = $this->getDoctrine()->getManager();
                $em->persist($panier);
                $em->flush();
                $this->addFlash('success','Le produit a été ajouté dans votre panier !');
            }
            if($exist != null){
                $this->addFlash('error','Le produit est deja dans votre panier !');
            }
            if($qtt == 0){
                $this->addFlash('error','Le produit est en repture !');
            }
        }else{
           return $this->redirect($this->generateUrl('app_login'));
        }
        
        return $this->redirect($this->generateUrl('index'));
    }
}
