<?php

namespace App\Form;

use App\Entity\Activitytype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class ActivitytypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add(
                'imgactivity', FileType::class, [
                'label' => 'Image (JPG or PNG file)',
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
            'data_class' => Activitytype::class,
            ]
        );
    }
}
