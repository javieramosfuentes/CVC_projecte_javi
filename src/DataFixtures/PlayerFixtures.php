<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PlayerFixtures extends Fixture
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
//        $positions = [
//            'GK','CB','LB','RB','RWB','LWB','MC','MCD','MCO','RM','LM','RW','LW','SD','DC'
//        ];
//        $player = new Player();
//        $team = new Team();
//        $player->setName($this->faker->name);
//        $player->setLastname($this->faker->lastName);
//        $player->setAge($this->faker->numberBetween(18,40));
//        $player->setGoals($this->faker->numberBetween(0,30));
//        $player->setPosition(array_rand($positions));
//        $player->setIdTeam($team);
//        $manager->persist($player);
        $manager->flush();
    }
}
