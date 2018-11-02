<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={
 *      "get"={"access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *      "put"={"access_control"="is_granted('ROLE_ADMIN)"},
 *      "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *     collectionOperations={
        "get"={"access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *      "post"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     }
 * )
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"write"})
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", length=10)
     * @Groups({"write"})
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }


}
