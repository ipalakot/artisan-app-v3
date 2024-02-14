<?php

namespace App\Controller;


use App\Entity\Trader;
use App\Entity\Image;


use App\Form\TraderType;
use App\Repository\TraderRepository;
use App\Repository\ActivitytypeRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/trader')]
class TraderController extends AbstractController
{
    //afficher tous les trader pour admin 
    #[Route('/', name: 'app_trader_index', methods: ['GET'])]
    public function index(TraderRepository $traderRepository): Response
    {
        return $this->render(
            'trader/index.html.twig', [
            'traders' => $traderRepository->findAll(),
            ]
        );
    }
    //Créer un trader pour admin  
    #[Route('/new', name: 'app_trader_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trader = new Trader();
        $form = $this->createForm(TraderType::class, $trader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //gestion des images 
            $this->uploadImages($form, 'profilephoto', 'addProfilephoto',  $trader);
            
            
            $entityManager->persist($trader);
            $entityManager->flush();

            return $this->redirectToRoute('app_trader_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm(
            'trader/new.html.twig', [
            'trader' => $trader,
            'form' => $form,
            ]
        );
    }

    //afficher les traders par catégories 

    #[Route('/{id}/activitytype', name: 'app_trader_activitytype', methods: ['GET'])]
    public function traderByActivitytype($id, TraderRepository $traderRepository, ActivitytypeRepository $activitytypeRepository): Response
    {
        $traders = $traderRepository->findByTraderActivitytype($id); 
        //$activitytype= $activitytypeRepository->find($id); 
        return $this->render(
            'trader/traderlist.html.twig', [
            //'activitytypes' => $activitytypes,
            'traders' => $traders, 
            ]
        );
    }
    



    //afficher les caractéristiques d'un trader pour admin 
    #[Route('/{id}', name: 'app_trader_show', methods: ['GET'])]
    public function show(Trader $trader): Response
    {
        return $this->render(
            'trader/show.html.twig', [
            'trader' => $trader,
            ]
        );
    }


    //afficher la vitrine d'un trader 
    #[Route('/{id}/showcase', name: 'app_trader_showcase', methods: ['GET'])]
    public function showcase(Trader $trader): Response
    {
        return $this->render(
            'trader/showcase.html.twig', [
            'trader' => $trader,
            ]
        );
    }


    //modifier un trader pour admin 
    #[Route('/{id}/edit', name: 'app_trader_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trader $trader, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TraderType::class, $trader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion des images pour profilephoto 
            $images = $form->get('profilephoto')->getData();

            // On boucle sur les images (lorsque j'ai plusieurs images)
            foreach ($images as $image) {
                // On génère un nouveau nom de fichier pour éviter que deux fichiers aient le même nom
                $fichier = md5(uniqid()) . '.' . $image->guessExtension(); // guessExtension récupère l'extension du fichier

                // On passe le fichier dans le dossier uploads
                // Stockage de l'image sur le disque (l'image physique)
                $image->move(
                    $this->getParameter('images_directory'), // N'oublie pas la configuration au niveau de Services.yaml
                    $fichier
                );

                // On va alors stocker (le nom de l'image) dans la base de données
                $img = new Image();
                $img->setName($fichier);
                $trader->addProfilephoto($img); // Utiliser la méthode addProfilephoto au lieu de addImage
            }
            
            $entityManager->flush();

            return $this->redirectToRoute('app_trader_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm(
            'trader/edit.html.twig', [
            'trader' => $trader,
            'form' => $form,
            ]
        );
    }

    //Suprimer un trader pour admin 
    #[Route('/{id}', name: 'app_trader_delete', methods: ['POST'])]
    public function delete(Request $request, Trader $trader, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trader->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trader);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_trader_index', [], Response::HTTP_SEE_OTHER);
    }

    //fonction générique pour l'upload de fichier 

    private function uploadImages($form, string $fieldName, string $addField, Trader $trader): void
    {
        $images = $form->get($fieldName)->getData();
        // On boucle sur les images (lorsque j'ai plusieurs images)
        foreach ($images as $image) {
            // On génère un nouveau nom de fichier pour éviter que deux fichiers aient le même nom
            $fichier = md5(uniqid()) . '.' . $image->guessExtension(); // guessExtension récupère l'extension du fichier

            // On passe le fichier dans le dossier uploads
            // Stockage de l'image sur le disque (l'image physique)
            $image->move(
                $this->getParameter('images_directory'), // N'oublie pas la configuration au niveau de Services.yaml
                $fichier
            );

            // On va alors stocker (le nom de l'image) dans la base de données
            $img = new Image();
            $img->setName($fichier);
            $trader->$addField($img); // Utiliser la méthode addProfilephoto au lieu de addImage
        }
    } 





    


    
}
