<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


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
 *          "post"={"access_control"="is_granted('ROLE_CLIENT')"},
            "ClientGet"={
     *          "method"="GET",
     *          "controller"=App\Controller\UsersGet::class
 *          }
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 6
     *     )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"read", "write"})
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"read","write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max = 150
     *     )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"read","write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max = 150
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="text", length=150)
     * @Groups({"read","write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max = 150
     * )
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="users")
     * @Groups({"admin:read"})
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

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }


}
