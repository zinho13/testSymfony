<?php

namespace App\Form;

use App\Entity\Societe;
use App\Entity\CodePostal;
use App\Entity\TypeSociete;
use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            // ->add('createdAt')
            // ->add('updatedAt')

            ->add('type', EntityType::class, [
                    'class'=>TypeSociete::class,
                    'choice_label'=> function(TypeSociete $typeSociete){
                        return sprintf('%s', $typeSociete->getNom());
                    },
                    'multiple' => true,
                    'expanded' => true,
                    'placeholder'=>'Selectionner un/des Type(s)'
                ])

            ->add('code_postal', EntityType::class, [
                    'class' =>CodePostal::class,
                    'placeholder' => '---',
                    'choice_label' => function(CodePostal $codePostal)
                                        {
                                            return sprintf('%s', $codePostal->getLibelle());
                                        }
                ])

            ->add('ville', EntityType::class, [
                    'class' =>Ville::class,
                    'choice_label' => function(Ville $ville)
                    {
                        return sprintf('%s', $ville->getLibelle());
                    }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
