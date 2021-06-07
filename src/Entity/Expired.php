<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expired
 *
 * @ORM\Table(name="expired")
 * @ORM\Entity
 */
class Expired
{
    /**
     * @var int
     *
     * @ORM\Column(name="exp_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $expId;

    /**
     * @var string
     *
     * @ORM\Column(name="exp_itemName", type="string", length=50, nullable=false)
     */
    private $expItemname;

    /**
     * @var float
     *
     * @ORM\Column(name="exp_itemPrice", type="float", precision=10, scale=0, nullable=false)
     */
    private $expItemprice;

    /**
     * @var int
     *
     * @ORM\Column(name="exp_itemQty", type="integer", nullable=false)
     */
    private $expItemqty;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="exp_expiredDate", type="date", nullable=false)
     */
    private $expExpireddate;

    public function getExpId(): ?int
    {
        return $this->expId;
    }

    public function getExpItemname(): ?string
    {
        return $this->expItemname;
    }

    public function setExpItemname(string $expItemname): self
    {
        $this->expItemname = $expItemname;

        return $this;
    }

    public function getExpItemprice(): ?float
    {
        return $this->expItemprice;
    }

    public function setExpItemprice(float $expItemprice): self
    {
        $this->expItemprice = $expItemprice;

        return $this;
    }

    public function getExpItemqty(): ?int
    {
        return $this->expItemqty;
    }

    public function setExpItemqty(int $expItemqty): self
    {
        $this->expItemqty = $expItemqty;

        return $this;
    }

    public function getExpExpireddate(): ?\DateTimeInterface
    {
        return $this->expExpireddate;
    }

    public function setExpExpireddate(\DateTimeInterface $expExpireddate): self
    {
        $this->expExpireddate = $expExpireddate;

        return $this;
    }


}
