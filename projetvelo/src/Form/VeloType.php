<?php

namespace App\Form;

use App\Entity\Velo;
use App\Entity\TailleVelo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VeloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('reference')
            ->add('image', FileType::class, ['data_class' => null
            ])
            ->add('disponibilite', ChoiceType::class, [
                'choices'  => [
                    'Disponible' => 'Disponible',
                    'Non disponible' => 'Non disponible',
                ],
            ])
            ->add('taillevelo', EntityType::class, [
                'class' => TailleVelo::class,
                'choice_label' => 'nom', ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Velo::class,
        ]);
    }
}
