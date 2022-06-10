<?php

namespace App\Form;

use App\Entity\Recettes;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class RecettesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
          
            ->add('content', CKEditorType::class)
            

            //->add('created_at', DateType::class)
          
            ->add('users', EntityType::class, [ //Il faut transporme en string Entity avec function __toString dans la page Categories.php
                'class'=> Users::class
            ])
            ->add('Envoyer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {


        
        $resolver->setDefaults([
            'data_class' => Recettes::class,
        ]);
    }
}
