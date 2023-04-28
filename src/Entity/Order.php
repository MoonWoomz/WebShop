<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(length: 255)]
    private ?string $Address = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\OneToMany(mappedBy: 'orderRecipt', targetEntity: OrderDetails::class)]
    private Collection $OrderRecipt;

    public function __construct()
    {
        $this->OrderRecipt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderRecipt(): Collection
    {
        return $this->OrderRecipt;
    }

    public function addOrderRecipt(OrderDetails $orderRecipt): self
    {
        if (!$this->OrderRecipt->contains($orderRecipt)) {
            $this->OrderRecipt->add($orderRecipt);
            $orderRecipt->setOrderRecipt($this);
        }

        return $this;
    }

    public function removeOrderRecipt(OrderDetails $orderRecipt): self
    {
        if ($this->OrderRecipt->removeElement($orderRecipt)) {
            // set the owning side to null (unless already changed)
            if ($orderRecipt->getOrderRecipt() === $this) {
                $orderRecipt->setOrderRecipt(null);
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
