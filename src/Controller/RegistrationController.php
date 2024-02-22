<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Trader;

use App\Form\RegistrationFormType;
use App\Form\RegistrationTraderFormType;

use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{

    //register pour les users 
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/register/trader', name: 'app_register_trader')]
    public function registerTrader(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $trader = new Trader();
        $form = $this->createForm(RegistrationTraderFormType::class, $trader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $trader->setPassword(
                $userPasswordHasher->hashPassword(
                    $trader,
                    $form->get('password')->getData()
                )
            );
            $trader->setRoles(['ROLE_TRADER']);

            $entityManager->persist($trader);
            $entityManager->flush();

            // Redirection ou traitement supplémentaire après l'enregistrement
            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register_trader.html.twig', [
            'registrationTraderForm' => $form->createView(),
        ]);
    }
}
