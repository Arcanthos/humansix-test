<?php

namespace App\Controller;


use App\Repository\CartRowRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellerInterfaceController extends AbstractController
{
    /**
     * @Route("/", name="seller_interface")
     * @param OrderRepository $orderRepository
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function index(OrderRepository $orderRepository, ProductRepository $productRepository): Response
    {
        $orders = $orderRepository->findAll();
        $products = $productRepository->findAll();

        return $this->render('seller_interface/index.html.twig',[
            "orders"=>$orders,
            "products"=>$products
        ]);
    }

}
