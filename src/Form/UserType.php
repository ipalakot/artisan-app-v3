<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'lastname', TextType::class, [
                'label' => 'Nom :'
                ]
            )
            ->add(
                'firstname', TextType::class, [
                'label' => 'Prénom :'
                ]
            )
            ->add(
                'email', EmailType::class, [
                'label' => 'Email :'
                ]
            )
            ->add(
                'phone', TelType::class, [
                'label' => 'Téléphone :'
                ]
            )
            //->add('roles')
            ->add(
                'password', PasswordType::class, [
                'label' => 'Mot de passe :'
                ]
            )
            ->add(
                'confirmpassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe :'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
            'data_class' => User::class,
            ]
        );
    }
}
