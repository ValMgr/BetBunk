<?php

namespace App\Controller\Admin;

use App\Entity\QuizCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QuizCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuizCategory::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
