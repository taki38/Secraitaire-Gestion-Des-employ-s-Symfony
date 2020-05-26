<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'prenom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'nom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('sector', ChoiceType::class, [
                'label' => 'Secteur',
                'choices'  => [
                    'Recrutement' => 'Recrutement',
                    'Informatique' => 'Informatique',
                    'Comptabilité' => 'Comptabilite',
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => 'email',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])



            ->add('image', ImageType::class, [
                'label' => 'Image',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('save', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'submit'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
