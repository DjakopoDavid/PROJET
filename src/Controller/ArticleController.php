<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ArticleController extends AbstractController
{
    #[Route('article/list', name: 'list')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            "articles" => $articleRepository->findAll()
            ]
        );
    }

        #[Route('article/new', name: 'new')]
    public function new(Request $request): Response

    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('list');
        }
        return $this->render('article/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    #[Route('{id}/article/show', name: 'show')]
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            "article" => $article
            ]
        );
    }

    #[Route('{id}/article/edit', name: 'edit')]
    public function edit(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('list');
        }
        return $this->render('article/edit.html.twig', [
                "form" => $form->createView()
            ]
        );
    }
}
