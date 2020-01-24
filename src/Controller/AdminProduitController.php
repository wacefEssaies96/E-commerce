<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProduitType;
use App\Entity\Produits;
use Symfony\Component\HttpFoundation\Request;

class AdminProduitController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_produit")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list = $repository->findAll();
        return $this->render('admin_produit/index.html.twig', [
            'controller_name' => 'AdminProduitController',
            'produits' => $list
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
            $this->addFlash('success', 'Produit ajouté avec succées');
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_produit'));
        }
        return $this->render('admin_produit/ajouter.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
