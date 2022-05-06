<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => false, 'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Nom']])
            ->add('lastName', TextType::class, ['label' => false, 'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Prenom']])
            ->add('birthDate', DateType::class, ["widget"=>"single_text",'label' => 'Date de naissance','attr' => ['class' => 'form-control mb-3']])
            ->add('adress', TextType::class, ['label' => false, 'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Adresse']])
            ->add('city', TextType::class, ['label' => false, 'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Pays']])
            ->add('mail', TextType::class, ['label' => false, 'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Mail']])
            ->add('phone', TextType::class, ['label' => false, 'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Telephone']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
