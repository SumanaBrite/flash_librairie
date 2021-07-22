<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Etat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description'
            , TextareaType::class, [
                // 'required' => false,
                'label' => "description de l article",
                'attr' => [
                    'placeholder' => "vous pouvez décrire l'article "
                ]
            ]
            
            )
            ->add('dateParution')
            ->add('isbn')
            ->add('image' 
            ,TextType::class, [
                // 'required' => true,
                'label' => "Nom de l'image",
                // 'attr' => [
                //     'placeholder' => "écrivez le titre de votre image"
                // ]
            ] )
            ->add('path', FileType::class, [
                'mapped' => false,
                // 'required' => true,
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
            ->add('prix')
            ->add('etat', EntityType::class ,[
                "class"  => Etat::class,
                "choice_label" => "libelle"
                
            ])
            ->add('categorie', EntityType::class ,[
                "class"  => Categorie::class,
                "choice_label" => "libelle"
                
            ])
            // ->add('auteur', EntityType::class ,[
            //     "class"  => Auteur::class,
            //      "choice_label" => "nom"
            //     // "mapped" => false
                
                
            // ])
            ->add('auteur', EntityType::class ,[
                "class" => Auteur::class,
                "choice_label" => function (?Auteur $auteur) {
                    $nom = $auteur->getNom();
                    $prenom = $auteur->getPrenom();
                    $affichageDansLeSelect = "$prenom $nom";
                    return $affichageDansLeSelect;
                }
            ])
            
            // ->add('voteMode', EntityType::class, [
            //     'label' => $this->translator->trans('Voting method'),
            //     'placeholder' => $this->translator->trans('-- Choose the method --'),
            //     'class' => VoteMode::class,
            //     'choice_label' => function (?VoteMode $choice) {
            //         $option = $this->dataTranslator->voteModeTypeTranslate($choice)
            //             . ": " .
            //             $this->dataTranslator->voteModeDescriptionTranslate($choice);
            //         return $option;
            //     },
            // ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
