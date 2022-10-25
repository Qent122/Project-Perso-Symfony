<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Generator;

class AppFixtures extends Fixture
{
private Generator $faker;

public function __construct()
{
    /**
     * @var
     */
    $this->faker= Factory::create('fr_FR');
}

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i <= 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName('Ingredient ' . $i)
                ->setPrice(mt_rand(0, 100));
            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}