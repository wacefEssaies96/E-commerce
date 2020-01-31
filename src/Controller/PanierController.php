<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Entity\Panier;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier.produits")
     */
    public function panier()
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
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'total' => $total
        ]);
    }
}
