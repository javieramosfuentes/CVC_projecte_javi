<?php

namespace App\DataFixtures;

use App\Entity\Login;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class LoginFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create('es_ES');
    }
    public function load(ObjectManager $manager): void
    {
// Crear registros de inicio de sesión
//        $login1 = new Login();
//        $login1->setUsername('usuario1');
//        $login1->setPassword('password1');
//        $login1->setRole('ROLE_USER');
//        $login1->setLastLogin(new \DateTime());
//        $manager->persist($login1);
//
//        $login2 = new Login();
//        $login2->setUsername('usuario2');
//        $login2->setPassword('password2');
//        $login2->setRole('ROLE_ADMIN');
//        $login2->setLastLogin(new \DateTime());
//        $manager->persist($login2);
//        $manager->flush();
    }
}
