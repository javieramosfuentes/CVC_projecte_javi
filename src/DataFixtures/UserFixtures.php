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
        // $product = new Product();
        // $manager->persist($product);
//        $user = new User();
//        $user->setEmail($this->faker->email);
//        $manager->persist($user);
        $manager->flush();
    }
}
