<?php

namespace App\EventListener;

use App\Entity\Client;
use App\Entity\User;
use App\Services\ClientService;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class DoctrineListener
{
    private $clientService;
    private $security;

    public function __construct(ClientService $clientService, Security $security)
    {
        $this->clientService = $clientService;
        $this->security = $security;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Client) {
            return;
        }

        $entity->setPassword($this->clientService->encodePassword($entity));
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        $entity->setClient($this->security->getUser());
    }
}