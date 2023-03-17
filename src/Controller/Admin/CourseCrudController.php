<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class CourseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Course::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Capacitación')
            ->setEntityLabelInPlural('Capacitaciones')
            ->setSearchFields(['name'])
            ->setDefaultSort(['id' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Título')->setColumns('col-sm-12'),
            SlugField::new('slug', 'Slug')->setTargetFieldName('name')->setColumns('col-sm-12'),
            NumberField::new('amount', 'Cupos')->setColumns('col-sm-6'),
            ChoiceField::new('day', 'Día')
                ->autocomplete()
                ->setChoices([
                    'Lunes' => 'monday',
                    'Martes' => 'tuesday',
                    'Miércoles' => 'wednesday',
                    'Jueves' => 'thursday',
                    'Viernes' => 'friday'
                ])
                ->setColumns('col-sm-6'),
            TimeField::new('start_time', 'Hora de inicio')->setColumns('col-sm-2'),
            TimeField::new('end_time', 'Hora de finalización')->setColumns('col-sm-2'),
            TextEditorField::new('description', 'Descripción')->hideOnIndex()->setColumns('col-sm-12'),
        ];
    }
}
