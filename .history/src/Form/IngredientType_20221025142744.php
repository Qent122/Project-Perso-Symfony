<?php

namespace App\Form;

use App\Entity\Ingredient;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\component\Validator\Constraints as Assert;
use Webmozart\Assert\Assert as AssertAssert;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'attr'=> [
                    'class'=>'form-control',
                    'minlenght'=>'2',
                    'maxlenght'=>'50'
                ],
                'label'=>'Nom',
                'label-attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'contraints'=> [
                    new Assert\Length([])
                ]
            ])
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
