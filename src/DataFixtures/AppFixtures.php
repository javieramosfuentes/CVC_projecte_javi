<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Coach;
use App\Entity\Login;
use App\Entity\Player;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('es_ES');
    }
    public function load(ObjectManager $manager): void
    {
        $positions = [
            'POR', 'DFC', 'LI', 'LD', 'CAD', 'CAI', 'MC', 'MCD', 'MCO', 'MD', 'MI', 'ED', 'EI', 'SD', 'DC'
        ];

        // Crear equipos
        for ($i = 0; $i < 20; $i++) {
            $team = new Team(); // Crear un nuevo objeto Team
            $team->setName($this->faker->word);
            $team->setShield($this->faker->filePath());
            $manager->persist($team);

            // Crear entrenadores
            for ($k = 0; $k < 2; $k++) {
                $coach = new Coach();
                $coach->setName($this->faker->firstName());
                $coach->setLastname($this->faker->lastName());
                $coach->setTeam($team);
                $manager->persist($coach);
            }

            // Crear jugadores
            for ($j = 0; $j < 22; $j++) {
                $player = new Player();
                $player->setName($this->faker->firstName);
                $player->setLastname($this->faker->lastName);
                $player->setPosition($positions[array_rand($positions)]);
                $player->setAge($this->faker->numberBetween(18, 50));

                if ($player->getPosition() !== 'POR') {
                    $player->setGoals($this->faker->numberBetween(0, 50));
                } else {
                    $player->setGoals(0);
                }

                $player->setTeam($team);
                $manager->persist($player);
            }
        }

        $manager->flush();
    }

}
