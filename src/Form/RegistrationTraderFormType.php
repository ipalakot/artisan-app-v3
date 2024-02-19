<?php

namespace App\Form;

use App\Entity\Trader;
use App\Entity\Activitytype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class RegistrationTraderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'lastnameboss', TextType::class, [
                'label'=> 'Nom du responsable légal :',
                ]
            )
            ->add(
                'firstnameboss', TextType::class, [
                'label' => 'Prénom du responsable légal :', 
                ]
            )
            ->add(
                'email', EmailType::class, [
                'label' => 'Email :', 
                ]
            )
            ->add(
                'password', PasswordType::class, [
                'label' => 'Mot de passe :', 
                ]
            )
            ->add(
                'confirmpassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe :', 
                ]
            )
            ->add(
                'phone', TelType::class, [
                'label' => 'Téléphone :', 
                ]
            )
            ->add(
                'compagnyname', TextType::class, [
                'label' => 'Nom entreprise :',
                ]
            )
            ->add(
                'siren', NumberType::class, [
                'label' => 'Numéro Siren :', 
                ]
            )
            ->add(
                'adress', TextType::class, [
                'label' => 'Adresse :', 
                ]
            )
            ->add(
                'postalcode', NumberType::class, [
                'label' => 'Code postal :', 
                ]
            )
            ->add(
                'city', TextType::class, [
                'label' => 'ville :', 
                ]
            )
            ->add(
                'presentation', TextType::class, [
                'label'=> 'Présentation :',
                ]
            )
            ->add(
                'activitytype', EntityType::class, [
                'class' => Activitytype::class,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
            'data_class' => Trader::class,
            ]
        );
    }
}
