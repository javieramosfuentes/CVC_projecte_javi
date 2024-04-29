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


        // Crear álbum
        $album = new Album();
        // Añadir más configuración de álbum si es necesario
        $manager->persist($album);

        $manager->flush();
    }
}
