<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CoachFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
//        $coach = new Coach();
//        $team = new Team();
//        $coach->setName($this->faker->name);
//        $coach->setLastname($this->faker->lastName);
//        $coach->setIdTeam($team->getId());
//        $manager->persist($coach);
        $manager->flush();
    }
}
