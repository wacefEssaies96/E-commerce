<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\AjouterAuPanier;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('App:Produits');
        $list_produits = $repository->findAll();
        
        $user = $this->getUser();
        $panier = new AjouterAuPanier();

        $form = $this->createForm(SubmitType::class, $panier);
        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));
    
            if ($form->isSubmitted() && $form->isValid()) {
                // perform some action...
    
                return $this->redirectToRoute('task_success');
            }
        }




        // $formm = $this->createFormBuilder()->add('test',SubmitType::class,['attr'=>['class'=>'btn btn-success']])->getForm();
        // $bouton = $this->get('achat');

        // if($bouton->isSubmitted()){
        //     $this->addFlash('success','ceci est un test');
        // } 
        
        
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'list' => $list_produits,
            'name' => $user,
            'form' => $form->createView()
            // 'test' => $builder->createView()

        ]);
    }
}
