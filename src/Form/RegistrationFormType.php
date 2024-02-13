<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class RegistrationFormType extends AbstractType
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
            ->add(
                'plainPassword', PasswordType::class, [
                            'label' => 'Mot de passe :', 
                                // instead of being set onto the object directly,
                            // this is read and encoded in the controller
                            'mapped' => false,
                            'attr' => ['autocomplete' => 'new-password'],
                            'constraints' => [
                            new NotBlank(
                                [
                                'message' => 'Please enter a password',
                                ]
                            ),
                            new Length(
                                [
                                'min' => 6,
                                'minMessage' => 'Your password should be at least {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                                ]
                            ),
                            ],
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
