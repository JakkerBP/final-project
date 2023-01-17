<?php

namespace App\Form;

use App\Entity\Key;
use App\Entity\ProjectCustomKey;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProjectCustomKeyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ->add('keyy' , EntityType::class,[
            'class' => Key::class,
            'choice_label' => 'symbol',
            'label' => 'Touche a modifié',
        ])
        ->add('font', ChoiceType::class, [
                'choices' => [
                    'Mont serrat' => '"montSerrat",sans-serif',
                    'Courier New' => '"Courier New", Courier, monospace',
                    'Franklin Gothic Medium' => '"Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif',
                    'Calibri' => '"Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif',
                    'Times New Roman' => '"Times New Roman", Times, serif',
                ],
                'data' => '"montSerrat",sans-serif', 
            ])
        ->add('Color', ColorType::class)
            // ->add('picture')
            // ->add('project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectCustomKey::class,
        ]);
    }
}
