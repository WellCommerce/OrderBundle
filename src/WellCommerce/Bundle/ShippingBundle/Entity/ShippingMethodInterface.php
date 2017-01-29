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

namespace WellCommerce\Bundle\ShippingBundle\Entity;

use Doctrine\Common\Collections\Collection;
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TranslatableInterface;
use WellCommerce\Bundle\CurrencyBundle\Entity\CurrencyAwareInterface;
use WellCommerce\Bundle\ShopBundle\Entity\ShopCollectionAwareInterface;
use WellCommerce\Bundle\TaxBundle\Entity\TaxAwareInterface;

/**
 * Interface ShippingMethodInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface ShippingMethodInterface extends
    EntityInterface,
    TimestampableInterface,
    TranslatableInterface,
    BlameableInterface,
    TaxAwareInterface,
    ShopCollectionAwareInterface,
    CurrencyAwareInterface
{
    public function getCalculator(): string;
    
    public function setCalculator(string $calculator);
    
    public function getOptionsProvider(): string;
    
    public function setOptionsProvider(string $optionsProvider);
    
    public function getCosts(): Collection;
    
    public function setCosts(Collection $costs);
    
    public function getPaymentMethods(): Collection;
    
    public function getCountries(): array;
    
    public function setCountries(array $countries);
}
