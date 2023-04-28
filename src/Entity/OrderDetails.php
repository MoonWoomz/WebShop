<?php

namespace App\Entity;

use App\Repository\OrderDetailsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailsRepository::class)]
class OrderDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'orderDetails', targetEntity: Product::class)]
    private Collection $product;

    #[ORM\ManyToOne(inversedBy: 'OrderRecipt')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $orderRecipt = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $TotalPrice = null;

    #[ORM\OneToMany(mappedBy: 'discountApplied', targetEntity: Discount::class)]
    private Collection $DiscountApplied;

    public function __construct()
    {
        $this->product = new ArrayCollection();
        $this->DiscountApplied = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
            $product->setOrderDetails($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getOrderDetails() === $this) {
                $product->setOrderDetails(null);
            }
        }

        return $this;
    }

    public function getOrderRecipt(): ?Order
    {
        return $this->orderRecipt;
    }

    public function setOrderRecipt(?Order $orderRecipt): self
    {
        $this->orderRecipt = $orderRecipt;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->TotalPrice;
    }

    public function setTotalPrice(string $TotalPrice): self
    {
        $this->TotalPrice = $TotalPrice;

        return $this;
    }

    /**
     * @return Collection<int, Discount>
     */
    public function getDiscountApplied(): Collection
    {
        return $this->DiscountApplied;
    }

    public function addDiscountApplied(Discount $discountApplied): self
    {
        if (!$this->DiscountApplied->contains($discountApplied)) {
            $this->DiscountApplied->add($discountApplied);
            $discountApplied->setDiscountApplied($this);
        }

        return $this;
    }

    public function removeDiscountApplied(Discount $discountApplied): self
    {
        if ($this->DiscountApplied->removeElement($discountApplied)) {
            // set the owning side to null (unless already changed)
            if ($discountApplied->getDiscountApplied() === $this) {
                $discountApplied->setDiscountApplied(null);
            }
        }

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
