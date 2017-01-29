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

namespace WellCommerce\Bundle\PaymentBundle\Manager;

use WellCommerce\Bundle\CoreBundle\Manager\AbstractManager;
use WellCommerce\Bundle\OrderBundle\Entity\OrderInterface;
use WellCommerce\Bundle\OrderBundle\Entity\OrderStatusHistory;
use WellCommerce\Bundle\OrderBundle\Entity\OrderStatusInterface;
use WellCommerce\Bundle\PaymentBundle\Entity\Payment;
use WellCommerce\Bundle\PaymentBundle\Processor\PaymentProcessorInterface;

/**
 * Class PaymentManager
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
final class PaymentManager extends AbstractManager implements PaymentManagerInterface
{
    public function updatePaymentState(Payment $payment)
    {
        $this->updateResource($payment);
        $this->changeOrderStatus($payment);
    }
    
    public function getPaymentProcessor(OrderInterface $order): PaymentProcessorInterface
    {
        $name = $order->getPaymentMethod()->getProcessor();
        
        return $this->get('payment.processor.collection')->get($name);
    }
    
    public function createPaymentForOrder(OrderInterface $order): Payment
    {
        $processor = $order->getPaymentMethod()->getProcessor();
        
        /** @var Payment $payment */
        $payment = $this->initResource();
        $payment->setOrder($order);
        $payment->setProcessor($processor);
        $this->createResource($payment, false);
        
        return $payment;
    }
    
    private function changeOrderStatus(Payment $payment)
    {
        $order         = $payment->getOrder();
        $paymentMethod = $order->getPaymentMethod();
        $status        = $this->getOrderStatus($payment);
        
        $history = $this->initOrderStatusHistory();
        $history->setComment(sprintf('%s.label.%s', $paymentMethod->getProcessor(), $payment->getState()));
        $history->setNotify(false);
        $history->setOrder($order);
        $history->setOrderStatus($status);
        $this->createResource($history);
    }
    
    private function getOrderStatus(Payment $payment): OrderStatusInterface
    {
        $order         = $payment->getOrder();
        $paymentMethod = $order->getPaymentMethod();
        
        if ($payment->isCreated() || $payment->isPending() || $payment->isInProgress()) {
            return $paymentMethod->getPaymentPendingOrderStatus();
        }
        
        if ($payment->isCancelled() || $payment->isFailed()) {
            return $paymentMethod->getPaymentFailureOrderStatus();
        }
        
        return $paymentMethod->getPaymentSuccessOrderStatus();
    }
    
    private function initOrderStatusHistory(): OrderStatusHistory
    {
        return $this->get('order_status_history.factory')->create();
    }
}
