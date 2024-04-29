<?php

namespace App\DataFixtures;

use App\Entity\Login;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class UserFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }
    public function load(ObjectManager $manager): void
    {
        // Crear usuarios
        $user1 = new User();
        $user1->setEmail('usuario1@example.com');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('usuario2@example.com');
        $manager->persist($user2);
        $manager->flush();
    }
}
