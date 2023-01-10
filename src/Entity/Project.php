<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $font = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToMany(targetEntity: KeyCategory::class, inversedBy: 'projects')]
    private Collection $keyCategory;

    #[ORM\OneToOne(inversedBy: 'project', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;

    #[ORM\OneToOne(mappedBy: 'project', cascade: ['persist', 'remove'])]
    private ?Order $orderStat = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectCustomKey::class)]
    private Collection $projectCustomKeys;

    public function __construct()
    {
        $this->keyCategory = new ArrayCollection();
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

    public function getFont(): ?string
    {
        return $this->font;
    }

    public function setFont(string $font): self
    {
        $this->font = $font;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, KeyCategory>
     */
    public function getKeyCategory(): Collection
    {
        return $this->keyCategory;
    }

    public function addKeyCategory(KeyCategory $keyCategory): self
    {
        if (!$this->keyCategory->contains($keyCategory)) {
            $this->keyCategory->add($keyCategory);
        }

        return $this;
    }

    public function removeKeyCategory(KeyCategory $keyCategory): self
    {
        $this->keyCategory->removeElement($keyCategory);

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getOrderStat(): ?Order
    {
        return $this->orderStat;
    }

    public function setOrderStat(Order $orderStat): self
    {
        // set the owning side of the relation if necessary
        if ($orderStat->getProject() !== $this) {
            $orderStat->setProject($this);
        }

        $this->orderStat = $orderStat;

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
            $projectCustomKey->setProject($this);
        }

        return $this;
    }

    public function removeProjectCustomKey(ProjectCustomKey $projectCustomKey): self
    {
        if ($this->projectCustomKeys->removeElement($projectCustomKey)) {
            // set the owning side to null (unless already changed)
            if ($projectCustomKey->getProject() === $this) {
                $projectCustomKey->setProject(null);
            }
        }

        return $this;
    }
}
