<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Products;
use App\Form\ProductsType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends AbstractController
{


    /**
     * @Route("/products", name="app_products")
     */
    public function index(): Response
    {
        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }



    /**
     * @Route("/products/ajout", name="products_ajout")
     */
    public function ajoutProducts(Request $request): Response //Entrée l'object Request
    {
        //Créer une nouvelle product
        $product = new Products;
        
        //Créer un formulaire et cherche productsType

        $form=$this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            
            return $this->redirectToRoute('admin');

            
        }
        return $this->render('products/ajoutProduct.html.twig', [
            'form' =>$form->createView()
        ]);
    }

}
