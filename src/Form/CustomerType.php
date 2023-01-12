<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Adress;
use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone')
            ->add('name')
            ->add('surname')
            ->add('adress',EntityType::class,[
                'class' => Adress::class,
                'choice_label' => 'adressLine',
            ])
            ->add('user',EntityType::class,[
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
