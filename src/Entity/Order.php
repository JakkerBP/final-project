<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $order_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $payment_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $delivery_at = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderAt(): ?\DateTimeImmutable
    {
        return $this->order_at;
    }

    public function setOrderAt(\DateTimeImmutable $order_at): self
    {
        $this->order_at = $order_at;

        return $this;
    }

    public function getPaymentAt(): ?\DateTimeImmutable
    {
        return $this->payment_at;
    }

    public function setPaymentAt(?\DateTimeImmutable $payment_at): self
    {
        $this->payment_at = $payment_at;

        return $this;
    }

    public function getDeliveryAt(): ?\DateTimeImmutable
    {
        return $this->delivery_at;
    }

    public function setDeliveryAt(?\DateTimeImmutable $delivery_at): self
    {
        $this->delivery_at = $delivery_at;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
