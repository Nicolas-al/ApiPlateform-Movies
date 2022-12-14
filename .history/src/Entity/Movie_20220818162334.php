<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['collection']]
        ],
        'post'
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['item']]
        ],
        'put',
        'delete'
    ],
)]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['collection', 'item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['collection', 'item'])]
    private ?string $title = null;

    #[ORM\Column]
    #[Groups(['collection', 'item'])]
    private ?int $duration = null;

    #[ORM\Column]
    #[Groups(['collection', 'item'])]
    private ?int $productionYear = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['collection', 'item'])]
    private ?string $synopsis = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['collection', 'item'])] 
    private ?Genre $genre = null;

    #[ORM\ManyToMany(targetEntity: Person::class)]
    #[ORM\JoinTable(name: 'movie_actors')]
    #[ApiSubresource]
    #[Groups(['item'])]
    private Collection $actors;

    #[ORM\ManyToMany(targetEntity: Person::class)]
    #[ORM\JoinTable(name: 'movie_directors')]
    #[ApiSubresource]
    #[Groups(['item'])]
    private Collection $directors;

    
    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getProductionYear(): ?int
    {
        return $this->productionYear;
    }

    public function setProductionYear(int $productionYear): self
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }


    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Person $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
        }

        return $this;
    }

    public function removeActor(Person $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getDirectors(): Collection
    {
        return $this->directors;
    }

    public function addDirector(Person $director): self
    {
        if (!$this->directors->contains($director)) {
            $this->directors->add($director);
        }

        return $this;
    }

    public function removeDirector(Person $director): self
    {
        $this->directors->removeElement($director);

        return $this;
    }
}
