<?php

namespace App\Form;

use App\Entity\Paiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeCb',ChoiceType::class,[
                'label' => 'Type de la carte : ',
                'choices' => $this->getChoices()
            ])
            ->add('numCb',null,[
                'label' => 'Numero de la carte : ',
                'required' => true
            ])
            ->add('codeSecurity',null,[
                'label' => 'Code de securité : ',
                'required' => true
            ])
            ->add('nom',null,[
                'label' => 'Nom du porteur : ',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
    public function getChoices(){
        $choices = Paiement::TYPECB;
        $output = [];
        foreach($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
