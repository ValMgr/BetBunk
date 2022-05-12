<?php

namespace App\Form;

use App\Entity\Quiz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Vich\UploaderBundle\Form\Type\VichImageType;


use App\Form\QuestionType;


class QuizFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('thumbnail', VichImageType::class, [
                'label' => 'Miniature (PNG or JPG)',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'image_uri' => true,
                'delete_label' => 'Supprimer l\'image',
                'download_label' => 'Télécharger l\'image',
                'asset_helper' => true,

                // 'constraints' => [
                //     new File([
                //         'maxSize' => '4096k',
                //         'mimeTypes' => [
                //             'image/jpeg',
                //             'image/png',
                //             'image/gif',
                //             'image/bmp',
                //             'image/webp',
                //         ],
                //         'mimeTypesMessage' => 'Please upload a valid thumbnails',
                //     ])
                // ],
            ])
            ->add('image', VichImageType::class, [
                'label' => 'Miniature (PNG or JPG)',
                'required' => false,
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'image_uri' => true,
                'delete_label' => 'Supprimer l\'image',
                'download_label' => 'Télécharger l\'image',
                'asset_helper' => true,

                // 'constraints' => [
                //     new File([
                //         'maxSize' => '4096k',
                //         'mimeTypes' => [
                //             'image/jpeg',
                //             'image/png',
                //             'image/gif',
                //             'image/bmp',
                //             'image/webp',
                //         ],
                //         'mimeTypesMessage' => 'Please upload a valid thumbnails',
                //     ])
                // ],
            ])
            ->add('time')
            ->add('questions', CollectionType::class, [
                'label' => false,
                'entry_type' => QuestionType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
