<?php

namespace App\Form;

use App\Entity\StarlinkGroup;
use App\Repository\StarlinkGroupRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StarlinkGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Location',
                    'id' => 'location',
                ],
                'mapped' => false,
            ])
            ->add('city', HiddenType::class, [
                'mapped' => false,
            ])
            ->add('lat', HiddenType::class, [
                'mapped' => false,
            ])
            ->add('lon', HiddenType::class, [
                'mapped' => false,
            ])
            ->add('starlinkGroup', EntityType::class, [
                'class' => StarlinkGroup::class,
                'placeholder' => 'Choose a starlinkGroup',
                'query_builder' => function (StarlinkGroupRepository $repository) {
                    return $repository->createQueryBuilder('s')
                        ->orderBy('s.yearLaunch', 'DESC')
                        ->addOrderBy('s.numberLaunch', 'DESC');
                },
                'required' => true,
                'mapped' => false,
                'multiple' => false,
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StarlinkGroup::class,
        ]);
    }
}
