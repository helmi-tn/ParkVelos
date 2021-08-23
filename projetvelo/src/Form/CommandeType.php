<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Commande;
use App\Form\ClientType;
use App\Form\ParticipantType;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire', TextareaType::class, [])
            ->add('debutdate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('findate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('client', ClientType::class)
            ->add('participant', CollectionType::class , [
                'entry_type' => ParticipantType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
