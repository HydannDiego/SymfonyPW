<?php

namespace App\Controller;

use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{
    #[Route('/bien', name: 'app_bien')]
    public function index(BienRepository $bienRepository): Response
    {
        return $this->render('bien/index.html.twig', [
            'lesBiens' => $bienRepository->findAll(),
        ]);
    }

    #[Route('/bien/{id}', name: 'app_bien_show')]
    public function show(BienRepository $bienRepository, int $id): Response
    {
        return $this->render('bien/show.html.twig', [
            'bien' => $bienRepository->find($id),
        ]);
    }
}
