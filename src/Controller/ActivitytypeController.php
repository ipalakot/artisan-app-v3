<?php

namespace App\Controller;

use App\Entity\Activitytype;
use App\Entity\Image; 

use App\Form\ActivitytypeType;
use App\Repository\ActivitytypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/activitytype')]
class ActivitytypeController extends AbstractController
{

    //afficher toutes les activitytype pour admin 
    #[Route('/', name: 'app_activitytype_index', methods: ['GET'])]
    public function index(ActivitytypeRepository $activitytypeRepository): Response
    {
        return $this->render(
            'activitytype/index.html.twig', [
            'activitytypes' => $activitytypeRepository->findAll(),
            ]
        );
    }
    //créer une nouvelle activitytype pour admin 
    #[Route('/new', name: 'app_activitytype_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activitytype = new Activitytype();
        $form = $this->createForm(ActivitytypeType::class, $activitytype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion des images pour un type d'activité
            $images = $form->get('imgactivity')->getData();

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
                $activitytype->addImgactivity($img); // Utiliser la méthode addImgactivity au lieu de addImage
            }

            $entityManager->persist($activitytype);
                        $entityManager->flush();

            return $this->redirectToRoute('app_activitytype_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm(
            'activitytype/new.html.twig', [
            'activitytype' => $activitytype,
            'form' => $form,
            ]
        );
    }

    //afficher les activitytypes dans block_home_shops 
    






    //afficher les caractéristique d'une activitytype pour admin 
        #[Route('/{id}', name: 'app_activitytype_show', methods: ['GET'])]
    public function show(Activitytype $activitytype): Response
    {
        return $this->render(
            'activitytype/show.html.twig', [
            'activitytype' => $activitytype,
            ]
        );
    }
    //modifier une activitytype pour les admins 
        #[Route('/{id}/edit', name: 'app_activitytype_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activitytype $activitytype, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActivitytypeType::class, $activitytype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Gestion des images pour un type d'activité
            $images = $form->get('imgactivity')->getData();

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
                $activitytype->addImgactivity($img); // Utiliser la méthode addImgactivity au lieu de addImage
            }




            $entityManager->flush();

            return $this->redirectToRoute('app_activitytype_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm(
            'activitytype/edit.html.twig', [
            'activitytype' => $activitytype,
            'form' => $form,
            ]
        );
    }
    //supprimer une activitytype pour les admins 
        #[Route('/{id}', name: 'app_activitytype_delete', methods: ['POST'])]
    public function delete(Request $request, Activitytype $activitytype, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activitytype->getId(), $request->request->get('_token'))) {
            $entityManager->remove($activitytype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_activitytype_index', [], Response::HTTP_SEE_OTHER);
    }
}
