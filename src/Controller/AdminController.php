<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
   /**
     * @Route("/utilisateur", name="admin_")
     * @package App\controller
     */

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
         return $this->redirectToRoute('admin');
        }
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    
}
