<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Article\ArticleCrudController;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', "Accès à la section d'admistration", 'Désolé, votre rôle ne vous donne pas accès a cette section.');
        // return parent::index();

        $url = $this->adminUrlGenerator
            ->setController(ArticleCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ape Pasteur');
    }

    /* public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }*/

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Accéder au site', 'fa fa-blog', 'app_home')
            ->setCssClass('');

        yield MenuItem::section('Articles', 'fas fa-newspaper')->setCssClass('bold text-success h6');

        yield MenuItem::subMenu('Action', 'fas fa-newspaper')
            ->setSubItems([
                MenuItem::linkToCrud('Afficher Article', 'fas fa-eye', Article::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Ajouter Article', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
//                MenuItem::linkToCrud('Détail Article', 'fas fa-info', Article::class)->setAction(Crud::PAGE_DETAIL),
            ]);

        yield MenuItem::section('Catégories', 'fas fa-tags')->setCssClass('bold text-success h6');

        yield MenuItem::subMenu('Action', 'fas fa-tags')
            ->setSubItems([
                MenuItem::linkToCrud('Afficher Catégorie', 'fas fa-eye', Category::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Ajouter Catégorie', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
//                MenuItem::linkToCrud('Détail Catégorie', 'fas fa-info', Category::class)->setAction(Crud::PAGE_DETAIL),
            ]);

        yield MenuItem::section('Utilisateurs', 'fas fa-users')->setCssClass('bold text-success h6');

        yield MenuItem::subMenu('Action', 'fas fa-users')
            ->setSubItems([
                MenuItem::linkToCrud('Afficher Utilisateur', 'fas fa-eye', User::class)->setAction(Crud::PAGE_INDEX),
                MenuItem::linkToCrud('Ajouter Utilisateur', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
//                MenuItem::linkToCrud('Détail Utilisateur', 'fas fa-info', User::class)->setAction(Crud::PAGE_DETAIL),
            ]);
    }
}
