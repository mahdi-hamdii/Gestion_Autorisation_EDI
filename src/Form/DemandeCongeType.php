<?php

namespace App\Form;

use App\Entity\DemandeConge;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCongeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('motifs',TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('dateDebut',\Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
            ->add('dateFin',\Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DemandeConge::class,
        ]);
    }
}
