<?php

namespace App\Controller;

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

            $intitCateg = $categorieRepository->affichageIntit($id);
            $intitType = ($type == 0) ? 'Achat' : 'Location';

            if ($id == "") {
                if ($type == "") {
                    $lesBiens = $bienRepository->findAll();
                    $titre = 'Affichage des biens';
                } else {
                    $lesBiens = $bienRepository->findBy(['is_locatif' => $type]);
                    $titre = "Affichage Catégorie : " . $intitType;
                }
            } elseif ($type == "") {
                $lesBiens = $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type]);
                $titre = "Affichage Catégorie : " . $intitCateg[0]["intitule"];
            } else {
                $lesBiens = $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type]);
                $titre = "Affichage Catégorie : " . $intitCateg[0]["intitule"] . " et " . $intitType;
            }
        } else {
            $lesBiens = $bienRepository->findAll();
            $titre = 'Affichage des biens';

        }

        return $this->render('bien/index.html.twig', [
            'lesBiens' => $lesBiens,
            'lesCateg' => $categorieRepository->findAll(),
            'titre' => $titre,
        ]);
    }

    #[Route('/bien/{id}', name: 'app_bien_show')]
    public function show(CategorieRepository $categorieRepository, BienRepository $bienRepository, int $id): Response
    {
        return $this->render('bien/show.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'bien' => $bienRepository->find($id),
        ]);
    }
}
