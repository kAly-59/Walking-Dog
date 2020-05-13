<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditHotelType extends AbstractType
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
                    'value' => 'Hotel',
                )
            ])
            
            ->add('lat', HiddenType::class)
            ->add('lon', HiddenType::class)

            ->add('adresse', null, array(
                'attr' => array(
                    'placeholder' => 'Adresse...',
                )
            ))

            ->add('codepostal', TextType::class, array(
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

            ->add('autorisation', ChoiceType::class, [
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ]
            ])

            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
