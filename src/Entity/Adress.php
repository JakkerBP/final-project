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
    private ?string $adressLine = null;

    #[ORM\Column]
    private ?int $postalCode = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $city = null;

    #[ORM\OneToOne(mappedBy: 'adress', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressLine(): ?string
    {
        return $this->adressLine;
    }

    public function setAdressLine(string $adressLine): self
    {
        $this->adressLine = $adressLine;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        // set the owning side of the relation if necessary
        if ($customer->getAdress() !== $this) {
            $customer->setAdress($this);
        }

        $this->customer = $customer;

        return $this;
    }



}
