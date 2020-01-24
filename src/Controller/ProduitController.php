<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit")
     */
    public function index()
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    /**
     * @Route("/produit/{slug}-{id}", name="produit.show" , requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show($slug,$id){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $produit = $repository->find($id);
        return $this->render('produit/index.html.twig', [
            'produit' => $produit
        ]);
    }
}
