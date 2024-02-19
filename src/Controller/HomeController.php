<?php

namespace App\Controller;

use App\Entity\Activitytype;
use App\Repository\ActivitytypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ActivitytypeRepository $activitytypeRepository): Response
    {
        $activitytypes = $activitytypeRepository->findAll();

        return $this->render(
            'home/index.html.twig',
            [
                'controller_name' => 'HomeController',
                'activitytypes' => $activitytypes,
            ]
        );
    }


    //home admin 
    #[Route('/adminhome', name: 'app_home_admin')]
    public function indexAdmin(): Response
    {
        
        return $this->render(
            'home/index_admin.html.twig',
            [
                'controller_name' => 'HomeController',
                            ]
        );
    }





}
