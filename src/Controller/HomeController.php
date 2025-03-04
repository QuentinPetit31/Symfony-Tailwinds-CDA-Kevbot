<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/inscription', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', []);
    }

    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('connexion.html.twig', []);
    }

    #[Route('/article', name: 'app_article')]
    public function article(): Response
    {
        return $this->render('article.html.twig', []);
    }


    
}
