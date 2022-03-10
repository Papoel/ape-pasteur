<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class ContactFormType extends AbstractType
{
    public function __construct(private Security $security)
    {
    }

    /**
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var User $user */
        $user = $this->security->getUser();

        $builder
            ->add('nom', TextType::class, options: [
                'label' => 'Nom et Prénom',
                'attr' => [
                    'class' => 'form-control w-full bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline focus:border-purple-500',
                    'value' => $user->getFullname(),
                ],
            ])

            ->add('email', EmailType::class, options: [
                'label' => 'Votre Email',
                'attr' => [
                    'class' => 'form-control w-full bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline focus:border-purple-500',
                    'value' => $user->getEmail(),
                ],
            ])

            ->add('subject', TextType::class, options: [
                'label' => 'Sujet',
                'attr' => [
                    'class' => 'form-control w-full bg-gray-300 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline focus:border-purple-500',
                    'rows' => 6,
                    'value' => 'Test d\'envoie de Mail...',
                ],
            ])

            ->add('message', TextareaType::class, options: [
                'attr' => [
                    'rows' => 6,
                    'name' => 'Je test un envoie d\'E-mail ! 😢',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
