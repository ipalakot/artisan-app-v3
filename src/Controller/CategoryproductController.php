<?php

namespace App\Controller;

use App\Entity\Categoryproduct;
use App\Form\CategoryproductType;
use App\Repository\CategoryproductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categoryproduct')]
class CategoryproductController extends AbstractController
{
    #[Route('/', name: 'app_categoryproduct_index', methods: ['GET'])]
    public function index(CategoryproductRepository $categoryproductRepository): Response
    {
        return $this->render('categoryproduct/index.html.twig', [
            'categoryproducts' => $categoryproductRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categoryproduct_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoryproduct = new Categoryproduct();
        $form = $this->createForm(CategoryproductType::class, $categoryproduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoryproduct);
            $entityManager->flush();

            return $this->redirectToRoute('app_categoryproduct_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoryproduct/new.html.twig', [
            'categoryproduct' => $categoryproduct,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categoryproduct_show', methods: ['GET'])]
    public function show(Categoryproduct $categoryproduct): Response
    {
        return $this->render('categoryproduct/show.html.twig', [
            'categoryproduct' => $categoryproduct,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categoryproduct_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categoryproduct $categoryproduct, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryproductType::class, $categoryproduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categoryproduct_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoryproduct/edit.html.twig', [
            'categoryproduct' => $categoryproduct,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categoryproduct_delete', methods: ['POST'])]
    public function delete(Request $request, Categoryproduct $categoryproduct, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryproduct->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoryproduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categoryproduct_index', [], Response::HTTP_SEE_OTHER);
    }
}
