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
        // $product = new Product();
        // $manager->persist($product);
//        $login = new Login();
//        $login->setUsername("test");
//        $login->setPassword($this->hasher->hashPassword($login,'testPassword'));
//        $login->setRole("ADMIN");
//        $login->setIdUser(1);
//        $manager->persist($login);
        $manager->flush();
    }
}
