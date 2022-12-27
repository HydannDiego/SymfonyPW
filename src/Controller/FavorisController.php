<?php

namespace App\Controller;

use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class FavorisController extends AbstractController
{
    #[Route('/favoris/ajout/{id}', name: 'app_favoris')]
    public function index(int $id, CategorieRepository $categorieRepository, BienRepository $bienRepository): Response
    {
        $unBien = $bienRepository->findBy(["id" => $id]);
        if (!isset($session)) {
            $session = new Session();
            $session->set('idSession', rand(0, 9999));
        }
        $tab = $session->get('tabFav');
        $tabId = $session->get('tabId');

        $i = 0;
        $ajout = true;
        if ($tabId == null) {
            $tab[] = $unBien;
            $tabId[] = $id;
        } else {
            while ($i < count($tabId)) {
                if ($tabId[$i] == $id) {
                    $ajout = false;
                }
                $i++;
            }
        }
        if ($ajout) {
            $tab[] = $unBien;
            $tabId[] = $id;
        }

        $session->set('tabFav', $tab);
        $session->set('tabId', $tabId);

        return $this->render('bien/show.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'bien' => $bienRepository->find($id),
        ]);
    }

    #[Route('/favoris/voir', name: 'app_voir')]
    public function voir(): Response
    {
        return $this->render('favoris/index.html.twig', [
        ]);
    }

    #[Route('/favoris/envoie', name: 'app_envoie')]
    public function envoie(): Response
    {
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
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Voici vos differents favoris';
            $mail->Body    = 'Oui';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return $this->render('favoris/index.html.twig', [
        ]);
    }


}
