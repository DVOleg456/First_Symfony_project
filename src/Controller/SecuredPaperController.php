<?php

namespace App\Controller;

use App\Entity\SecuredPaper;
use App\Form\SecuredPaperType;
use App\Repository\SecuredPaperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/secured/paper')]
final class SecuredPaperController extends AbstractController
{
    #[Route(name: 'app_secured_paper_index', methods: ['GET'])]
    public function index(SecuredPaperRepository $securedPaperRepository): Response
    {
        return $this->render('secured_paper/index.html.twig', [
            'secured_papers' => $securedPaperRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_secured_paper_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $securedPaper = new SecuredPaper();
        $form = $this->createForm(SecuredPaperType::class, $securedPaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($securedPaper);
            $entityManager->flush();
            //$entityManager->

            return $this->redirectToRoute('app_secured_paper_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secured_paper/new.html.twig', [
            'secured_paper' => $securedPaper,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secured_paper_show', methods: ['GET'])]
    public function show(SecuredPaper $securedPaper): Response
    {
        return $this->render('secured_paper/show.html.twig', [
            'secured_paper' => $securedPaper,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_secured_paper_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SecuredPaper $securedPaper, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecuredPaperType::class, $securedPaper);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_secured_paper_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secured_paper/edit.html.twig', [
            'secured_paper' => $securedPaper,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secured_paper_delete', methods: ['POST'])]
    public function delete(Request $request, SecuredPaper $securedPaper, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$securedPaper->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($securedPaper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_secured_paper_index', [], Response::HTTP_SEE_OTHER);
    }
}
