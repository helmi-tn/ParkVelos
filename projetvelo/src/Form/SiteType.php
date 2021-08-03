<?php

namespace App\Form;

use App\Entity\Site;
use App\Entity\Circuit;
use App\Entity\CategorieSite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('icon', FileType::class)
            ->add('description', TextAreaType::class)
            ->add('map',FileType::class)
            ->add('categoriesite', EntityType::class, [
                'class' => CategorieSite::class,
                'choice_label' => 'nom', ])

            /*->add('circuit', EntityType::class, [
                'class' => Circuit::class,
                'choice_label' => 'nom', ])*/
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Site::class,
        ]);
    }
}
