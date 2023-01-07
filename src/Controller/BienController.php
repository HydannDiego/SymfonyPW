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
    /**
     * Si l'utilisateur a sélectionné une catégorie, un type et un emplacement, alors nous affichons les propriétés
     * correspondantes. Sinon, nous affichons toutes les propriétés
     *
     * @param BienRepository bienRepository Le référentiel de l'entité Bien.
     * @param CategorieRepository categorieRepository Le référentiel de l'entité Catégorie.
     *
     * @return Response La fonction index renvoie le rendu du fichier index.html.twig.
     */
    public function index(BienRepository $bienRepository, CategorieRepository $categorieRepository): Response
    {

        if (!empty($_POST['Price'])) {
            $price = $_POST['Price'];
        } else {
            $price = 999999;
        }


        if (isset($_POST["Categ"]) && isset($_POST["Type"]) && isset($_POST["local"])) {

            $id = $_POST["Categ"];
            $type = $_POST["Type"];
            $local = $_POST["local"];


            $intitCateg = $categorieRepository->affichageIntit($id);
            $intitType = ($type == 0) ? 'Achat' : 'Location';


            if ($id == "") {
                if ($type == "") {
                    if ($local == "") {
                        $lesBiens = $bienRepository->findAll();
                        $titre = 'Affichage des biens';
                    } else {
                        $lesBiens = $bienRepository->findBy(['cp' => $local]);
                        $titre = "Affichage Localisation : " . $local;
                    }
                } else {
                    if ($local == "") {
                        $lesBiens = $bienRepository->findBy(['is_locatif' => $type]);
                        $titre = 'Affichage ' . $intitType;
                    } else {
                        $lesBiens = $bienRepository->findBy(['is_locatif' => $type, 'cp' => $local]);
                        $titre = "Affichage " . $intitType . " à : " . $local;
                    }
                }
            } elseif ($type == "") {
                if ($local == "") {
                    $lesBiens = $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type]);
                    $titre = "Affichage Catégorie : " . $intitCateg[0]["intitule"];
                } else {
                    $lesBiens = $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type, 'cp' => $local]);
                    $titre = "Affichage : " . $intitCateg[0]["intitule"] . " à : " . $local;
                }
            } else {
                if ($local == "") {
                    $lesBiens = $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type]);
                    $titre = "Affichage : " . $intitCateg[0]["intitule"] . " en " . $intitType;
                } else {
                    $lesBiens = $bienRepository->findBy(['id_categorie' => $id, 'is_locatif' => $type, 'cp' => $local]);
                    $titre = "Affichage Catégorie : " . $intitCateg[0]["intitule"] . " et " . $intitType . " à : " . $local;
                }

            }
        } else {
            $lesBiens = $bienRepository->findAll();
            $titre = 'Affichage des biens';
        }

        return $this->render('bien/index.html.twig', [
            'lesBiens' => $lesBiens,
            'lesCateg' => $categorieRepository->findAll(),
            'localisation' => $bienRepository->getLocalisation(),
            'titre' => $titre,
            'prix' => $price,
        ]);
    }

    /**
     * Il prend l'identifiant d'un bien, trouve le bien dans la base de données et affiche le modèle show.html.twig avec
     * les variables bien et categories
     *
     * @param CategorieRepository categorieRepository C'est le service que nous avons créé à l'étape précédente.
     * @param BienRepository bienRepository Il s'agit du référentiel de l'entité Bien.
     * @param int id L'identifiant du bien à afficher
     *
     * @return Response Le modèle show.html.twig est renvoyé.
     */
    #[Route('/bien/{id}', name: 'app_bien_show')]
    public function show(CategorieRepository $categorieRepository, BienRepository $bienRepository, int $id): Response
    {
        return $this->render('bien/show.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'bien' => $bienRepository->find($id),
        ]);
    }
}
