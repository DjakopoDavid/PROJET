<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(SessionInterface $sessionInterface, ArticleRepository $articleRepository)
    {
        $panier = $sessionInterface->get("panier", []);
        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantite){
            $article = $articleRepository->find($id);
            $dataPanier[] = [
                "article" => $article,
                "quantite" => $quantite
            ];
            $total += $article->getPrix() * $quantite;

        }
        return $this->render('cart/cart.html.twig', compact("dataPanier", "total")
        );
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Article $article, SessionInterface $sessionInterface)
    {
        $panier = $sessionInterface->get("panier", []);
        $id = $article->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
            $sessionInterface->set("panier", $panier);

        return $this->redirectToRoute('cart');

    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Article $article, SessionInterface $sessionInterface)
    {
        $panier = $sessionInterface->get("panier", []);
        $id = $article->getId();

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }
        $sessionInterface->set("panier", $panier);

        return $this->redirectToRoute('cart');

    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Article $article, SessionInterface $sessionInterface)
    {
        $panier = $sessionInterface->get("panier", []);
        $id = $article->getId();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $sessionInterface->set("panier", $panier);

        return $this->redirectToRoute('cart');

    }

    #[Route('/delete', name: 'delete_all')]
    public function deleteAll(Article $article, SessionInterface $sessionInterface)
    {
        $sessionInterface->remove("panier");

        return $this->redirectToRoute('cart');

    }
}
