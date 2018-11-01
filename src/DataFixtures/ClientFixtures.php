<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $clientList= ["Orange","Bouygues","SFR"];

        foreach ($clientList as $name) {
            $client = new Client();
            $client->setName($name);
            $manager->persist($client);
        }
        $manager->flush();
    }
}
