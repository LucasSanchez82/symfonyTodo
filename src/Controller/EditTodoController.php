<?php

namespace App\Controller;

use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EditTodoController extends AbstractController
{
    #[Route('/edit/todo/{id}', name: 'edit_todo')]
    public function index(TodoRepository $todoRepository, EntityManagerInterface $entityManager, Request $request, int $id): Response
    {
        $todo = $todoRepository->find($id);
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($todo);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }
        return $this->render('edit_todo/index.html.twig', [
            'form' => $form,
        ]);
    }
}
