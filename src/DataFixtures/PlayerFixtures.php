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
// Crear jugadores
        $player1 = new Player();
        $team1 = new Team();
        $team1->setName('Equipo 2');
        $team1->setShield('ruta/a/escudo2.png');
        $manager->persist($team1);

        $team1->setName('Equipo 1');
        $team1->setShield('ruta/a/escudo1.png');
        $manager->persist($team1);
        $player1->setName('Jugador1');
        $player1->setLastname('Apellido1');
        $player1->setPosition('DEL');
        $player1->setAge(25);
        $player1->setGoals(30);
        $player1->setTeam($team1);
        $manager->persist($player1);

        $player2 = new Player();
        $team2 = new Team();
        $team2->setName('Equipo 2');
        $team2->setShield('ruta/a/escudo2.png');
        $manager->persist($team2);

        $player2->setName('Jugador2');
        $player2->setLastname('Apellido2');
        $player2->setPosition('MED');
        $player2->setAge(23);
        $player2->setGoals(10);
        $player2->setTeam($team2);
        $manager->persist($player2);
        $manager->flush();
    }
}
