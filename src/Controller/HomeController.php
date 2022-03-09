<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    public function __construct(private Security $security)
    {
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        /** @var User $user */
        $user = $this->security->getUser();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            return $this->redirectToRoute('app_home');
        }

        return $this->redirectToRoute('app_waiting_validation');
    }

    #[Route('/home', name: 'app_home')]
    public function home(EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->security->getUser();
        $this->denyAccessUnlessGranted('ROLE_USER');

        $articles = $em->getRepository(Article::class)->findAll();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            return $this->render('home/index.html.twig', [
                'articles' => $articles,
            ]);
        }

        return $this->redirectToRoute('app_waiting_validation');
    }
}
