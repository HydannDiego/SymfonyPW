<?php

namespace App\Controller;

use Doctrine\DBAL\DriverManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    #[Route('/', name: 'home')]
    public function home() : Response
    {
        return $this->render('body.html.twig');
    }

    /**
     * @Route("/categories", name="categories")
     * @return Response
     */
    #[Route('/categories', name: 'categories')]
    public function categories() : Response
    {
        return $this->render('categories.html.twig');
    }

    /**
     * @Route("/about", name="about")
     * @return Response
     */
    #[Route('/about', name: 'about')]
    public function about() : Response
    {
        return $this->render('body.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @return Response
     */
    #[Route('/contact', name: 'contact')]
    public function contact() : Response
    {
        return $this->render('body.html.twig');
    }
}