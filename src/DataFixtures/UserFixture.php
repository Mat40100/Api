<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $clientList = $manager->getRepository(Client::class)->findAll();
        $UserList = ["mat_admin"=>array("ROLE_ADMIN"), "mat_user"=> array('ROLE_USER')];

        foreach ($UserList as $usrName => $role) {
            $user = new User();
            $user->setRoles($role);
            $user->setUsername($usrName);
            $user->setPassword($this->encoder->encodePassword(
                $user,'ecuelles'
            ));
            if ($usrName != 'mat_admin') {
                $clientNum = array_rand($clientList) ;
                $user->setClient($clientList[$clientNum]);
            }
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