<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sales
 *
 * @ORM\Table(name="sales")
 * @ORM\Entity
 */
class Sales
{
    /**
     * @var int
     *
     * @ORM\Column(name="sales_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $salesId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_code", type="string", length=35, nullable=false)
     */
    private $itemCode;

    /**
     * @var string
     *
     * @ORM\Column(name="generic_name", type="string", length=35, nullable=false)
     */
    private $genericName;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=35, nullable=false)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="gram", type="string", length=35, nullable=false)
     */
    private $gram;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=35, nullable=false)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="qty", type="integer", nullable=false)
     */
    private $qty;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sold", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateSold;

    public function getSalesId(): ?int
    {
        return $this->salesId;
    }

    public function getItemCode(): ?string
    {
        return $this->itemCode;
    }

    public function setItemCode(string $itemCode): self
    {
        $this->itemCode = $itemCode;

        return $this;
    }

    public function getGenericName(): ?string
    {
        return $this->genericName;
    }

    public function setGenericName(string $genericName): self
    {
        $this->genericName = $genericName;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getGram(): ?string
    {
        return $this->gram;
    }

    public function setGram(string $gram): self
    {
        $this->gram = $gram;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDateSold(): ?\DateTimeInterface
    {
        return $this->dateSold;
    }

    public function setDateSold(\DateTimeInterface $dateSold): self
    {
        $this->dateSold = $dateSold;

        return $this;
    }


}
