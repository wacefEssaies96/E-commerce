<?php

namespace App\Form;

use App\Entity\ProduitSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class ProduitSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minPrix',IntegerType::class,[
                'required' => false,
                'label' => 'Prix minimal',
                'attr' => [
                    'placeholder' => 'Prix minimal'
                ]
            ])
            ->add('maxPrix',IntegerType::class,[
                'required' => false,
                'label' => 'Prix maximal',
                'attr' => [
                    'placeholder' => 'Prix maximal'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix(){
        return '';
    }
}
