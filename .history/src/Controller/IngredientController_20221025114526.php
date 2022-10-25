<?php

namespace App\Controller;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(Ingredient): Response
    {
        return $this->render('pages/ingredient/index.html.twig', [

        ]);
    }
}
