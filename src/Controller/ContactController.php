<?php

namespace App\Controller;

use App\Entity\Contact;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;


class ContactController extends AbstractController
{

    /**
     * Nous créons un nouvel objet de contact, créons un formulaire, gérons la réponse du formulaire, puis on renvoie le
     * formulaire
     *
     * @param Request request L'objet de la requête.
     * @param EntityManagerInterface entityManager C'est le service qui nous permet d'interagir avec la base de données.
     *
     * @return Response Le formulaire est renvoyé.
     */
    #[Route('/contact', name: 'app_contact')]
    public function createAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactFormType::class, $contact)
            ->add('nom', TextType::class, array('label' => 'Nom', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('email', EmailType::class, array('label' => 'Email', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')));
        /*->add('Save', SubmitType::class, array('label'=> 'Submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))*/

        # Handle form response
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nom = $form['nom']->getData();
            $email = $form['email']->getData();

            $validator = Validation::createValidator();
            $constraints = [
                new Assert\Length([
                    'min' => 3,
                    'max' => 20,
                ]),
                new Assert\NotBlank(),
            ];

            $violations = $validator->validate($nom, $constraints);

            if (0 !== count($violations)) {
                // there are errors
                echo '<script>alert("Error!")</script>';
            } else {

                $contact->setNom($nom);
                $contact->setEmail($email);

                $entityManager->persist($contact);
                $entityManager->flush();

                return $this->redirectToRoute("home");
            }
        }

        return $this->render('contact/index.html.twig', [
            'ContactForm' => $form->createView(),
        ]);
    }
}
