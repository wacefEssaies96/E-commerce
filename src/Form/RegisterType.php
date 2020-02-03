<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,[
                'label' => 'Nom : ','required' => true
            ])
            ->add('email',null,[
                'label' =>'Adresse E-mail : ','required' => true
            ])
            //->add('roles')
            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Mot de passe : ','required' => true],
                'second_options' => ['label' => 'Confirmer le mot de passe : ','required' => true]
            ])
            ->add('Enregistrer',SubmitType::class,[
                
                'attr' => [
                    'class' => 'btn btn-success',
                    'label' => 'Enregistrer',
                    'required' => true
                ]
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
