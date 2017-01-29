<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\PaymentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Knp\DoctrineBehaviors\Model\Blameable\Blameable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Enableable;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Identifiable;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Sortable;
use WellCommerce\Bundle\OrderBundle\Entity\OrderStatus;

/**
 * Class PaymentMethod
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class PaymentMethod implements PaymentMethodInterface
{
    use Identifiable;
    use Enableable;
    use Sortable;
    use Translatable;
    use Timestampable;
    use Blameable;
    
    /**
     * @var Collection
     */
    protected $shippingMethods;
    
    /**
     * @var OrderStatus
     */
    protected $paymentPendingOrderStatus;
    
    /**
     * @var OrderStatus
     */
    protected $paymentSuccessOrderStatus;
    
    /**
     * @var OrderStatus
     */
    protected $paymentFailureOrderStatus;
    
    /**
     * @var string
     */
    protected $processor = '';
    
    /**
     * @var array
     */
    protected $configuration = [];
    
    public function __construct()
    {
        $this->shippingMethods = new ArrayCollection();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getProcessor(): string
    {
        return $this->processor;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setProcessor(string $processor)
    {
        $this->processor = $processor;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getShippingMethods(): Collection
    {
        return $this->shippingMethods;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setShippingMethods(Collection $shippingMethods)
    {
        $this->shippingMethods = $shippingMethods;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setConfiguration(array $configuration)
    {
        $this->configuration = $configuration;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPaymentPendingOrderStatus()
    {
        return $this->paymentPendingOrderStatus;
    }
    
    public function setPaymentPendingOrderStatus(OrderStatus $paymentPendingOrderStatus)
    {
        $this->paymentPendingOrderStatus = $paymentPendingOrderStatus;
    }
    
    public function getPaymentSuccessOrderStatus()
    {
        return $this->paymentSuccessOrderStatus;
    }
    
    public function setPaymentSuccessOrderStatus(OrderStatus $paymentSuccessOrderStatus)
    {
        $this->paymentSuccessOrderStatus = $paymentSuccessOrderStatus;
    }
    
    public function getPaymentFailureOrderStatus()
    {
        return $this->paymentFailureOrderStatus;
    }
    
    public function setPaymentFailureOrderStatus(OrderStatus $paymentFailureOrderStatus)
    {
        $this->paymentFailureOrderStatus = $paymentFailureOrderStatus;
    }
}
