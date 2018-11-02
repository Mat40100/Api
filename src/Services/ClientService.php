<?php
/**
 * Created by PhpStorm.
 * User: Mat
 * Date: 02/11/2018
 * Time: 14:39
 */

namespace App\Services;


use App\Entity\Client;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientService
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    /**
     * @param Client|User $client
     * @return string
     */
    public function encodePassword($client)
    {
        return $this->encoder->encodePassword($client, $client->getPassword());
    }
}