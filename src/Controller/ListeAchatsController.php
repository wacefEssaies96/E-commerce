<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListeAchatsController extends AbstractController
{
    /**
     * @Route("/liste/achats", name="liste_achats")
     */
    public function index()
    {
        
        return $this->render('liste_achats/index.html.twig', [
            'controller_name' => 'ListeAchatsController',
        ]);
    }
}
