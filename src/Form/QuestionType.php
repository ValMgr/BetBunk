<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;



class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Question',
                'required' => false,
                'attr' => [
                    'class' => 'form-field',
                ]
            ])
            ->add('answer', TextType::class, [
                'label' => 'Réponse',
                'required' => true,
                'attr' => [
                    'class' => 'form-field',
                ]
            ])
            ->add('image', VichImageType::class, [
                'label' => 'Image (Optionnel)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-field',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/bmp',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid thumbnails',
                    ])
                ],
            ])
        ;
    }

}
