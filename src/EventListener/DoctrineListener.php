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

    public function PreUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Client) {
            return;
        }

        $entity->setPassword($this->clientService->encodePassword($entity));

        return;
    }

    public function PrePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        $entity->setClient($this->security->getUser());

        return;
    }
}