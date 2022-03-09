<?php

namespace App\Controller\Article;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/article')]
class ArticleController extends AbstractController
{
    public function __construct(private Security $security)
    {
    }

    #[Route('/', name: 'article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var User $user */
        $user = $this->security->getUser();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            return $this->render('article/index.html.twig', [
                'articles' => $articleRepository->findBy([], ['createdAt' => 'DESC']),
            ]);
        }

        return $this->redirectToRoute('app_waiting_validation');
    }

    #[Route('/new', name: 'article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var User $user */
        $user = $this->security->getUser();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            $article = new Article();

            $article->setAuthor($this->getUser());

            $form = $this->createForm(ArticleFormType::class, $article);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if (null === $form['file']->getData()) {
                    $article->setFile('placeholder.webp');
                    $article->setIsPublished(false);
                }

                $entityManager->persist($article);
                $entityManager->flush();

                $this->addFlash('success', 'Votre article est enregistré, il est actuellement en attente de publication.');

                return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('article/new.html.twig', [
                'article' => $article,
                'articleForm' => $form,
            ]);
        }

        return $this->redirectToRoute('app_waiting_validation');
    }

    #[Route('/{id}', name: 'article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var User $user */
        $user = $this->security->getUser();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            return $this->render('article/show.html.twig', [
                'article' => $article,
            ]);
        }

        return $this->redirectToRoute('app_waiting_validation');
    }

    #[Route('/edit/{id}', name: 'article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var User $user */
        $user = $this->security->getUser();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            $form = $this->createForm(ArticleFormType::class, $article);
            $form->handleRequest($request);

            /*        dump($form['file']->getData());
                    dd($form['imageFile']->getData());*/

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($article);
                $entityManager->flush();

                $this->addFlash('success', 'Votre article à bien été mis à jour.');

                return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('article/edit.html.twig', [
                'article' => $article,
                'articleForm' => $form,
            ]);
        }

        return $this->redirectToRoute('app_waiting_validation');
    }

    #[Route('/delete/{id}', name: 'article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var User $user */
        $user = $this->security->getUser();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            if ($this->isCsrfTokenValid('article_deletion_'.$article->getId(), $request->request->get('csrf_token'))) {
                $entityManager->remove($article);
                $entityManager->flush();

                $this->addFlash(
                    'danger',
                    sprintf('Article %s effacé !', $article->getTitle())
                );
            }

            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('app_waiting_validation');
    }
}
