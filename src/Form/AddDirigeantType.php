<?php

namespace App\Form;

use App\Entity\Dirigeants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddDirigeantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_dirigeant')
            ->add('prenom')
            ->add('sexe')
            ->add('adresse_mail')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dirigeants::class,
        ]);
    }
}
