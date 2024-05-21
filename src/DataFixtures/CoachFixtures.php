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
        /**for($i = 0;$i<20;$i++){
            // Crear equipos primero para asegurar que existen antes de asignarlos a los entrenadores
            $team1 = new Team();
            // Suponiendo que la entidad Team tiene métodos setter para sus propiedades
            $team1->setName($this->faker->word);
            $team1->setShield($this->faker->image);
            $manager->persist($team1);

            $coach1 = new Coach();
            $coach1->setName($this->faker->firstName());
            $coach1->setLastname($this->faker->lastName());
            $coach1->setTeam($team1);
            $manager->persist($coach1);
        }
        // Guardar los cambios en la base de datos
        $manager->flush();
         * */
    }
}
