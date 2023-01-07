<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use App\Repository\ContactRepository;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/GererBien')]
class BienCRUDController extends AbstractController
{
    #[Route('/', name: 'app_bien_c_r_u_d_index', methods: ['GET'])]
    public function index(BienRepository $bienRepository): Response
    {
        return $this->render('bien_crud/index.html.twig', [
            'biens' => $bienRepository->findAll(),
        ]);
    }

    /* C'est la nouvelle fonction du BienCRUDController. Il est utilisé pour créer un nouveau bien. */
    #[Route('/new', name: 'app_bien_c_r_u_d_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BienRepository $bienRepository, ContactRepository $contactRepository): Response
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        /* C'est le code qui envoie un e-mail à tous les contacts de la base de données lorsqu'une nouvelle propriété est
        ajoutée. */
        if ($form->isSubmitted() && $form->isValid()) {
            $bienRepository->save($bien, true);
            $lesContacts = $contactRepository->findAll();
            foreach ($lesContacts as $contact) {
                try {
                    $mail = new PHPMailer;
                    $mail->isSMTP();                            // Set mailer to use SMTP
                    $mail->Host = 'smtp.mailtrap.io';           // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                     // Enable SMTP authentication
                    $mail->Username = 'b64dc9f9de43bb';       // SMTP username
                    $mail->Password = 'b8d29ee13ed6c6';         // SMTP password
                    $mail->Port = 2525;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('team.safer@safer.com', 'Mailer');
                    $mail->addAddress($contact->getEmail(), $contact->getNom());     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Un nouveau bien est disponible';
                    $mail->Body = 'Bonjour ' . $contact->getNom() . ',</br>' . 'Un nouveau bien est disponible dans notre catalogue.' . '</br>' . '</br>' . 'Voici les quelques informations concernant ce bien' . '</br>' . ' Titre : ' . $bien->getTitre() . '</br>' . ' Ville : ' . $bien->getVille() . '</br>' . 'Surface : ' . $bien->getSurface() . '</br>' . 'Ref : ' . $bien->getRef() . '</br>' . 'Prix : ' . $bien->getPrix() . '</br>' . '</br>' . 'Rendez-vous sur notre ' . '<a href="http://localhost:8000/bien/' . $bien->getId() . '">site</a>' . ' pour plus d\'informations';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            return $this->redirectToRoute('app_bien_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien_crud/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_c_r_u_d_show', methods: ['GET'])]
    public function show(Bien $bien): Response
    {
        return $this->render('bien_crud/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bien_c_r_u_d_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bien $bien, BienRepository $bienRepository): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bienRepository->save($bien, true);

            return $this->redirectToRoute('app_bien_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bien_crud/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bien_c_r_u_d_delete', methods: ['POST'])]
    public function delete(Request $request, Bien $bien, BienRepository $bienRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $bien->getId(), $request->request->get('_token'))) {
            $bienRepository->remove($bien, true);
        }

        return $this->redirectToRoute('app_bien_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
    }
}
