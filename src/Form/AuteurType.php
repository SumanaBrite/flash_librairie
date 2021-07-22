<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('description' , TextareaType::class, [
                // 'required' => false,
                'label' => "description de l'auteur",
                'attr' => [
                    'placeholder' => "vous pouvez décrire l'auteur"
                ]
            ]
            )
            ->add('image' , TextType::class , [
                // 'required' => true,
                'label' => "Nom de l'image",
                'attr' => [
                    'placeholder' => "écrivez le titre de votre image"
                ] 
                ]
                )
            ->add('path', FileType::class, [
                'mapped' => false,
                'required' => true,
                'multiple' => false,
                'label' => "uploader votre image",
                'attr' => [
                    'placeholder' => "parcourir pour trouver l'image"
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048K',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            'image/gif'
                        ]
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
