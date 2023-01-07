<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\BienRepository;
use App\Repository\CategorieRepository;
use App\Repository\ContactRepository;
use App\Repository\UserFavRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/stats')]
class StatsController extends AbstractController
{
    /**
     * @throws Exception
     */
    /**
     * On renvoie une réponse qui affiche un modèle
     *
     * @param CategorieRepository categorieRepository le référentiel de l'entité catégorie
     * @param BienRepository repository la classe de référentiel de l'entité dont vous souhaitez afficher les statistiques
     * @param ContactRepository contactRepository le référentiel de l'entité Contact
     * @param UserFavRepository userFavRepository le référentiel de l'entité userFav
     * @param UserRepository userRepository le référentiel de l'entité Utilisateur
     */
    #[Route('/', name: 'stats', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository,
                          BienRepository $repository,
                          ContactRepository $contactRepository,
                          UserFavRepository $userFavRepository,
                          UserRepository $userRepository,
    ): Response
    {
        return $this->render('stats/stats.html.twig', [
            'countSorted' => $categorieRepository->countSorted(),
            'countByCity' => $categorieRepository->countByCity(),
            'countByCode' => $categorieRepository->countByCode(),
            'categories' => $categorieRepository->findAll(),
            'biens' => $repository->findAll(),
            'contacts' => $contactRepository->findAll(),
            'userFavs' => $userFavRepository->findAll(),
            'countByDay' => $userFavRepository->countByDay(),
            'countByMonth' => $userFavRepository->countByMonth(),
            'countByYear' => $userFavRepository->countByYear(),
            'biensByFavorite' => $userFavRepository->biensByFavorite(),
            'biensByDepartment' => $userFavRepository->biensByDepartment(),
            'countByBienOrdered' => $userFavRepository->countByBienOrdered(),
            'users' => $userRepository->findAll(),
        ]);
    }
}