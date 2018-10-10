<?php

namespace App\Controller;


use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Service\Orders;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    /**
     * @Route("/order", name="order")
     */
    public function index()
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route ("/orders/add-to-cart/{id}/{quantity}", name="orders_add_to_cart")
     *
     * @throws
     */
    public function addToCart(Product $product, Orders $orders, Request $request, $quantity = 1)
    {
        $orders->addToCart($product, $quantity);

        if ($request->isXmlHttpRequest()) {
            return $this->cartInHeader($orders);
        }
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/orders/cart-in-header", name="orders_cart_in_header")
     *
     * @throws
     */
    public function cartInHeader(Orders $orders)
    {
        $cart = $orders->getCartFromSession();
        return $this->render('orders/cart_in_header.html.twig', ['cart' => $cart]);
    } // - это метод

    /**
     * @Route("orders/cart", name="orders_cart")
     *
     * @throws
     */
    public function cart(Orders $orders)
    {
        $cart = $orders->getCartFromSession();
        $items = $orders->getCartFromSession()->getItems();
        return $this->render('orders/cart.html.twig',
            ['cart' => $cart, 'items' => $items]);
    }

    /**
     * @Route("/cart/update-quantity/{id}", name="orders_update_item_quantity")
     */
    public function updateItemQuantity(OrderItem $item, Orders $orders, Request $request)
    {
        $quantity = (int)$request->request->get('quantity');

        if ( $quantity < 1 || $quantity > 1000 ) {
            throw new \InvalidArgumentException();
        }

        $cart = $orders->updateItemQuantity($item, $quantity);

        return new JsonResponse(
            $this->renderView('orders/cart.json.twig', ['cart' => $cart]),
            200,
            [],
            true
        );
    }

    /**
     * @Route("/cart/remove-item/{id}", name="orders_remove_item")
     */
    public function removeItem(OrderItem $item, Orders $orders, Request $request)
    {
        $cart = $orders->removeItem($item);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(
                $this->renderView('orders/cart.json.twig', ['cart' => $cart]),
                200,
                [],
                true
            );
        }

        return $this->redirectToRoute('orders_cart');
    }
}
