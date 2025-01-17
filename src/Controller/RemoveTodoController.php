<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RemoveTodoController extends AbstractController
{
    #[Route('/remove/todo/{id}', name: 'remove_todo')]
    public function index(int $id, TodoRepository $todoRepository, EntityManagerInterface $entityManager): Response
    {
        $todo = $todoRepository->find($id);
        if ($todo) {
            $entityManager->remove($todo);
            $entityManager->flush($todo);
        }

        return $this->redirectToRoute('app_home');
    }
}
