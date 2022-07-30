<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    #[Route('/product', name: 'app_product')]
    public function index()
    {
        $product = $this->productRepository->findAll();
        dd($product);
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }


    /**
     * @Route("/addProduct", name="add_product", methods={"POST"})
     */


    #[Route('/addProduct', name: 'add_product', methods: "POST")]
    public function addProduct(Request $request)
    {
        $jsonData = json_encode($request->getContent());

        $this->productRepository->add($jsonData);
        return  new Response("created product");
    }


    #[Route('/deleteProduct/{id}', name: 'delete_product', methods: "DELETE")]
    public function delete($id) 
    {
        $product = $this->productRepository->findOneBy(['id' => $id]);
        $this->productRepository->remove($product);
        return new Response("deleted product");
    }


    #[Route('/updateProduct/{id}', name: 'update_product', methods: "PUT")]
    public function update($id) 
    {
        $product = $this->productRepository->findOneBy(['id' => $id]);
        $this->productRepository->remove($product);
        return new Response("deleted product");
    }
}
