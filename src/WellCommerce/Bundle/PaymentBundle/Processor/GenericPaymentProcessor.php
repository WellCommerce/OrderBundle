<?php

namespace WellCommerce\Bundle\PaymentBundle\Processor;

use WellCommerce\Bundle\PaymentBundle\Configurator\PaymentMethodConfiguratorInterface;
use WellCommerce\Bundle\PaymentBundle\Gateway\PaymentGatewayInterface;

/**
 * Class GenericPaymentProcessor
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class GenericPaymentProcessor implements PaymentProcessorInterface
{
    /**
     * @var PaymentGatewayInterface
     */
    protected $gateway;
    
    /**
     * @var PaymentMethodConfiguratorInterface
     */
    protected $configurator;
    
    /**
     * GenericPaymentProcessor constructor.
     *
     * @param PaymentGatewayInterface            $gateway
     * @param PaymentMethodConfiguratorInterface $configurator
     */
    public function __construct(PaymentGatewayInterface $gateway, PaymentMethodConfiguratorInterface $configurator)
    {
        $this->gateway      = $gateway;
        $this->configurator = $configurator;
    }
    
    public function getGateway(): PaymentGatewayInterface
    {
        return $this->gateway;
    }
    
    public function getConfigurator(): PaymentMethodConfiguratorInterface
    {
        return $this->configurator;
    }
}
