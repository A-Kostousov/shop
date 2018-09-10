<?php
namespace App\Controller;
use App\Entity\Category;
use App\Service\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(Products $products)
    {
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $products->getAllCategory(),
        ]);
    }
    /**
     * @Route("/categories/{id}", name="category_show")
   */

    public function show(Category $category)
    {
        return $this->render('categories/show.html.twig',['category' => $category]);
    }
}