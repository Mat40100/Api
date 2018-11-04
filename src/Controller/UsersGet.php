<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Security;

class UsersGet
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    /**
     * @Method({"GET"})
     * @Route(
     *     name="users_get",
     *     defaults={"_api_resource_class"=App\Entity\User::class,"_api_collection_operation_name"="get"})
     */
    public function __invoke($data)
    {
        if ($this->security->isGranted('ROLE_CLIENT')) {
            $data = $this->entityManager->getRepository(User::class)->findBy(array('client' => $this->security->getUser()->getId()));
            return $data;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            $data = $this->entityManager->getRepository(User::class)->findAll();
            return $data;
        }
    }
}