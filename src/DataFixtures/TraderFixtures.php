<?php

namespace App\DataFixtures;

use App\Entity\Trader;
use App\Entity\Activitytype;
use App\Entity\Image; 

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;
use Faker\Generator;

class TraderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $activities = [
            [
                "label" => "Boulangeries Pâtisseries",
                "picture" => "imgdesign/boulangerie.avif"
            ],
            [
                "label" => "Boucheries",
                "picture" => "imgdesign/boucherie.avif"
            ],
            [
                "label" => "Charcuteries Traiteurs",
                "picture" => "imgdesign/traiteur.avif"
            ],
            [
                "label" => "Poissonneries",
                "picture" => "imgdesign/poissonnerie.avif"
            ],
            [
                "label" => "Fromageries",
                "picture" => "imgdesign/fromagerie.avif"
            ],
            [
                "label" => "Primeurs",
                "picture" => "imgdesign/primeur.avif"
            ]
        ];

        foreach ($activities as $activity) {
            $activitytype = new Activitytype();
            $image= new Image();
            $activitytype->setTitle($activity["label"]);
            $image->setName($activity['picture']); 
                        
                        
            $manager->persist($activitytype);
            $manager->persist($image);




            // Créer des traders
            for ($j = 0; $j <= 10; $j++) {
                $trader = new Trader();
                $trader->setLastnameboss($faker->lastName)
                    ->setFirstnameboss($faker->firstName)
                    ->setEmail($faker->email)
                    ->setPassword($faker->password)
                    ->setConfirmpassword($faker->password)
                    ->setCompagnyname($faker->company)
                    ->setSiren($faker->randomNumber())
                    ->setPhone($faker->phoneNumber)
                    ->setAdress($faker->address)
                    ->setActivitytype($activitytype)
                    ->setPresentation($faker->text)
                    ->setPostalcode($faker->postcode())
                    ->setCity($faker->city()); 

                $manager->persist($trader);
            }
        }

        $manager->flush();
    }
}
