<?php

namespace App\Controller;

use App\Entity\Contact;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function createAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact;
        # Add form fields
        $form = $this->createForm(ContactFormType::class, $contact)
        ->add('nom', TextareaType::class, array('label'=> 'nom', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('email', TextareaType::class, array('label'=> 'email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Save', SubmitType::class, array('label'=> 'submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')));

        # Handle form response
        $form->handleRequest($request);

        if ($form->isSubmitted() &&  $form->isValid()) {
            $nom = $form['nom']->getData();
            $email = $form['email']->getData();

            $contact->setNom($nom);
            $contact->setEmail($email);

            $entityManager->persist($contact);
            $entityManager->flush();
        }

            return $this->render('contact/index.html.twig', [
            'ContactForm' => $form->createView(),
        ]);
    }
}
