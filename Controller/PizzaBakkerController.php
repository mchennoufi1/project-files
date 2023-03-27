<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaBakkerController extends AbstractController
{
    #[Route('/pizza-bakker', name: 'app_pizza_bakker')]
    public function index(OrderRepository $OrderRepository): Response
    {
        $order = $OrderRepository->findAll();
        return $this->render('pizza_bakker/index.html.twig', [
            'controller_name' => 'OrderController',
            'order' => $order
        ]);
    }
}

