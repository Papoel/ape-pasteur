<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'required' => false,
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Entrez une description de l\'article :',
            ])

            ->add('content', TextareaType::class, [
                'label' => 'Article :',
                'required' => false,
            ])

            ->add('file', HiddenType::class, [
                'label' => 'false',
            ])

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie :',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'class' => 'text-purple-700',
                    'placeholder' => 'Sélectionnez une catégorie.',
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
