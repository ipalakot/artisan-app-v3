<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Faker\Factory;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 15; $i++) {
            $user = new User();
            $user->setLastname($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setEmail($faker->email())
                ->setPhone($faker->phoneNumber())
                ->setPassword($faker->password())
                ->setConfirmpassword($faker->password());
            $manager->persist($user);
        }


        $manager->flush();
    }
}
