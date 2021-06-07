<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item", indexes={@ORM\Index(name="item_type_id", columns={"item_type_id"})})
 * @ORM\Entity
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_name", type="string", length=50, nullable=false)
     */
    private $itemName;

    /**
     * @var float
     *
     * @ORM\Column(name="item_price", type="float", precision=10, scale=0, nullable=false)
     */
    private $itemPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="item_code", type="string", length=35, nullable=false)
     */
    private $itemCode;

    /**
     * @var string
     *
     * @ORM\Column(name="item_brand", type="string", length=50, nullable=false)
     */
    private $itemBrand;

    /**
     * @var string
     *
     * @ORM\Column(name="item_grams", type="string", length=20, nullable=false)
     */
    private $itemGrams;

    /**
     * @var \ItemType
     *
     * @ORM\ManyToOne(targetEntity="ItemType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_type_id", referencedColumnName="item_type_id", nullable=false)
     * })
     */
    private $itemType;

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function setItemName(string $itemName): self
    {
        $this->itemName = $itemName;

        return $this;
    }

    public function getItemPrice(): ?float
    {
        return $this->itemPrice;
    }

    public function setItemPrice(float $itemPrice): self
    {
        $this->itemPrice = $itemPrice;

        return $this;
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

    public function getItemBrand(): ?string
    {
        return $this->itemBrand;
    }

    public function setItemBrand(string $itemBrand): self
    {
        $this->itemBrand = $itemBrand;

        return $this;
    }

    public function getItemGrams(): ?string
    {
        return $this->itemGrams;
    }

    public function setItemGrams(string $itemGrams): self
    {
        $this->itemGrams = $itemGrams;

        return $this;
    }

    public function getItemType(): ?ItemType
    {
        return $this->itemType;
    }

    public function setItemType(?ItemType $itemType): self
    {
        $this->itemType = $itemType;

        return $this;
    }


}
