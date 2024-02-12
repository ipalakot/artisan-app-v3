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
}
