<?php

namespace App\Form;

use App\Entity\Trader; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType; 


use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationTraderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'lastnameboss', TextType::class, [
                'label' => 'Nom du responsable légale :'
                ]
            )
            ->add(
                'firstnameboss', TextType::class, [
                'label' => 'Prénom du responsable légale :'
                ] 
            )
            ->add(
                'email', EmailType::class, [
                'label' => 'Email :'
                ]
            )
            ->add(
                'password', PasswordType::class, [
                'label' => 'Mot de passe :'
                ]
            )
            ->add(
                'confirmpassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe :'
                ]
            )
            ->add(
                'phone', TelType::class, [
                'label' => 'Téléphone :'
                ]
            )
            ->add(
                'compagnyname', TextType::class, [
                'label ' => 'Nom entreprise'
                ]
            )
            ->add(
                'activitytype', TextType::class, [
                'label' => 'Type activité :' 
                ]
            )
            ->add(
                'siren', TextType::class, [
                'label' => 'Numéro siren :'
                ]
            )
            ->add(
                'adress', Textarea::class, [
                'label' => 'Adresse :'
                ]
            )
            ->add(
                'postalcode', TextType::class, [
                'label' => 'Code postal :'
                ]
            )
            ->add(
                'city', TextType::class, [
                'label' => 'Ville :'
                ]
            )
            ->add(
                'presentation', Textarea::class, [
                'label' => 'Présentation :'
                ]
            )
            ->add(
                'profilephoto', FileType::class, [
                'label' => 'Photo de profil :',
                'multiple' => true,
                'mapped' => false, // This is important to handle the file upload manually
                'required' => false,
                ]
            )
            ->add(
                'coverphoto', FileType::class, [
                'label' => 'Photo de couverture :'
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
