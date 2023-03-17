<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use App\Entity\Course;
use App\Entity\Subscription;
use App\Entity\User;


class DashboardController extends AbstractDashboardController
{
  #[Route('/admin', name: 'admin')]
  public function index(): Response
  {
    $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
    return $this->redirect($adminUrlGenerator->setController(CourseCrudController::class)->generateUrl());
  }

  public function configureDashboard(): Dashboard
  {
    return Dashboard::new()
      ->setTitle('The Dot Academy');
  }

  public function configureMenuItems(): iterable
  {
    //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
    yield MenuItem::linkToRoute('Home', 'fa fa-home', 'app_home');

    yield MenuItem::linkToCrud('Capacitaciones', 'fas fa-book', Course::class);
    yield MenuItem::linkToCrud('Usuarios', 'fas fa-users', User::class);
    yield MenuItem::linkToCrud('Suscripciones', 'fas fa-graduation-cap', Subscription::class);
  }
}
