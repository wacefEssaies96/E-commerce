<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null,['label' => 'Nom'])
            ->add('prix', null, ['label' => 'Prix'])
            ->add('descProd',TextareaType::class,['label' => 'Description'])
            ->add('categorie',ChoiceType::class,[
                'label' => 'Categorie',
                'choices' => $this->getChoices()    
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => 'Image'
            ]) 
            ->add('qtt', null, ['label' => 'Quantité'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
    public function getChoices(){
        $choices = Produits::CATEGORIE;
        $output=[];
        foreach($choices as $item => $i){
            $output[$i] = $item;
        }
        return $output;
    }
}
