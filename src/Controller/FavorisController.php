<?php

namespace App\Controller;

use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
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


}
