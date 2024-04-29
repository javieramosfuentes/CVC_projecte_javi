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
        // Crear equipos primero para asegurar que existen antes de asignarlos a los entrenadores
        $team1 = new Team();
        // Suponiendo que la entidad Team tiene métodos setter para sus propiedades
        $team1->setName($this->faker->word);
        $team1->setShield($this->faker->image);
        $manager->persist($team1);

        $team2 = new Team();
        $team2->setName($this->faker->word);
        $team2->setShield($this->faker->image);
        $manager->persist($team2);

        // Asegurarse de que los equipos se guarden antes de continuar

        // Crear entrenadores y asignarles los equipos ya existentes
        $coach1 = new Coach();
        $coach1->setName('Entrenador1');
        $coach1->setLastname('Apellido1');
        $manager->persist($coach1);

        $coach2 = new Coach();
        $coach2->setName('Entrenador2');
        $coach2->setLastname('Apellido2');
        $manager->persist($coach2);

        // Guardar los cambios en la base de datos
        $manager->flush();
    }
}
