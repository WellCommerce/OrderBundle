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

namespace WellCommerce\Bundle\AppBundle\Visitor;

use WellCommerce\Bundle\AppBundle\Converter\CurrencyConverterInterface;
use WellCommerce\Bundle\OrderBundle\Entity\Order;
use WellCommerce\Bundle\OrderBundle\Visitor\OrderVisitorInterface;

/**
 * Class ShippingMethodCartVisitor
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class CurrencyOrderVisitor implements OrderVisitorInterface
{
    /**
     * @var CurrencyConverterInterface
     */
    private $currencyConverter;
    
    public function __construct(CurrencyConverterInterface $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }
    
    public function visitOrder(Order $order)
    {
        $currency     = $order->getCurrency();
        $currencyRate = $this->currencyConverter->getExchangeRate($currency);
        $order->setCurrencyRate($currencyRate);
    }
}
