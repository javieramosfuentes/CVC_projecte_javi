<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Player;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $positions = [
            'POR' => 'POR',
            'DFC' => 'DFC',
            'LI'  => 'LI',
            'LD'  => 'LD',
            'CAD' => 'CAD',
            'CAI' => 'CAI',
            'MC'  => 'MC',
            'MCD' => 'MCD',
            'MCO' => 'MCO',
            'MD'  => 'MD',
            'MI'  => 'MI',
            'ED'  => 'ED',
            'EI'  => 'EI',
            'SD'  => 'SD',
            'DC'  => 'DC'
        ];

        $builder
            ->add('name')
            ->add('lastname')
            ->add('position', ChoiceType::class, [
                'choices' => $positions
            ])
            ->add('age')
            ->add('goals')
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
