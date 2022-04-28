<?php

namespace App\Controller\Admin;

use App\Entity\QuizText;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QuizTextCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuizText::class;
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
