<?php

namespace App\Controller;

use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie/location', name: 'app_categorie_location')]
    public function location(BienRepository $bienRepository): Response
    {
        return $this->render('bien/index.html.twig', [
            'lesBiens' => $bienRepository->findBy(["is_locatif" => "1"]),
        ]);
    }

    #[Route('/categorie/achat', name: 'app_categorie_achat')]
    public function achat(BienRepository $bienRepository): Response
    {
        return $this->render('bien/index.html.twig', [
            'lesBiens' => $bienRepository->findBy(["is_locatif" => "0"]),
        ]);
    }
}
