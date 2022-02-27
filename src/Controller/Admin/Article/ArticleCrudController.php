<?php

namespace App\Controller\Admin\Article;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

class ArticleCrudController extends AbstractCrudController
{
    public const ARTICLE_BASE_PATH = 'images/upload';
    public const ARTICLE_UPLOAD_DIR = 'public/images/upload';
    public const ACTION_DUPLICATE = 'duplicate';

    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    /*public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->setLabel('Dupliquer')
            ->linkToCrudAction('duplicateArticle')
            ->setCssClass('btn btn-warning');

        $detailArticle = Action::new('detailUser', 'Détail', 'fa fa-newspaper')
            ->linkToCrudAction(Crud::PAGE_DETAIL);

        return $actions
            ->add(Crud::PAGE_EDIT, $duplicate)
            ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);
    }*/

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),

            AssociationField::new('author', 'Auteur')->hideOnForm(),

            TextField::new('title', label: 'Titre')
                ->setColumns('col-6'),

            TextEditorField::new('description', 'Courte Description'),

            TextEditorField::new('content', 'Contenu de l\'article'),

            BooleanField::new('isPublished', 'Publié')
                ->setColumns('col-2')
                ->setCssClass('mt-4'),

            /*DateTimeField::new('createdAt', 'Rédaction')
                ->onlyOnIndex()
                ->setFormat('dd/M/Y'),*/

            DateTimeField::new('updatedAt', 'MAJ')
                ->onlyOnIndex(),

            DateTimeField::new('updatedAt', 'Mise à jour')
                ->onlyOnDetail(),

            AssociationField::new('category', 'Catégorie')
                ->setColumns('col-3'),

            ImageField::new('file', 'Image')
                ->setBasePath(self::ARTICLE_BASE_PATH)
                ->setUploadDir(self::ARTICLE_UPLOAD_DIR)
                ->setSortable(false)
                ->setRequired(false)
                ->setColumns('col-7'),
        ];
    }

    /* Remplacer par EventSubscriber.
     public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Article) {
            return;
        }

        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        // Je rappelle la méthode persistEntity pour envoyé en base de donnée
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Article) {
            return;
        }

        $entityInstance->setAuthor($this->getUser());

        parent::updateEntity($entityManager, $entityInstance);
    }
    */

    /*public function duplicateArticle(AdminContext $context, EntityManagerInterface $entityManager, AdminUrlGenerator $adminUrlGenerator): Response
    {*/
        // dd($context);
        // /** @var Article $article */
/*        $article = $context->getEntity()->getInstance();

        $duplicatedArticle = clone $article;

        parent::persistEntity($entityManager, $duplicatedArticle);

        $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicatedArticle->getId())
            ->generateUrl();

        return $this->redirect($url);
    }*/
}

// Todo: Récupérer l'admin connecté et setAuthor
// https://www.youtube.com/watch?v=ze6XJTACo1s 23:45
