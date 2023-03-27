<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Pizza name',
                'required' => true,
            ])
            ->add('price', TextType::class, [
                'label' => 'Price',
                'required' => true,
            ])
            ->add('customerAddress', TextType::class, [
                'label' => 'Delivery address',
                'required' => true,
            ])
            ->add('customerName', TextType::class, [
                'label' => 'Your Name',
                'required' => true,
            ])
            ->add('size', ChoiceType::class, [
                'label' => 'Size',
                'choices' => [
                    '25 cm' => '25',
                    '35 cm' => '35',
                    'calzone' => '12',
                ],
                'required' => true,
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantity',
                'attr' => [
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                ],
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Place Order',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
            'pizzas' => [],
        ]);
    }
}
