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

use Doctrine\Common\Collections\Collection;
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TranslatableInterface;
use WellCommerce\Bundle\OrderBundle\Entity\OrderStatus;

/**
 * Interface PaymentMethodInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface PaymentMethodInterface extends
    EntityInterface,
    TimestampableInterface,
    TranslatableInterface,
    BlameableInterface
{
    /**
     * Returns payment method processor
     *
     * @return string
     */
    public function getProcessor(): string;
    
    /**
     * Sets payment method processor
     *
     * @param string $processor
     */
    public function setProcessor(string $processor);
    
    /**
     * @return Collection
     */
    public function getShippingMethods(): Collection;
    
    /**
     * @param Collection $shippingMethods
     */
    public function setShippingMethods(Collection $shippingMethods);
    
    /**
     * @return OrderStatus
     */
    public function getPaymentPendingOrderStatus();
    
    /**
     * @param OrderStatus $paymentPendingOrderStatus
     */
    public function setPaymentPendingOrderStatus(OrderStatus $paymentPendingOrderStatus);
    
    /**
     * @return OrderStatus
     */
    public function getPaymentSuccessOrderStatus();
    
    /**
     * @param OrderStatus $paymentSuccessOrderStatus
     */
    public function setPaymentSuccessOrderStatus(OrderStatus $paymentSuccessOrderStatus);
    
    /**
     * @return OrderStatus
     */
    public function getPaymentFailureOrderStatus();
    
    /**
     * @param OrderStatus $paymentFailureOrderStatus
     */
    public function setPaymentFailureOrderStatus(OrderStatus $paymentFailureOrderStatus);
    
    /**
     * @return array
     */
    public function getConfiguration(): array;
    
    /**
     * @param array $configuration
     */
    public function setConfiguration(array $configuration);
}
