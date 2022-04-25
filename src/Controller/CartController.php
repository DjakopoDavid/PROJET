<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(): Response
    {
        return $this->render('cart/cart.html.twig'
        );
    }

    #[Route('/add/{id}', name: 'panier')]
    public function add($id, SessionInterface $sessionInterface): Response
    {


    }
}
