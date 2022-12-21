<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Categorie;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienController extends AbstractController
{
    #[Route('/bien', name: 'app_bien')]
    public function index(BienRepository $bienRepository, CategorieRepository $categorieRepository): Response
    {

        if (isset($_GET["Categ"]) && isset($_GET["Type"])) {
            $id = $_GET["Categ"];
            $type = $_GET["Type"];
            if ($id == "") {
                if ($type == "") {
                    return $this->render('bien/index.html.twig', [
                        'lesBiens' => $bienRepository->findAll(),
                        'lesCateg' => $categorieRepository->findAll(),
                    ]);
                } else {
                    return $this->render('bien/index.html.twig', [
                        'lesBiens' => $bienRepository->findBy(['is_locatif' => $type]),
                        'lesCateg' => $categorieRepository->findAll(),
                    ]);
                }
            } else if ($type == "") {
                return $this->render('bien/index.html.twig', [
                    'lesBiens' => $bienRepository->findBy(['id_categorie' => $id]),
                    'lesCateg' => $categorieRepository->findAll(),
                ]);
            } else {
                return $this->render('bien/index.html.twig', [
                    'lesBiens' => $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type]),
                    'lesCateg' => $categorieRepository->findAll(),
                ]);
            }
        } else {
            return $this->render('bien/index.html.twig', [
                'lesBiens' => $bienRepository->findAll(),
                'lesCateg' => $categorieRepository->findAll(),
            ]);
        }
    }
}
