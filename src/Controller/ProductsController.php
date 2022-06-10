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
     * @Route("/productsAsi", name="app_products_asiatiques")
     */
    public function produitsAsi(): Response
    {
        return $this->render('products/produitsAsiatiques.html.twig', [
            'produitsAsi' => 'ProductsController',
        ]);
    }

    /**
     * @Route("/productsAfri", name="app_products_africains")
     */
    public function produitsAfri(): Response
    {
        return $this->render('products/produitsAfricains.html.twig', [
            'produitsAfri' => 'ProductsController',
        ]);
    }

    /**
     * @Route("/productsVaiselles", name="app_products_vaiselles")
     */
    public function produitsVaiselles(): Response
    {
        return $this->render('products/produitsVaiselles.html.twig', [
            'produitsVaiselles' => 'ProductsController',
        ]);
    }

    /**
     * @Route("/productsBio", name="app_products_bio")
     */
    public function produitsBio(): Response
    {
        return $this->render('products/produitsBio.html.twig', [
            'produitsBio' => 'ProductsController',
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
