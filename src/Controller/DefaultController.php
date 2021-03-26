<?php

namespace App\Controller;

use App\Service\Products;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Products $productsService) {

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'products' => $productsService->getAll(),
        ]);
    }

    /**
     * @Route ("/search", name="search")
     */
    public function search(Request $request, ProductRepository $repository)
    {
        $query = $request->query->get('p');

        if ($query) {
            $products = $repository->findByName($query);
        } else {
            $products = [];
        }

        return $this->render('default/search.html.twig', [
           'products' => $products,
        ]);
    }
}
