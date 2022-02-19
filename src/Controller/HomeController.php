<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_home');
    }

    #[Route('/home', name: 'app_home')]
    public function home(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Article::class)->findAll();

        // Todo : Si isValide = false return to error/user-is_not_valide.html.twig

        // public function __construct(private Security $security){}
        // $userValid = $this->security->getUser()->getIsValide();
        //        dd($userValid);
        //        if ($userValid == false) {
        //            $this->render('error/user-is_not_valide.html.twig');
        //        }
        //

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
