<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="app_categories")
     */
    public function index(): Response
    {
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    /**
     * @Route("/categories/ajout", name="categories_ajout")
     */
    public function ajoutCategories(Request $request): Response //Entrée l'object Request
    {
        //Créer une nouvelle category
        $categorie = new Categories;
        
        //Créer un formulaire et cherche categoriesType

        $form=$this->createForm(CategoriesType::class, $categorie);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            
            return $this->redirectToRoute('admin');

            
        }
        return $this->render('categories/ajoutCategorie.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/categories/id/{id}", name="app_categories_show", methods={"GET"})
     */
    public function show(Categories $categorie): Response
    {
        return $this->render('articles/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }
}
