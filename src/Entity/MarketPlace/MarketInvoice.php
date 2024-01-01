<?php

namespace App\Entity\MarketPlace;

use App\Repository\MarketPlace\MarketInvoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarketInvoiceRepository::class)]
class MarketInvoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'marketInvoice', cascade: ['persist', 'remove'])]
    private ?MarketOrders $orders = null;

    #[ORM\Column(length: 50)]
    private ?string $number = null;

    #[ORM\Column]
    private ?float $tax = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $paid_at = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MarketPaymentMethod $payment_method = null;


    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return MarketOrders|null
     */
    public function getOrders(): ?MarketOrders
    {
        return $this->orders;
    }

    /**
     * @param MarketOrders|null $orders
     * @return $this
     */
    public function setOrders(?MarketOrders $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return $this
     */
    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTax(): ?float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     * @return $this
     */
    public function setTax(float $tax): static
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * @param \DateTimeImmutable $created_at
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPayedAt(): ?\DateTimeInterface
    {
        return $this->paid_at;
    }

    /**
     * @param \DateTimeInterface|null $paid_at
     * @return $this
     */
    public function setPayedAt(?\DateTimeInterface $paid_at): static
    {
        $this->paid_at = $paid_at;

        return $this;
    }

    /**
     * @return MarketPaymentMethod|null
     */
    public function getPaymentMethod(): ?MarketPaymentMethod
    {
        return $this->payment_method;
    }

    /**
     * @param MarketPaymentMethod|null $payment_method
     * @return $this
     */
    public function setPaymentMethod(?MarketPaymentMethod $payment_method): static
    {
        $this->payment_method = $payment_method;

        return $this;
    }
}
