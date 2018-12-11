<?php

namespace App\Form;

use App\Entity\DeletedUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class DeletedUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('UserName')
            ->add('DisableDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker',
                    'autocomplete'=>'off'
                ]
            ))
            ->add('DeleteDate', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'attr' => [
                    'class' => 'js-datepicker',
                    'autocomplete'=>'off'
                ]
            ))
            ->add('ArchiveDate', DateType::class, array(
                    'widget' => 'single_text',
                    'required' => false,
                    'html5' => false,
                    'attr' => [
                        'class' => 'js-datepicker',
                        'autocomplete'=>'off'
                    ]
                ))
            ->add('IsDeleted')
            ->add('IsArchived')
            ->add('IsArchiveDeleted')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DeletedUser::class,
        ]);
    }
}
