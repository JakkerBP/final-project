<?php

namespace App\Form;

use App\Entity\Key;
use App\Entity\KeyCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KeyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('symbol')
            ->add('keyPreview')
            ->add('category' , EntityType::class,[
                'class' => KeyCategory::class,
                'choice_label' => 'category_name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Key::class,
        ]);
    }
}
