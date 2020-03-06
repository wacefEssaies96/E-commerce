<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProduitType;
use App\Entity\Produits;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class AdminProduitController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_produit")
     */
    public function index(PaginatorInterface $paginator,Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page',1),
            6
        );
        return $this->render('admin_produit/index.html.twig', [
            'produits' => $list_produits
        ]);
    }
    /**
    * @Route("/admin/edit/{id}", name="admin.edit" )
    */
    public function edit($id,Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $produit = $repository->find($id);
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $this->addFlash('success', 'Produit modifié avec succées');
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_produit'));
        }
        return $this->render('admin_produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }
    /**
    * @Route("/admin/ajouter", name="admin.ajouter" )
    */
    public function ajouter(Request $request)
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $this->addFlash('test', 'Produit ajouté avec succées');
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_produit'));
        }
        return $this->render('admin_produit/ajouter.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
    * @Route("/admin/supp/{id}", name="admin.supp")
    */
    public function supprimer($id){

        $produit = $this->getDoctrine()->getRepository('App:Produits')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        $this->addFlash('success', 'Produit a été supprimé avec succées');
        return $this->redirect($this->generateUrl('admin_produit'));
    }
}
