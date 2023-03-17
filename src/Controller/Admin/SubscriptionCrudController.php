<?php

namespace App\Controller\Admin;

use App\Entity\Subscription;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class SubscriptionCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Subscription::class;
  }

  public function configureCrud(Crud $crud): Crud
  {
    return $crud
      ->setEntityLabelInSingular('Suscripción')
      ->setEntityLabelInPlural('Suscripciones')
      ->setDefaultSort(['id' => 'DESC']);
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->onlyOnIndex(),
      AssociationField::new('course', 'Cursos')->setColumns('col-sm-6'),
      AssociationField::new('user', 'Usuario')->setColumns('col-sm-6'),
    ];
  }
}
