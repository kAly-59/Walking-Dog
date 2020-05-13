<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Nom...',
                    'id' => 'nom',
                )
            ))

            ->add('type', HiddenType::class, [
                'attr' => array(
                    'value' => 'Restaurant',
                )
            ])
            
            ->add('lat', HiddenType::class)
            ->add('lon', HiddenType::class)

            ->add('adresse', null, array(
                'attr' => array(
                    'placeholder' => 'Adresse...',
                )
            ))

            ->add('autorisation', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ]
            ])
            ->add('codePostal', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Code postal...',
                    'id' => 'cp',
                )
            ))
            ->add('ville', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Ville...',
                    'id' => 'ville',
                )
            ))

            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
