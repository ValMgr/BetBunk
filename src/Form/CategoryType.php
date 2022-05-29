<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


use App\Form\QuestionType;


class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'required' => false,
                'attr' => [
                    'class' => 'form-field',
                ]
            ])
            ->add('color', TextType::class, [
                'label' => 'Couleur',
                'required' => true,
                'attr' => [
                    'class' => 'form-field',
                ]
            ])
            ->add('questions', CollectionType::class, [
                'label' => false,
                'entry_type' => QuestionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false
            ])
        ;
    }

}
