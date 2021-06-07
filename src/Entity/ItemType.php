<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemType
 *
 * @ORM\Table(name="item_type")
 * @ORM\Entity
 */
class ItemType
{
    /**
     * @var int
     *
     * @ORM\Column(name="item_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_type_desc", type="string", length=50, nullable=false)
     */
    private $itemTypeDesc;

    public function getItemTypeId(): ?int
    {
        return $this->itemTypeId;
    }

    public function getItemTypeDesc(): ?string
    {
        return $this->itemTypeDesc;
    }

    public function setItemTypeDesc(string $itemTypeDesc): self
    {
        $this->itemTypeDesc = $itemTypeDesc;

        return $this;
    }


}
