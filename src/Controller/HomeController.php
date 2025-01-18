<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TodoRepository $todoRepository, Request $request): Response
    {
        $search = $request->query->get('search') ?? "";
        $filter = $request->query->get('filter') ?? "";
        $filterOptions = [
            "all",
            "checked",
            "unchecked",
        ];

        $filter = in_array($filter, $filterOptions) ? $filter : "all";
        $todos = $todoRepository->findByTitleContaining($search, $filter);

        return $this->render('home/index.html.twig', [
            'todos' => $todos,
        ]);
    }
}
