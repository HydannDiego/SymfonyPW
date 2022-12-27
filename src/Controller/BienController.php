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
            $intitCateg =$categorieRepository->affichageIntit($id);
            $type = $_GET["Type"];
            $intitType = ($type == 0) ? 'Achat' : 'Location';
            if ($id == "") {
                if ($type == "") {
                    return $this->render('bien/index.html.twig', [
                        'lesBiens' => $bienRepository->findAll(),
                        'lesCateg' => $categorieRepository->findAll(),
                        'titre' => 'Affichage des biens'
                    ]);
                } else {
                    return $this->render('bien/index.html.twig', [
                        'lesBiens' => $bienRepository->findBy(['is_locatif' => $type]),
                        'lesCateg' => $categorieRepository->findAll(),
                        'titre' => "Affichage Catégorie : ".$intitType,
                    ]);
                }
            } else if ($type == "") {
                return $this->render('bien/index.html.twig', [
                    'lesBiens' => $bienRepository->findBy(['id_categorie' => $id]),
                    'lesCateg' => $categorieRepository->findAll(),
                    'titre' => "Affichage Catégorie : ".$intitCateg[0]["intitule"],
                ]);
            } else {
                return $this->render('bien/index.html.twig', [
                    'lesBiens' => $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type]),
                    'lesCateg' => $categorieRepository->findAll(),
                    'titre' => "Affichage Catégorie : ".$intitCateg[0]["intitule"]." et ".$intitType,
                ]);
            }
        } else {
            return $this->render('bien/index.html.twig', [
                'lesBiens' => $bienRepository->findAll(),
                'lesCateg' => $categorieRepository->findAll(),
                'titre' => 'Affichage des biens'
            ]);
        }
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
