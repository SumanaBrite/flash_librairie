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

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('dateParution')
            ->add('isbn')
            ->add('image')
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
