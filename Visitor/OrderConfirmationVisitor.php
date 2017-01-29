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

namespace WellCommerce\Bundle\OrderBundle\Visitor;

use WellCommerce\Bundle\CurrencyBundle\Helper\CurrencyHelperInterface;
use WellCommerce\Bundle\OrderBundle\Entity\Order;
use WellCommerce\Bundle\OrderBundle\Entity\OrderProduct;
use WellCommerce\Bundle\OrderBundle\Generator\OrderNumberGeneratorInterface;
use WellCommerce\Bundle\PaymentBundle\Manager\PaymentManagerInterface;

/**
 * Class OrderConfirmationVisitor
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class OrderConfirmationVisitor implements OrderVisitorInterface
{
    /**
     * @var CurrencyHelperInterface
     */
    private $orderNumberGenerator;
    
    /**
     * @var PaymentManagerInterface
     */
    private $paymentManager;
    
    /**
     * OrderConfirmationVisitor constructor.
     *
     * @param OrderNumberGeneratorInterface $orderNumberGenerator
     * @param PaymentManagerInterface       $paymentManager
     */
    public function __construct(OrderNumberGeneratorInterface $orderNumberGenerator, PaymentManagerInterface $paymentManager)
    {
        $this->orderNumberGenerator = $orderNumberGenerator;
        $this->paymentManager       = $paymentManager;
    }
    
    public function visitOrder(Order $order)
    {
        if ($order->isConfirmed()) {
            $this->setOrderNumber($order);
            $this->setInitialOrderStatus($order);
            $this->setInitialPayment($order);
            $this->lockProducts($order);
        }
    }
    
    private function setOrderNumber(Order $order)
    {
        if (null === $order->getNumber()) {
            $orderNumber = $this->orderNumberGenerator->generateOrderNumber($order);
            $order->setNumber($orderNumber);
        }
    }
    
    private function setInitialOrderStatus(Order $order)
    {
        if (!$order->hasCurrentStatus() && $order->hasPaymentMethod()) {
            $paymentMethod = $order->getPaymentMethod();
            $order->setCurrentStatus($paymentMethod->getPaymentPendingOrderStatus());
        }
    }
    
    private function setInitialPayment(Order $order)
    {
        $payments = $order->getPayments();
        if (0 === $payments->count() && $order->hasPaymentMethod()) {
            $payment = $this->paymentManager->createPaymentForOrder($order);
            $payments->add($payment);
        }
    }
    
    private function lockProducts(Order $order)
    {
        $order->getProducts()->map(function (OrderProduct $orderProduct) {
            if ($orderProduct->getProduct()->getTrackStock()) {
                $this->decrementStock($orderProduct);
            }
            
            $orderProduct->setLocked(true);
        });
    }
    
    private function decrementStock(OrderProduct $orderProduct)
    {
        if ($orderProduct->hasVariant()) {
            $currentStock = $orderProduct->getVariant()->getStock();
            $orderProduct->getVariant()->setStock($currentStock - $orderProduct->getQuantity());
        } else {
            $currentStock = $orderProduct->getProduct()->getStock();
            $orderProduct->getProduct()->setStock($currentStock - $orderProduct->getQuantity());
        }
    }
}
