<?php

namespace App\Controller;

use Doctrine\DBAL\DriverManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/panel', name: 'admin_panel')]
    public function home() : Response
    {
        return $this->render('dashboard.html.twig');
    }
}