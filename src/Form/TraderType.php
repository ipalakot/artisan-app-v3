<?php

namespace App\Form;

use App\Entity\Trader;
use App\Entity\Activitytype;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TraderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'lastnameboss', TextType::class, [
                'label' => 'Nom du responsable légal:',
                ]
            )
            ->add(
                'firstnameboss', TextType::class, [
                'label' => 'Prénom du responsable légal:',
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
                'compagnyname', TextType::class, [
                'label' => 'Nom entreprise :',
                ]
            )
            ->add(
                'siren', TextType::class, [
                'label' => 'Numéro SIREN :',
                ]
            )
            ->add(
                'phone', TextType::class, [
                'label' => 'Téléphone :',
                ]
            )
            ->add(
                'adress', TextareaType::class, [
                'label' => 'Adresse :',
                ]
            )
            ->add(
                'postalcode', TextType::class, [
                'label' => 'Code postal :',
                ]
            )
            ->add(
                'city', TextType::class, [
                'label' => 'Ville :',
                ]
            )
            ->add(
                'presentation', TextareaType::class, [
                'label' => 'Présentation :',
                ]
            )
            ->add('activitytype')
            ->add(
                'profilephoto', FileType::class, [
                'label' => 'Photo de profil',
                'multiple' => true,
                'mapped' => false, // This is important to handle the file upload manually
                'required' => false, // Set to true if the image is mandator
 

                ]
            )
            ->add(
                'coverphoto', FileType::class, [
                'label' => 'Photo de couverture',
                'multiple' => true,
                'mapped' => false, // This is important to handle the file upload manually
                'required' => false, // Set to true if the image is mandator
 

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
