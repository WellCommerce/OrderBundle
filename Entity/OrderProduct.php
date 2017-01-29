<?php

namespace WellCommerce\Bundle\OrderBundle\Entity;

use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use WellCommerce\Bundle\AppBundle\Entity\DiscountablePrice;
use WellCommerce\Bundle\AppBundle\Entity\Price;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Identifiable;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\ProductBundle\Entity\ProductAwareTrait;
use WellCommerce\Bundle\ProductBundle\Entity\VariantAwareTrait;

/**
 * Class OrderProduct
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class OrderProduct implements EntityInterface
{
    use Identifiable;
    use Timestampable;
    use ProductAwareTrait;
    use VariantAwareTrait;
    use OrderAwareTrait;
    
    protected $quantity = 1;
    protected $weight   = 0.00;
    protected $options  = [];
    protected $locked   = false;
    
    /**
     * @var Price
     */
    protected $buyPrice;
    
    /**
     * @var Price
     */
    protected $sellPrice;
    
    /**
     * @var Order
     */
    protected $order;
    
    public function __construct()
    {
        $this->buyPrice  = new Price();
        $this->sellPrice = new Price();
    }
    
    public function getCurrentStock(): int
    {
        if ($this->hasVariant()) {
            return $this->getVariant()->getStock();
        }
        
        return $this->getProduct()->getStock();
    }
    
    public function getCurrentSellPrice(): DiscountablePrice
    {
        if ($this->hasVariant()) {
            return $this->getVariant()->getSellPrice();
        }
        
        return $this->getProduct()->getSellPrice();
    }
    
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
    
    public function increaseQuantity(int $increase)
    {
        $this->quantity += $increase;
    }
    
    public function decreaseQuantity(int $decrease)
    {
        $this->quantity -= $decrease;
    }
    
    public function getSellPrice(): Price
    {
        return $this->sellPrice;
    }
    
    public function setSellPrice(Price $sellPrice)
    {
        $this->sellPrice = $sellPrice;
    }
    
    public function getBuyPrice(): Price
    {
        return $this->buyPrice;
    }
    
    public function setBuyPrice(Price $buyPrice)
    {
        $this->buyPrice = $buyPrice;
    }
    
    public function getWeight(): float
    {
        return $this->weight;
    }
    
    public function setWeight(float $weight)
    {
        $this->weight = $weight;
    }
    
    public function getOptions(): array
    {
        return $this->options;
    }
    
    public function setOptions(array $options)
    {
        $this->options = $options;
    }
    
    public function isLocked(): bool
    {
        return $this->locked;
    }
    
    public function setLocked(bool $locked)
    {
        $this->locked = $locked;
    }
    
    public function getOrder(): Order
    {
        return $this->order;
    }
    
    public function setOrder(Order $order = null)
    {
        $this->order = $order;
    }
}
