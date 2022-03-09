<?php

namespace App\Controller\Application;

use App\Entity\User;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ContactController extends AbstractController
{
    /**
     * @param Security $security
     */
    public function __construct(private Security $security)
    {
    }

    /**
     * @param Request         $request
     * @param MailerInterface $mailer
     *
     * @return Response
     */
    #[Route('/contact', name: 'app_contact')]
    public function test(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        /** @var User $user */
        $user = $this->getUser();

        if (false === $user->getIsValide()) {
            $this->redirectToRoute('app_waiting_validation');
        } else {
            if ($form->isSubmitted() && $form->isValid()) {
                $contactFormData = $form->getData();

                $email = (new Email())
                    ->from($user->getEmail())
                    ->to('aperp59@gmail.com')
                    ->subject('Sujet a définir')
                    ->text('Expéditeur : '.$contactFormData['email'].\PHP_EOL.
                        'Message: '.$contactFormData['message'],
                        'text/plain');

                try {
                    $mailer->send($email);
                } catch (TransportExceptionInterface $e) {
                }

                $this->addFlash('success', 'Votre Email a été envoyé avec succès.');

                return $this->redirectToRoute('article_index');
            }

            return $this->render('contact/index.html.twig', [
                'contactForm' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('app_waiting_validation');
    }
}
