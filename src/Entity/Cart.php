<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="cart", indexes={@ORM\Index(name="item_id", columns={"item_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Cart
{
    /**
     * @var int
     *
     * @ORM\Column(name="cart_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cartId;

    /**
     * @var int
     *
     * @ORM\Column(name="cart_qty", type="integer", nullable=false)
     */
    private $cartQty;

    /**
     * @var int
     *
     * @ORM\Column(name="cart_stock_id", type="integer", nullable=false)
     */
    private $cartStockId;

    /**
     * @var string
     *
     * @ORM\Column(name="cart_uniqid", type="string", length=35, nullable=false)
     */
    private $cartUniqid;

    /**
     * @var \Item
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="item_id", nullable=false)
     * })
     */
    private $item;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=false)
     * })
     */
    private $user;

    public function getCartId(): ?int
    {
        return $this->cartId;
    }

    public function getCartQty(): ?int
    {
        return $this->cartQty;
    }

    public function setCartQty(int $cartQty): self
    {
        $this->cartQty = $cartQty;

        return $this;
    }

    public function getCartStockId(): ?int
    {
        return $this->cartStockId;
    }

    public function setCartStockId(int $cartStockId): self
    {
        $this->cartStockId = $cartStockId;

        return $this;
    }

    public function getCartUniqid(): ?string
    {
        return $this->cartUniqid;
    }

    public function setCartUniqid(string $cartUniqid): self
    {
        $this->cartUniqid = $cartUniqid;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
