<?php

namespace App\Form;


use App\Entity\Hotel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RechercherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Type', ChoiceType::class, [
                'choices' => [
                    'Hotel' => 'Hotel',
                    'Restaurant' => 'Restaurant',
                    'Veterinaire' => 'Vétérinaire',
                    'Foret' => 'Foret',
                    'Camping' => 'Camping',
                    'Plage' => 'Plage',
                    'Parc' => 'Parc',              
                ]
            ])

            // ->add('Ville', EntityType::class, [
            //     'class' => Hotel::class, 
            //         'choice_label' => 'Ville',                  
            //     ]
            // )

                    
            ->add('recherche', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => Hotel::class,
        ]);
    }
}
