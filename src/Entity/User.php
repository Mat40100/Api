<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={
 *      "get"={"access_control"="is_granted('ROLE_CLIENT') and object.client == user"},
 *      "put"={"access_control"="is_granted('ROLE_CLIENT') and object.client == user"},
 *      "delete"={"access_control"="is_granted('ROLE_CLIENT') and object.client == user"}
 *     },
 *     collectionOperations={
        "get"={"access_control"="is_granted('ROLE_ADMIN')"},
 *      "post"={"access_control"="is_granted('ROLE_CLIENT')"}
 *     }
 * )
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read", "write"})
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="users")
     */
    public $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
