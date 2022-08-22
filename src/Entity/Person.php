<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'delete', 'put'],
    attributes: ['pagination_enabled' => false],
)]
#[ApiFilter(SearchFilter::class, properties: [
    'firstName' => SearchFilter::STRATEGY_PARTIAL,
    'lastName' => SearchFilter::STRATEGY_PARTIAL,
])]
#[ApiFilter(OrderFilter::class, properties: ['firstName', 'lastName'], arguments: ['orderParameterName' => 'order'])]
#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['item'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['item'])]
    private ?string $lastName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }
}
