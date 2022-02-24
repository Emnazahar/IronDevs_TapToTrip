<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Nom')
            ->add('Prenom')
            ->add('Numtel')
            ->add('Email')
            ->add('Submit',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
