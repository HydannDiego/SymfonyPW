<?php

namespace App\Controller;

use App\Entity\UserFav;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class FavorisController extends AbstractController
{
    /**
     * On récupère les éléments favoris de la session, récupère les données de chaque élément, puis restitue le modèle
     *
     * @param SessionInterface session L'objet de session
     * @param BienRepository bienRepository Il s'agit du référentiel de l'entité Bien.
     *
     * @return Response La page favorite est renvoyée.
     */
    #[Route('/favorite', name: 'app_favorite')]
    public function index(SessionInterface $session, BienRepository $bienRepository): Response
    {
        $favorite = $session->get('favorite', []);

        $favoriteWithData = [];

        foreach ($favorite as $id => $inFavorite) {
            $favoriteWithData[] = [
                'bien' => $bienRepository->find($id)
            ];
        }

        $session->set('items', $favoriteWithData);
        $items = $session->get('items', []);

        if ($items == null) {
            return $this->redirectToRoute("home");
        } else {
            return $this->render('favoris/index.html.twig', [
                'items' => $favoriteWithData
            ]);
        }
    }

    /**
     * Il obtient la variable de session favorite, ajoute l'identifiant du bien au tableau, puis le rajoute dans la
     * variable de session
     *
     * @param int id L'id du Bien à ajouter aux favoris
     * @param SessionInterface session L'objet de session.
     *
     * redirection vers la route nommée app_favorite
     */
    #[Route('/favorite/add/{id}', name: 'favorite_add')]
    public function add(int $id, SessionInterface $session)
    {
        $favorite = $session->get('favorite', []);

        $favorite[$id] = true;

        $session->set('favorite', $favorite);

        return $this->redirectToRoute("app_favorite");
    }

    /**
     * Il supprime le produit de la session
     *
     * @param int id L'identifiant du produit à supprimer de la liste des favoris.
     * @param SessionInterface session L'objet de session
     *
     * redirection vers la route "app_favorite"
     */
    #[Route('/favorite/remove/{id}', name: 'favorite_remove')]
    public function remove(int $id, SessionInterface $session)
    {
        $favorite = $session->get('favorite', []);

        if (!empty($favorite[$id])) {
            unset($favorite[$id]);
        }

        $session->set('favorite', $favorite);

        return $this->redirectToRoute("app_favorite");
    }

    /**
     * On envoie un email à l'utilisateur avec la liste de ses favoris
     *
     * @param EntityManagerInterface entityManager L'EntityManagerInterface est le point d'accès central à la
     * fonctionnalité ORM.
     * @param BienRepository bienRepository Le référentiel de l'entité Bien.
     * @param SessionInterface session L'objet de session.
     *
     * redirection vers la route "app_favorite"
     */
    #[Route('/favoris/envoie', name: 'app_envoie')]
    public function envoie(EntityManagerInterface $entityManager, BienRepository $bienRepository, SessionInterface $session)
    {
        $emailUser = $_GET["emailUser"];


        $user = new UserFav();
        $user->setEmailUser($emailUser);
        $user->setDateEnvoie(date('Y-m-d H:i:s'));

        $listeRef = "";
        $cpt = 0;
        $tabId = $session->get('favorite', []);


        /* Parcourir le tableau des éléments favoris et les ajouter au corps de l'e-mail. */
        foreach ($tabId as $key => $value) {
            $unBien = $bienRepository->find($key);
            $uneRef = $bienRepository->getRef($key);
            $user->addIdBien($unBien);
            $listeRef = $listeRef . "<u>" . "Reference du bien : " . "</u>" . " " . $uneRef[0]["ref"] . "</br>";
        }


        $entityManager->persist($user);
        $entityManager->flush();

        /* Il s'agit d'un bloc try catch. Il est utilisé pour intercepter les exceptions. */
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
            $mail->addAddress($emailUser, 'Utilisateur');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Voici vos differents favoris';
            $mail->Body = '<b>' . "Voici la liste des differentes ref de vos favoris :" . '</b>' . '</br>' . $listeRef;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return $this->redirectToRoute("app_favorite");
    }
}
