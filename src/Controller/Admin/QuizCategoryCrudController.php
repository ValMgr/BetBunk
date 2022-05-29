<?php

namespace App\Controller\Admin;

use App\Entity\QuizCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class QuizCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuizCategory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            // TextField::new('thumbnailName'),
            TextEditorField::new('description'),
        ];
    }

}
