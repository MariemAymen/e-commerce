<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EspacePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom',TextType::class,[
            'attr' => [
                'placeholder' => 'Nom',
                'class' => 'form-control']
            ])
    
        ->add('prenom',TextType::class,[
            'attr' => [
                'placeholder' => 'Prénom',
                'class' => 'form-control']
            ])
        ->add('email',TextType::class,[
            'attr' => [
                'placeholder' => 'Email',
                'class' => 'form-control']
            ])
        ->add('old_password',PasswordType::class,[
            'mapped' =>false,
            'label' => 'Mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Mot de passe actuel',
                     'class' => 'form-control',
                     ]
                ])
        ->add('new_password',RepeatedType::class, [
            'mapped' =>false,
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe doivent être identiques',
            'required' => false,
            'first_options'  => [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nouveau mot de passe',
                    'class' => 'form-control'
            ]
         
                ],
                
               'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirmer le nouveau mot de passe',
                        'class' => 'form-control'
                        ]
                    ],
                    'constraints' => [
                        new NotNull([
                           'message' => 'Veuillez saisir un mot de passe valide'
                        ]),
                        new Length([
                           'min' => 8,
                           'minMessage' => 'Votre  mot de passe doit contenir au moins {{ limit }} caractères',
                           'max' => 4096,
                           
                        ]),
                        ],
                        ])
                        ->add('submit', submitType::class, [
                            'label' => 'Modifier',
                            'attr' => [
                                'class' => 'btn btn-primary'
                            ]
                        ])
           
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
