<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Nom de la tâche', 'attr' => ['class' => 'form-control mb-3']])
            ->add('author', TextType::class, ['label' => 'Nom de la tâche', 'attr' => ['class' => 'form-control mb-3']])
            ->add('summary', TextType::class, ['label' => 'Nom de la tâche', 'attr' => ['class' => 'form-control mb-3']])
            ->add('releaseDate', DateType::class, ["widget"=>"single_text",'label' => 'Date de la tâche','attr' => ['class' => 'form-control mb-3']])
            ->add('category')
            ->add('forChild')
            ->add('aivalable')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
