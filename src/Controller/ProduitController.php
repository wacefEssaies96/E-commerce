<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PanierType;
use App\Entity\Panier;
class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/{id}", name="produit.show")
     */
    public function show($id,Request $request){
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $produit = $repository->find($id);

        $form = $this->createForm(PanierType::class);        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){

            $panier = new Panier();
            
            $qtt = $form['qtt']->getData();
            $liv = $form['liv']->getData();
            $user = $this->getUser();
            if($user == null){
                return $this->redirect($this->generateUrl('app_login'));
            }
            else{
                $panier->setUserId($user->getId());
                $panier->setProdId($id);
                $panier->setQtt($qtt);
                $panier->setLiv($liv);


                $em = $this->getDoctrine()->getManager();
                $em->persist($panier);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('index'));
        }

        

        return $this->render('produit/index.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),

        ]);
    }
    
}
