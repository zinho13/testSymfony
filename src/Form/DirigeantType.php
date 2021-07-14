<?php

namespace App\Form;

use App\Entity\Dirigeant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DirigeantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Femme' => 'Femme',
                    'Homme' => 'Homme'
                ],
                'expanded' => 'true'
            ])
            ->add('email', EmailType::class)
            // ->add('createdAt')
            // ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dirigeant::class,
        ]);
    }
}
