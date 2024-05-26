<?php

namespace App\DataFixtures;

use App\Entity\Login;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class LoginFixtures extends Fixture
{

    private Generator $faker;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('es_ES');
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
// Crear registros de inicio de sesión
        $user1 = new User();
        $user1->setEmail('usuario1@example.com');
        $login1 = new Login();
        $login1->setUsername('usuario1');
        $login1->setPassword($this->hasher->hashPassword($login1,'usuario1'));
        $login1->setRole('ROLE_USER');
        //$login1->setLastLogin(new \DateTime());
        $login1->setUser($user1);
        $manager->persist($login1);
        $manager->persist($user1);
//
        $user2 = new User();
        $user2->setEmail('usuario1@example.com');
        $login2 = new Login();
        $login2->setUsername('usuario2');
        $login2->setPassword($this->hasher->hashPassword($login2,'usuario2'));
        $login2->setRole('ROLE_ADMIN');
        $login2->setUser($user2);
        //$login2->setLastLogin(new \DateTime());
        $manager->persist($login2);
        $manager->persist($user2);
        $manager->flush();
    }
}
