<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'article')]
    public function index(): Response
    {
        $articles = new Article();
        $articles->setLibelle('mon article');
        $articles->setPrix(250);
        $articles->setQuantite(20);
        $articles->setImage('img');
        return $this->render('article/index.html.twig',[
            'article' => $articles
            ]
        );
    }
}
