<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Form\CategoriesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="show_categories_all")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager
            ->getRepository(Categories::class)
            ->findAll();

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
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
     * @Route("/categories/id/{id}", name="show_categorie_one")
     */
    public function readOne(Categories $categorie): Response
    {
        return $this->render('categories/readOne.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    
    /**
     * @Route("/id/{id}/edit", name="categorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categories $categorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriesType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('show_categories_all', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Categories $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('show_categories_all', [], Response::HTTP_SEE_OTHER);
    }
}

