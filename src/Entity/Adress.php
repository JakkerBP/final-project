<?php

namespace App\Entity;

use App\Repository\AdressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdressRepository::class)]
class Adress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adress_line = null;

    #[ORM\Column]
    private ?int $postal_code = null;

    #[ORM\OneToOne(mappedBy: 'adress', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressLine(): ?string
    {
        return $this->adress_line;
    }

    public function setAdressLine(string $adress_line): self
    {
        $this->adress_line = $adress_line;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        // unset the owning side of the relation if necessary
        if ($customer === null && $this->customer !== null) {
            $this->customer->setAdress(null);
        }

        // set the owning side of the relation if necessary
        if ($customer !== null && $customer->getAdress() !== $this) {
            $customer->setAdress($this);
        }

        $this->customer = $customer;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }


}
