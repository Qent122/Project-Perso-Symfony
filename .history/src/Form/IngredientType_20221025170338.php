<?php

namespace App\Form;

use App\Entity\Ingredient;
use Doctrine\DBAL\Connection;
use PhpParser\Node\Stmt\Label;
// use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'minlength' => '2',
                        'maxlength' => '50'
                    ],
                    'label' => 'Nom',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'constraints' => [
                        new Assert\Length(['min' => 2, 'max' => 50]),
                        new Assert\NotBlank()
                    ]
                ]
            )
            ->add('price', MoneyType::class,[
                'attr'=> [
                    'class'=>'form-control',
                ],
                'Label'=> 'prix',
                'label_attr'=> [
                    'class'=> 'form-label mt-4'
                ],
                'constraints'=>
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}