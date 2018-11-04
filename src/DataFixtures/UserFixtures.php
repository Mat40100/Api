<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $clientList = $manager->getRepository(Client::class)->findAll();

        $userName = "Utilisateur";

        for ($i = 1; $i<10; $i++) {
            $user = new User();
            $user->setUsername($userName.$i);
            $user->setEmail($userName.$i.'@testeurs.org');
            $user->setPassword('ecuelles'.$i);
            $user->setFirstname('test'.$i);
            $user->setLastname('test'.$i);
            $randNumber = array_rand($clientList);
            $user->setClient($clientList[$randNumber]);

            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ClientFixtures::class,
        );
    }
}