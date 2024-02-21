<?php

namespace App\Form;

use App\Entity\Activitytype;
use App\Entity\Trader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('lastnameboss')
            ->add('firstnameboss')
            ->add('confirmpassword')
            ->add('phone')
            ->add('compagnyname')
            ->add('siren')
            ->add('adress')
            ->add('postalcode')
            ->add('city')
            ->add('presentation')
            ->add('activitytype', EntityType::class, [
                'class' => Activitytype::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trader::class,
        ]);
    }
}
