<?php

namespace App\Controller;

use App\Entity\Trader; 
use App\Form\RegistrationTraderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


//use Symfony\Component\PasswordHasher\Hasher\TraderPasswordHasherInterface; 


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationTraderController extends AbstractController
{
    #[Route('/register/trader', name: 'app_register_trader')]
    public function registerTrader(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $trader = new Trader();
        $form = $this->createForm(RegistrationFormType::class, $trader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the  password
            
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $trader,
                    $form->get('password')->getData()
                )
            );
            
            // encode the  confirmpassword
            
            $user->setConfirmpassword(
                $userPasswordHasher->hashPassword(
                    $trader,
                    $form->get('confirmpassword')->getData()
                )
            );
            



                        // Set default role here
            $trader->setRoles(['ROLE_Trader']);


            $entityManager->persist($trader);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'registration/registertrader.html.twig', [
            'registrationFormTrader' => $form->createView(),
            ]
        );
    }
}
