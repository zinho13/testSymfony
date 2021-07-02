<?php

namespace App\Form;

use App\Entity\Societes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddSocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_societe')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('type')
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Societes::class,
        ]);
    }
}
