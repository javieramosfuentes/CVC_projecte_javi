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

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
// Crear equipos
        $team1 = new Team();
        $team1->setName('Equipo 1');
        $team1->setShield('ruta/a/escudo1.png');
        $team1->setId(1);
        $manager->persist($team1);

        $team2 = new Team();
        $team2->setName('Equipo 2');
        $team2->setShield('ruta/a/escudo2.png');
        $team1->setId(2);
        $manager->persist($team2);

        // Crear entrenadores
        $coach1 = new Coach();
        $coach1->setName('Entrenador1');
        $coach1->setLastname('Apellido1');
        $coach1->setIdTeam($team1);
        $manager->persist($coach1);

        $coach2 = new Coach();
        $coach2->setName('Entrenador2');
        $coach2->setLastname('Apellido2');
        $coach2->setIdTeam($team1);
        $manager->persist($coach2);

        // Crear jugadores
        $player1 = new Player();
        $player1->setName('Jugador1');
        $player1->setLastname('Apellido1');
        $player1->setPosition('DEL');
        $player1->setAge(25);
        $player1->setIdTeam($team1);
        $manager->persist($player1);

        $player2 = new Player();
        $player2->setName('Jugador2');
        $player2->setLastname('Apellido2');
        $player2->setPosition('MED');
        $player2->setAge(23);
        $player2->setIdTeam($team1);
        $manager->persist($player2);

        // Crear usuarios
        $user1 = new User();
        $user1->setEmail('usuario1@example.com');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('usuario2@example.com');
        $manager->persist($user2);

        // Crear registros de inicio de sesión
        $login1 = new Login();
        $login1->setUsername('usuario1');
        $login1->setPassword('password1');
        $login1->setRole('ROLE_USER');
        $login1->setLastLogin(new \DateTime());
        $manager->persist($login1);

        $login2 = new Login();
        $login2->setUsername('usuario2');
        $login2->setPassword('password2');
        $login2->setRole('ROLE_ADMIN');
        $login2->setLastLogin(new \DateTime());
        $manager->persist($login2);

        // Crear álbum
        $album = new Album();
        // Añadir más configuración de álbum si es necesario
        $manager->persist($album);

        $manager->flush();
    }
}
