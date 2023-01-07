<?php

namespace App\Controller;

use App\Entity\UserFav;
use App\Form\UserFavType;
use App\Repository\UserFavRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/GererFav')]
class UserFavCrudController extends AbstractController
{
    #[Route('/', name: 'app_user_fav_crud_index', methods: ['GET'])]
    public function index(UserFavRepository $userFavRepository): Response
    {
        return $this->render('user_fav_crud/index.html.twig', [
            'user_favs' => $userFavRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_fav_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserFavRepository $userFavRepository): Response
    {
        $userFav = new UserFav();
        $form = $this->createForm(UserFavType::class, $userFav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userFavRepository->save($userFav, true);

            return $this->redirectToRoute('app_user_fav_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_fav_crud/new.html.twig', [
            'user_fav' => $userFav,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_fav_crud_show', methods: ['GET'])]
    public function show(UserFav $userFav): Response
    {
        return $this->render('user_fav_crud/show.html.twig', [
            'user_fav' => $userFav,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_fav_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserFav $userFav, UserFavRepository $userFavRepository): Response
    {
        $form = $this->createForm(UserFavType::class, $userFav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userFavRepository->save($userFav, true);

            return $this->redirectToRoute('app_user_fav_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_fav_crud/edit.html.twig', [
            'user_fav' => $userFav,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_fav_crud_delete', methods: ['POST'])]
    public function delete(Request $request, UserFav $userFav, UserFavRepository $userFavRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userFav->getId(), $request->request->get('_token'))) {
            $userFavRepository->remove($userFav, true);
        }

        return $this->redirectToRoute('app_user_fav_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
