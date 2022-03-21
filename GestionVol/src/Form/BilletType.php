<?php

namespace App\Form;

use App\Entity\Billet;
use App\Entity\Vol;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Num')
            ->add('Date')
            ->add('Destination')
            ->add('Categorie')
            ->add('Prix')
            ->add('volBillet', EntityType::class,[
                'class' =>  Vol::class,
                'choice_label' => 'id'
                ])
            ->add("add",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Billet::class,
        ]);
    }
}
