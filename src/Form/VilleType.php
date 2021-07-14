<?php

namespace App\Form;

use App\Entity\Ville;
use App\Entity\CodePostal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('code_postal', EntityType::class, [
                'class'=>CodePostal::class,
                'choice_label'=> function(CodePostal $codepostals){
                    return sprintf(' %s', $codepostals->getLibelle());
                },
                'required' => false,
                'placeholder'=>'Selectionner un code postal'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
