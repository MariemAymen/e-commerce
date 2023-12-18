<?php

namespace App\Controller\Admin;

use App\Entity\Cart;
use App\Entity\User;
use App\Entity\Order;
use App\Entity\Adresses;
use App\Entity\Products;
use App\Entity\CartItems;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Espace Admin');
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-tachometer');

        yield MenuItem::linkToRoute('Router au site', 'fas fa-home', 'home');

        yield MenuItem::linkToRoute('Sauvgarder la BDD', 'fa fa-download', 'backup_database');

        yield MenuItem::section('Gestion Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateur','fas fa-users', User::class);

        yield MenuItem::section('Gestion des produits');
        yield MenuItem::linkToCrud('Produits','fas fa-tags', Products::class);

        yield MenuItem::section('Gestion des adresses');
        yield MenuItem::linkToCrud('Adresses','fa fa-address-card', Adresses::class);

        yield MenuItem::section('Gestion des Panier');
        yield MenuItem::linkToCrud('Panier','fa-solid fa-cart-shopping', Cart::class);
        yield MenuItem::linkToCrud('Détails','fa fa-shopping-cart', CartItems::class);

        yield MenuItem::section('Gestion des commandes');
        yield MenuItem::linkToCrud('Commandes','fas fa-box', Order::class);
    }
}
