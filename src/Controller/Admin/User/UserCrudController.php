<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
                    IdField::new('id')->hideOnForm(),

                    TextField::new('fullName', 'Nom Complet')->hideOnForm()->setColumns('col-12'),

                    TextField::new('firstname', 'Prénom')->setColumns('col-4')->hideOnIndex(),

                    TextField::new('lastname', 'Nom')->setColumns('col-4')->hideOnIndex(),

                    TextField::new('pseudo', 'Pseudo')->setColumns('col-4')->hideOnIndex(),

                    TextField::new('address', 'Adresse')->setColumns('col-6'),

                    TextField::new('postalCode', 'Code Postal')->setColumns('col-2'),

                    TextField::new('town', 'Ville')->setColumns('col-4'),

                    EmailField::new('email', 'E-Mail')->setColumns('col-6'),

                    TextField::new('password', 'Mot de passe')
                        ->onlyWhenCreating()
                        ->setFormType(PasswordType::class)
                        ->setColumns('col-6'),

                    ChoiceField::new('roles')->setChoices(
                        [
                            'ROLE_ADMIN' => 'ROLE_ADMIN',
                            'ROLE_USER' => 'ROLE_USER',
                        ]
                    )->allowMultipleChoices()->setColumns('col-6')->hideOnIndex(),

                    BooleanField::new('isValide', 'Autoriser'),
                ];
    }

    public function configureActions(Actions $actions): Actions
    {
        if (!$this->IsGranted('ROLE_ADMIN')) {
            return $actions
                ->remove(Crud::PAGE_INDEX, Action::NEW)
                ->remove(Crud::PAGE_INDEX, Action::EDIT)
                ->add(Crud::PAGE_INDEX, 'detail')
                ->remove(Crud::PAGE_DETAIL, Action::EDIT)
                ->disable(Action::NEW, Action::DELETE);
        }

        return $actions
            ->add(Crud::PAGE_INDEX, 'detail');
    }
}
