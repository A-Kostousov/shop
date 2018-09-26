<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    /**
     * @Route("/order", name="order")
     */
    public function index() {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route ("/orders/add-to-cart/{id}/{quantity}", name="orders_add_to_cart")
     *
     * @throws
     */
    public function addToCart(Product $product, Orders $orders, Request $request, $quantity = 1) {
        $orders->addToCart($product, $quantity);

        return $this->redirect($request->headers->get('referer'));
    }
}
