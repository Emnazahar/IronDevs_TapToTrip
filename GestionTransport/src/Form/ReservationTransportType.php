<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


class ReservationTransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('idBillet', TextType::class, [
                'constraints' => [new NotBlank()]])
            ->add('dateReservation', DateTimeType::class, [
                'widget' => 'choice',
                'attr' => ['class' => 'js-datepicker']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults( [
            'idBillet' => null,
            'dateReservation' => null,
        ] );
    }

}