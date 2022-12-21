<?php

namespace App\Controller;

use App\Entity\Contact;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
        $form = $this->createForm(ContactFormType::class, $contact)
            ->add('nom', TextType::class, array('label'=> 'Nom', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('email', EmailType::class, array('label'=> 'Email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')));
        /*->add('Save', SubmitType::class, array('label'=> 'Submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))*/

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
