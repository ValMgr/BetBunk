<?php

namespace App\Controller\Admin;

use App\Entity\QuizText;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class QuizTextCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuizText::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            NumberField::new('note'),
            NumberField::new('countQuestions'),
            TextEditorField::new('description'),
        ];
    }

}
