<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stock
 *
 * @ORM\Table(name="stock", indexes={@ORM\Index(name="item_id", columns={"item_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
{
    /**
     * @var int
     *
     * @ORM\Column(name="stock_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $stockId;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_qty", type="integer", nullable=false)
     */
    private $stockQty;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stock_expiry", type="date", nullable=false)
     */
    private $stockExpiry;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stock_added", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $stockAdded = 'current_timestamp()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stock_manufactured", type="date", nullable=false)
     */
    private $stockManufactured;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stock_purchased", type="date", nullable=false)
     */
    private $stockPurchased;

    /**
     * @var \Item
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="item_id", nullable=false)
     * })
     */
    private $item;

    public function getStockId(): ?int
    {
        return $this->stockId;
    }

    public function getStockQty(): ?int
    {
        return $this->stockQty;
    }

    public function setStockQty(int $stockQty): self
    {
        $this->stockQty = $stockQty;

        return $this;
    }

    public function getStockExpiry(): ?\DateTimeInterface
    {
        return $this->stockExpiry;
    }

    public function setStockExpiry(\DateTimeInterface $stockExpiry): self
    {
        $this->stockExpiry = $stockExpiry;

        return $this;
    }

    public function getStockAdded(): ?\DateTimeInterface
    {
        return $this->stockAdded;
    }

    public function setStockAdded(\DateTimeInterface $stockAdded): self
    {
        $this->stockAdded = $stockAdded;

        return $this;
    }

    public function getStockManufactured(): ?\DateTimeInterface
    {
        return $this->stockManufactured;
    }

    public function setStockManufactured(\DateTimeInterface $stockManufactured): self
    {
        $this->stockManufactured = $stockManufactured;

        return $this;
    }

    public function getStockPurchased(): ?\DateTimeInterface
    {
        return $this->stockPurchased;
    }

    public function setStockPurchased(\DateTimeInterface $stockPurchased): self
    {
        $this->stockPurchased = $stockPurchased;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }


}
