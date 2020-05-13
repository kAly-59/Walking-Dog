<?php

namespace App\Form;

use App\Entity\Veterinaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class VeterinaireType extends AbstractType
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
                    'value' => 'Vétérinaire',
                )
            ])
                        
            ->add('lat', HiddenType::class)
            ->add('lon', HiddenType::class)

            ->add('adresse', null, array(
                'attr' => array(
                    'placeholder' => 'Adresse...',
                )
            ))

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
            'data_class' => Veterinaire::class,
        ]);
    }
}
