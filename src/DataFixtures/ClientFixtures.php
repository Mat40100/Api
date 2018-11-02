<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $clientList= ["Orange","Bouygues","SFR"];

        foreach ($clientList as $name) {
            $client = new Client();
            $client->setName($name);
            $client->setUsername($name);
            $client->setPassword($this->encoder->encodePassword($client,'ecuelles'));
            $client->setRoles(array('ROLE_CLIENT'));

            $manager->persist($client);
        }
        $manager->flush();
    }
}
