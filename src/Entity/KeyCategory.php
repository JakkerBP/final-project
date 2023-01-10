<?php

namespace App\Entity;

use App\Repository\KeyCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KeyCategoryRepository::class)]
class KeyCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $categoryName = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Key::class)]
    private Collection $keyss;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'keyCategory')]
    private Collection $projects;

    public function __construct()
    {
        $this->keyss = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @return Collection<int, Key>
     */
    public function getKeyss(): Collection
    {
        return $this->keyss;
    }

    public function addKeyss(Key $keyss): self
    {
        if (!$this->keyss->contains($keyss)) {
            $this->keyss->add($keyss);
            $keyss->setCategory($this);
        }

        return $this;
    }

    public function removeKeyss(Key $keyss): self
    {
        if ($this->keyss->removeElement($keyss)) {
            // set the owning side to null (unless already changed)
            if ($keyss->getCategory() === $this) {
                $keyss->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addKeyCategory($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeKeyCategory($this);
        }

        return $this;
    }
}
