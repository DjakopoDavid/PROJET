<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home',  name: 'home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('home/index.html.twig',  [
            "articles" => $articleRepository->findAll()
        ]);
    }


    public function menuAction(): Response
    {
        $args = array(
            'items' => array('connexion/déconnexion', 'Acceuil', 'Produits', 'Contactez-nous', 'Panier'),
        );
        return $this->render('menu.html.twig', $args);
    }
}
