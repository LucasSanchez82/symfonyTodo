<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddTodoController extends AbstractController
{
    #[Route('/add/todo', name: 'add_todo')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($todo);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('add_todo/index.html.twig', [
            'form' => $form,
        ]);
    }
}
