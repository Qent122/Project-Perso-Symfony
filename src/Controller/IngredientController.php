<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{

    /**
     * This controller display all ingredient
     * 
     * 
     * @param IngredientRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response 
     */

    #[Route('/ingredient', name: 'ingredient.index', methods: ['GET'])]
    public function index(IngredientRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {


        $ingredients = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10 /*limit per page*/
        );
        return $this->render('pages/ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }


    /**
     * This controller show a form which create an ingredient
     *
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     * 
     */

    #[Route('ingredient/new', "ingredient.new", methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $ingredient = new ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();

            $manager->persist($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient a été créer avec succès !'
            );

            return $this->redirectToRoute('ingredient.index');
        }

        return $this->render('pages/ingredient/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

/**
 * This controller allows to modfy an ingredient
 * 
 * 
 * @param Ingredient $ingredient
 * @param Request $request
 * @param EntityManagerInterface $manager
 * 
 */

    #[Route('/ingredient/edit/{id}', 'ingredient.edit', methods: ['GET', 'POST'])]
    public function edit(Ingredient $ingredient, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();

            $manager->persist($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient a été modifié avec succès !'
            );

            return $this->redirectToRoute('ingredient.index');
        }

        return $this->render('pages/ingredient/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * This controller allows to delete an ingredient
     * 
     * 
     * @param EntityManagerInterface $manager
     * @param Ingredient $ingredient
     * 
     */

    #[Route('/ingredient/delete/{id}', 'ingredient.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Ingredient $ingredient): Response
    {

        if (!$ingredient) {
            $this->addFlash(
                'warning',
                'L\'ingrédient rechercher n\'a pas été trouvé !'
            );

            return $this->redirectToRoute('ingredient.index');
        } else {
            $manager->remove($ingredient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient a été supprimer avec succès !'
            );

            return $this->redirectToRoute('ingredient.index');
        }
    }
}
