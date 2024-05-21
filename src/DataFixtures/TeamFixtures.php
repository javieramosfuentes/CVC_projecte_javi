<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class TeamFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }

    public function load(ObjectManager $manager): void
    {
        /**$team1 = new Team();
        $team1->setName('Equipo 1');
        $team1->setShield('ruta/a/escudo1.png');
        $manager->persist($team1);

        $team2 = new Team();
        $team2->setName('Equipo 2');
        $team2->setShield('ruta/a/escudo2.png');
        $manager->persist($team2);
        $manager->flush();
         * */
    }
}
