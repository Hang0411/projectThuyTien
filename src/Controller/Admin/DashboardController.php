<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
//use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Products;
use App\Entity\Recettes;
use App\Entity\Categories;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    
    {
        
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjectThuyTien');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', Users::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-address-book', Categories::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-address-book', Products::class);
        yield MenuItem::linkToCrud('Recettes', 'fas fa-address-book', Recettes::class);
    }
}
