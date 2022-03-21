<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Transport;
use App\Controller\TransportController;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule', TextType::class, array('data_class'=>null ,'required'=>false))
            ->add('marque', TextType::class, array('data_class'=>null ,'required'=>false))
            ->add('modele', TextType::class, array('data_class'=>null ,'required'=>false))
            ->add('nbsiege', NumberType::class, array('data_class'=>null ,'required'=>false))
            ->add('image', FileType::class, array('data_class'=>null ,'required'=>false))
            ->add('prix', NumberType::class, array('data_class'=>null ,'required'=>false))
            ->add('categorie' ,EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }

}
