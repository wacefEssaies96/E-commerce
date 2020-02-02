<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\Panier;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PanierType;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier.produits")
     */
    public function panier(Request $request)
    {  
        if($this->getUser() == false){
            return $this->redirect($this->generateUrl('app_login'));
        }
        $user = $this->getUser()->getId();
        $repositoryPanier = $this->getDoctrine()->getRepository('App:Panier');
        $panier = $repositoryPanier->findByProduits($user);
        $total = 0;
      
        if(!empty($panier)){
            foreach ($panier as $item){
                $total += $item['prix'];
            }
        }
        $form = $this->createFormBuilder()
            ->add('Confirmer',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->getForm();
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if($form->isSubmitted()){
            $length = $repositoryPanier->findBy(array('userId' => $user));
            for($i=0;$i<sizeof($length);$i++){
                $item = $repositoryPanier->findOneBy(array('userId' => $user));
                $em->remove($item);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('panier.produits'));
        }
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'total' => $total,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/panier/supp/{id}", name="panier.supp")
     */
    public function supprimer($id){
        $panier = $this->getDoctrine()->getRepository('App:Panier')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($panier);
        $em->flush();
        return($this->redirect($this->generateUrl('panier.produits')));
    }
    /**
     * @Route("/panier/edit/{id}/{prodId}", name="panier.edit")
     */
    public function modifier(Request $request,$id,$prodId){

        $panierList = $this->getDoctrine()->getRepository('App:Panier');
        $produitList = $this->getDoctrine()->getRepository('App:Produits');
        
        $produit = $produitList->find($prodId);
        $panier = $panierList->find($id);
        $form = $this->createForm(PanierType::class,$panier);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($panier);
            $em->flush();
            return $this->redirect($this->generateUrl('panier.produits'));
        }
        return $this->render('panier/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
   
    }
}