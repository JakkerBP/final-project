<?php

namespace App\Entity;

use App\Repository\OrderdetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderdetailsRepository::class)]
class Orderdetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity_ordered = null;

    #[ORM\Column]
    private ?int $total_price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantityOrdered(): ?int
    {
        return $this->quantity_ordered;
    }

    public function setQuantityOrdered(int $quantity_ordered): self
    {
        $this->quantity_ordered = $quantity_ordered;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }
}
