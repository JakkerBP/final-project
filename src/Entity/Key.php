<?php

namespace App\Entity;

use App\Repository\KeyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KeyRepository::class)]
#[ORM\Table(name: '`key`')]
class Key
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $symbol = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $keyPreview = null;

    #[ORM\ManyToOne(inversedBy: 'keyss')]
    #[ORM\JoinColumn(nullable: false)]
    private ?KeyCategory $category = null;

    #[ORM\OneToMany(mappedBy: 'keyy', targetEntity: ProjectCustomKey::class)]
    private Collection $projectCustomKeys;

    public function __construct()
    {
        $this->projectCustomKeys = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getKeyPreview(): ?string
    {
        return $this->keyPreview;
    }

    public function setKeyPreview(?string $keyPreview): self
    {
        $this->keyPreview = $keyPreview;

        return $this;
    }

    public function getCategory(): ?KeyCategory
    {
        return $this->category;
    }

    public function setCategory(?KeyCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, ProjectCustomKey>
     */
    public function getProjectCustomKeys(): Collection
    {
        return $this->projectCustomKeys;
    }

    public function addProjectCustomKey(ProjectCustomKey $projectCustomKey): self
    {
        if (!$this->projectCustomKeys->contains($projectCustomKey)) {
            $this->projectCustomKeys->add($projectCustomKey);
            $projectCustomKey->setKeyy($this);
        }

        return $this;
    }

    public function removeProjectCustomKey(ProjectCustomKey $projectCustomKey): self
    {
        if ($this->projectCustomKeys->removeElement($projectCustomKey)) {
            // set the owning side to null (unless already changed)
            if ($projectCustomKey->getKeyy() === $this) {
                $projectCustomKey->setKeyy(null);
            }
        }

        return $this;
    }


}
