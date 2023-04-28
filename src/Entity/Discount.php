<?php

namespace App\Entity;

use App\Repository\DiscountRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscountRepository::class)]
class Discount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'DiscountApplied')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrderDetails $discountApplied = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateExpire = null;

    #[ORM\Column]
    private ?int $Count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscountApplied(): ?OrderDetails
    {
        return $this->discountApplied;
    }

    public function setDiscountApplied(?OrderDetails $discountApplied): self
    {
        $this->discountApplied = $discountApplied;

        return $this;
    }

    public function getDateExpire(): ?\DateTimeInterface
    {
        return $this->DateExpire;
    }

    public function setDateExpire(\DateTimeInterface $DateExpire): self
    {
        $this->DateExpire = $DateExpire;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->Count;
    }

    public function setCount(int $Count): self
    {
        $this->Count = $Count;

        return $this;
    }
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
