<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddTodoController extends AbstractController
{
    #[Route('/add/todo', name: 'app_add_todo')]
    public function index(): Response
    {
        return $this->render('add_todo/index.html.twig', [
            'controller_name' => 'AddTodoController',
        ]);
    }
}
