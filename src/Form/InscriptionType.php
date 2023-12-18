<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //creation de differentes  champs
        $builder
        ->add('nom',TextType::class,[
            'label' =>false,
            'required' => false,
            'attr' =>[
                'placeholder' => 'Votre nom',
                'class' => 'form-control mb-3'
            ],
            'constraints'=> [
                new NotNull([
                    'message' => 'Veuillez renseigner votre nom'
                ]),
                new Length([
                  'min' => 2,
                  'max' => 255,
                  'minMessage' => 'Votre nom doit faire au moins {{limit}} caractères',
                  'maxMessage' => 'Votre nom doit contenir au maximum {{ limit }} caractères'
                  ])
                  ]
              ])
        // creation du champ de type texte
        ->add('prenom',TextType::class,[
            'label' =>false,
            'required' => false,
            'attr' =>[
                'placeholder' => 'Votre prenom',
                'class' => 'form-control mb-3'
            ],
            'constraints'=> [
                new NotNull([
                    'message' => 'Veuillez renseigner votre prenom'
                ]),
                new Length([
                  'min' => 2,
                  'max' => 255,
                  'minMessage' => 'Votre prenom doit faire au moins {{limit}} caractères',
                  'maxMessage' => 'Votre prenom doit contenir au maximum {{ limit }} caractères'
                  ])
                  ]
              ])
        ->add('email',EmailType::class,[
            'label' =>false,
            'required' => false,
            'attr' =>[
                'placeholder' => 'Votre email',
                'class' => 'form-control mb-3'
            ],
            'constraints'=> [
                new NotNull([
                    'message' => 'Veuillez renseigner votre email'
                ]),
                new Length([
                  'min' => 2,
                  'max' => 255,
                  'minMessage' => 'Votre email doit faire au moins {{limit}} caractères',
                  'maxMessage' => 'Votre email doit contenir au maximum {{ limit }} caractères'
                  ])
                  ]
              ])
              ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'required' => false,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'form-control mb-3'
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirmer le mot de passe',
                        'class' => 'form-control mb-3'
                    ]
                ],
                'constraints' => [
                    new NotNull([
                        'message' => 'Veuillez saisir votre mot de passe'
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 255,
                        'maxMessage' => 'Votre mot de passe doit contenir au maximum {{ limit }} caractères'
                    ])
                ]
            ])
        ->add('submit', submitType::class, [
            'label' => 'Soumettre',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
