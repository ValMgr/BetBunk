<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use App\Controller\AccountController;


use App\Entity\User;
use App\Entity\Quiz;
use App\Entity\QuizText;
use App\Entity\QuizCategory;
use App\Entity\Category;
use App\Entity\Question;


class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BetBunk Admin Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa-solid fa-screwdriver-wrench'),
            MenuItem::linktoRoute('Back to the website', 'fa fa-home', 'homepage'),
            MenuItem::section('Users'),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
            MenuItem::linkToCrud('Quiz', 'fa-solid fa-list', Quiz::class),
            MenuItem::linkToCrud('QuizText', 'fa-solid fa-list', QuizText::class),
            MenuItem::linkToCrud('QuizCategory', 'fa-solid fa-list', QuizCategory::class),
            MenuItem::linkToCrud('Category', 'fa-solid fa-circle-question', Category::class),
            MenuItem::linkToCrud('Question', 'fa-solid fa-circle-question', Question::class),

        ];
    }
}
