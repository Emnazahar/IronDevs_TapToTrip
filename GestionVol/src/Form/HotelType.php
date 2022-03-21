<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Hotel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomH', TextType::class,[
                'label'=>'Nom Hotel' ,
                'attr'=>['placeholder'=>'Mouradi',
                    'class'=>'nomH']
            ])
            ->add('nbEtoiles',IntegerType::class, [
                'label'=>'Nombre Des Etoiles' ,
                'attr'=>['placeholder'=>'5',
                    'class'=>'nbEtoiles']
            ])

            ->add('adresse',TextType::class, [
                'label'=>'Adresse' ,
                'attr'=>['placeholder'=>'Hammamet Sud',
                    'class'=>'adresse']
            ])
            ->add('descriptionH',TextType::class,[
                'label'=>'Description'
            ])
            ->add('chambre',EntityType::class,[
                'class'=>Chambre::class,
                'choice_label'=>'id'
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
