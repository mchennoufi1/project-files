<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Category;
use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PizzaController extends AbstractController
{

    #[Route('/pizza/{id}', name: 'app_pizza')]
    public function index(Category $category, PizzaRepository $pizzaRepository, Request $request): Response
    {
        $pizzas = $pizzaRepository->findByCategory($category);

        $order = new Order();

        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $order = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();
            $orderId = $order->getId();
            $request->getSession()->set('order_id', $orderId);

            return $this->redirectToRoute('app_thank_you', ['orderId' => $orderId]);
        }


        return $this->render('pizza/index.html.twig', [
            'category' => $category,
            'pizzas' => $pizzas,
            'form' => $form->createView(),
        ]);

    }

    #[Route('/thank-you/{orderId}', name: 'app_thank_you')]
    public function thankYou(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orderId = $request->getSession()->get('order_id');
        if (!$orderId) {
            throw $this->createNotFoundException('Order not found');
        }

        $order = $entityManager->getRepository(Order::class)->find($orderId);
        if (!$order) {
            throw $this->createNotFoundException('Order not found');
        }

        return $this->render('pizza/thank_you.html.twig', [
            'order' => $order,
        ]);
    }


}
