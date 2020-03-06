<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Panier;
use App\Entity\Produits;
use App\Entity\Commande;
use App\Form\UserType;
use App\Form\PaiementType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement/{total}", name="paiement")
     */
    public function paiement($total,Request $request)
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }
        $user = $user->getId();
        $repoositoryUser = $this->getDoctrine()->getRepository('App:User');
        $userEdit = $repoositoryUser->findOneBy(array('id' => $user));
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $data = (array)$form->getData();
            $userEdit->setTel($data["\x00App\Entity\User\x00tel"]);
            $userEdit->setAdresse($data["\x00App\Entity\User\x00adresse"]);
            $userEdit->setCodePostal($data["\x00App\Entity\User\x00codePostal"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($userEdit);
            $em->flush();
            return $this->redirect($this->generateUrl('cb'));  
        }
        return $this->render('paiement/index.html.twig', [
           'form' => $form->createView() 
        ]);
    }
     /**
     * @Route("/cb", name="cb")
     */
    public function paimement_cb(Request $request){
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }
        $user = $user->getId();
        $form = $this->createForm(PaiementType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $repositoryPanier = $this->getDoctrine()->getRepository('App:Panier');
            $repositoryProduits = $this->getDoctrine()->getRepository('App:Produits');
            $em = $this->getDoctrine()->getManager();
            $panier = $repositoryPanier->findOrder($user);
            foreach($panier as $item){
                $item->setConfirm(1);
                $p = $item->getPid();
                $p->getId();
                $qttp = $p->getQtt(); 
                $qttc = $item->getQtt();
                $produit = $repositoryProduits->find($p);
                $p->setQtt($qttp-=$qttc);
                $em->persist($item);
                $em->persist($p);
                $em->flush();
            }
            
            $this->addFlash('success','Votre commande sera traité par un administrateur !');
            return $this->redirect($this->generateUrl('panier.produits'));
        }
        return $this->render('paiement/paiement.html.twig', [
            'form' => $form->createView()    
        ]);
    }
}
