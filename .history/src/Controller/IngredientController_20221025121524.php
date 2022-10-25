<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use ContainerLmvSvKy\PaginatorInterface_82dac15;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientRepository $repository, PaginatorInterface $paginator): Response
    {

        $ingredients = $repository->findAll();

        return $this->render('pages/ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
        
    }
}