<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('firstname')
            ->add('preprovision')
            ->add('lastname')
            ->add('dateofbirth', BirthdayType::class)
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'gender' => [
                        'man' => 'man',
                        'vrouw' => 'vrouw',
                        'Overig' => 'Overig'
                    ]
                ],
            ])
//            ->add('hiring_date', BirthdayType::class)
//            ->add('salary')
            ->add('street')
            ->add('postal_code')
            ->add('place')
//            ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
