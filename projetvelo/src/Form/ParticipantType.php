<?php

namespace App\Form;

use App\Entity\Velo;
use App\Form\VeloType;
use App\Entity\TailleVelo;
use App\Entity\Participant;
use App\Repository\VeloRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('velo', EntityType::class, [
                'class' => Velo::class,
                'choice_label'=> 'reference',
                'multiple'=> false,
            ])


            ->add('taillevelo', EntityType::class, [
                'class' => TailleVelo::class,
                'choice_label' => 'nom', ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
