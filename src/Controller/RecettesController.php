<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Recettes;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RecettesType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecettesController extends AbstractController
{
    /**
     * @Route("/recettes", name="app_recettes")
     */
    public function index(): Response
    {
        return $this->render('recettes/index.html.twig', [
            'controller_name' => 'RecettesController',
        ]);
    }

    /**
     * @Route("/recettes/ajout", name="recettes_ajout")
     */
    public function ajoutRecettes(Request $request):Response
    {
        $recette= new Recettes;

        $form=$this->createForm(RecettesType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
        
            
            $recette->setUsers($this->getUser()); //Recuperer User et Active
            $recette->setActive(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

            return $this->render('recettes/ajoutRecette.html.twig', [
                'form' =>$form->createView()
            ]);
        }
    
}