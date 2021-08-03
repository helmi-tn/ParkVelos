<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Commande;
use App\Form\ClientType;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('nbpersonnes')
            ->add('commentaire', TextareaType::class)
            ->add('debutdate')
            ->add('findate')
            ->add('cin')
            ->add('createdAt')
            ->add('email')
            ->add('client', ClientType::class, [
                'data_class' => null,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
