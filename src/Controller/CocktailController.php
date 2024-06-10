<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class CocktailController extends AbstractController
{
    #[Route('/', name: 'app_cocktail_index', methods: ['GET'])]
    public function index(CocktailRepository $cocktailRepository): Response
    {
        return $this->render('cocktail/index.html.twig', [
            'cocktails' => $cocktailRepository->findAll(),
        ]);
    }

    #[Route('/cocktail/new', name: 'app_cocktail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cocktail = new Cocktail();
        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cocktail);
            $entityManager->flush();

            return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cocktail/new.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form,
        ]);
    }

    #[Route('/cocktail/{id}', name: 'app_cocktail_show', methods: ['GET'])]
    public function show(Cocktail $cocktail): Response
    {
        return $this->render('cocktail/show.html.twig', [
            'cocktail' => $cocktail,
        ]);
    }

    #[Route('/cocktail/{id}/edit', name: 'app_cocktail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cocktail $cocktail, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cocktail/edit.html.twig', [
            'cocktail' => $cocktail,
            'form' => $form,
        ]);
    }

    #[Route('/cocktail/{id}', name: 'app_cocktail_delete', methods: ['POST'])]
    public function delete(Request $request, Cocktail $cocktail, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cocktail->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cocktail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
    }
}
