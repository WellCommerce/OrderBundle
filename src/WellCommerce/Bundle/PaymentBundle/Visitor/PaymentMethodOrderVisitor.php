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

namespace WellCommerce\Bundle\PaymentBundle\Visitor;

use WellCommerce\Bundle\OrderBundle\Entity\Order;
use WellCommerce\Bundle\OrderBundle\Visitor\OrderVisitorInterface;
use WellCommerce\Bundle\PaymentBundle\Entity\PaymentMethod;
use WellCommerce\Bundle\ShippingBundle\Entity\ShippingMethod;

/**
 * Class PaymentMethodOrderVisitor
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class PaymentMethodOrderVisitor implements OrderVisitorInterface
{
    public function visitOrder(Order $order)
    {
        if (!$order->getShippingMethod() instanceof ShippingMethod) {
            $order->setPaymentMethod(null);
            
            return;
        }
        
        $shippingMethod = $order->getShippingMethod();
        $paymentMethods = $shippingMethod->getPaymentMethods();
        
        if (null === $order->getPaymentMethod() || false === $paymentMethods->contains($order->getPaymentMethod())) {
            $order->setPaymentMethod($paymentMethods->first());
        }
    }
}
