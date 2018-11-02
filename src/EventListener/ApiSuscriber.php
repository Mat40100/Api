<?php

namespace App\EventListener;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class ApiSuscriber implements EventSubscriberInterface
{
    private $authChecker;
    private $Emanager;
    private $security;

    public function __construct(AuthorizationCheckerInterface $authChecker, EntityManagerInterface $entityManager, Security $security)
    {
        $this->authChecker = $authChecker;
        $this->Emanager=$entityManager;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['checkRights', EventPriorities::PRE_READ],
        ];
    }

    public function checkRights(GetResponseEvent $event)
    {
        $route = $event->getRequest()->get('_route');
        if($route == "api_clients_users_get_subresource") {
            $id = $event->getRequest()->get('id');
            $AllowedClient = $this->Emanager->getRepository(Client::class)->find($id);
            if ($this->security->getUser() != $AllowedClient && $AllowedClient){
                throw new HttpException(403, 'Access Denied.');
            }
        }
    }
}