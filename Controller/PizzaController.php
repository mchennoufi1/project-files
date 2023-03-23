<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/1");
     * @Route("/2");
     * @Route("/3");
     */
    public function index(PizzaRepository $pizzaRepository): Response
    {
        $pizza = $pizzaRepository->findAll();
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
            'pizza' => $pizza
        ]);

    }
}
