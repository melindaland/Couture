<?php

namespace App\Form;

use App\Entity\Objet;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet', EntityType::class, [
                'class' => Objet::class,
                'choice_label' => 'nom', 
            ])
            // date du début de la réservation
            ->add('dateReservation', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début'
            ])
            ->add('statutReservation', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'en_attente',
                    'Confirmée' => 'confirmee',
                    'Annulée' => 'annulee',
                ],
                'label' => 'Statut de la réservation'
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username', 
                'disabled' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
