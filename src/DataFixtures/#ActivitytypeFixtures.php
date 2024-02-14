<?php

namespace App\DataFixtures;

use App\Entity\Activitytype;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActivitytypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $activities = [
            "boulangerie-pâtisserie", "fromagerie", "poissonerie", "boucherie", "charcuterie-traiteur", "primeur", "caviste", "chocolatier", "confiseur"
        ];
        // $product = new Product();
        // $manager->persist($product);

        foreach ($activities as $title) {
            $activitytype = new Activitytype();
            $activitytype->setTitle($title);
            $manager->persist($activitytype);
        }
        $manager->flush();
    }
}
