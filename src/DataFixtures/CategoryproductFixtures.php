<?php

namespace App\DataFixtures;

use App\Entity\Categoryproduct;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryproductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            "bio", "viainoiserie", "pain complet", "porc", "boeuf", "volaille", "fromage de chève", "fromage de brebis", "fromage de vache", "fruit", "légume"
        ];
        // $product = new Product();
        // $manager->persist($product);
        foreach ($categories as $title) {
            $categoryproduct = new Categoryproduct();
            $categoryproduct->setTitle($title);
            $manager->persist($categoryproduct);
        }

        $manager->flush();
    }
}
