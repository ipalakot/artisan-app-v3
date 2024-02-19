<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Trader;
use App\Form\RegistrationFormType;
use App\Form\RegistrationTraderFormType;

use App\Security\UserAuthenticator;
use App\Security\TraderAuthenticator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class RegistrationController extends AbstractController
{
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
                    $form->get('password')->getData()
                )
            );

            //encoder confirmpassword 
            $user->setConfirmpassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('confirmpassword')->getData()
                )
            );



            //attribuer un role user 
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

        return $this->render(
            'registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            ]
        );
    } // fin function register 


    #[Route('/register/trader', name: 'app_register_trader')]

    public function registerTrader(Request $request, UserPasswordHasherInterface $userPasswordHasher, TraderAuthenticatorInterface $traderAuthenticator, TraderAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $trader = new Trader(); // Créez une instance de Trader au lieu de User
        $form = $this->createForm(RegistrationTraderFormType::class, $trader); // Utilisez le formulaire de Trader
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Encodez le mot de passe en clair
            $trader->setPassword(
                $userPasswordHasher->hashPassword(
                    $trader,
                    $form->get('password')->getData()
                )
            );

            //encoder le confirmpassword 
            $trader->setConfirmpassword(
                $userPasswordHasher->hashPassword(
                    $trader,
                    $form->get('confirmpassword')->getData()
                )
            );

            //attribuer un role trader 
            $trader->setRoles(['ROLE_Trader']);


    
            $entityManager->persist($trader);
            $entityManager->flush();
            
            return $traderAuthenticator->authenticateTrader(
                $trader,
                $authenticator,
                $request
            );
        }
    
        return $this->render(
            'registration/register_trader.html.twig', [
            'registrationTraderForm' => $form->createView(),
            ]
        );
    }
    





} // fin de classe 




