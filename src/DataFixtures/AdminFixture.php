<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $UserList = ["mat_admin"=>array("ROLE_ADMIN")];

        foreach ($UserList as $usrName => $role) {
            $user = new Admin();
            $user->setRoles($role);
            $user->setUsername($usrName);
            $user->setPassword($this->encoder->encodePassword(
                $user,'ecuelles'
            ));

            $manager->persist($user);
        }
        $manager->flush();
    }
}