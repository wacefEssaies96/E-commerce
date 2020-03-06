<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            // $message = (new \Swift_Message('test'))
            //     ->setTo('wacef.stratrait@gmail.com')
            //     ->setBody(
            //         $this->renderView(
            //             'email/test.html.twig',[

            //             ],
            //             'text/html'
            //         )
            //     );
            //     $mailer->send($message);
            $this->addFlash('success','Votre E-mail a été envoyé avec succés !');
            return $this->redirect($this->generateUrl('index'));
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
