<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tel',TextType::class,[
                'label' => 'Téléphone : ',
                'attr' => [
                    'placeholder' => '00 000 000'
                ]
            ])
            ->add('adresse',TextType::class,[
                'label' => 'Adresse : ',
                'attr' => [
                    'placeholder' => 'Zarzouna, Bizerte'
                ]
            ])
            ->add('codePostal',TextType::class,[
                'label' => 'Code postal : ',
                'attr' => [
                    'placeholder' => '7021'
                ]
            ])
            ->add('pays',ChoiceType::class,[
                'label' => 'Pays : ',
                'choices' => $this->getChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    public function getChoices(){
        $choices = User::PAYS;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
