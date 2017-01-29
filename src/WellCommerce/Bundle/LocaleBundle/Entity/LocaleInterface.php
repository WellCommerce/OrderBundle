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

namespace WellCommerce\Bundle\LocaleBundle\Entity;

use WellCommerce\Bundle\CurrencyBundle\Entity\CurrencyAwareInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;

/**
 * Interface LocaleInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface LocaleInterface extends EntityInterface, TimestampableInterface, BlameableInterface, CurrencyAwareInterface
{
    public function getCode(): string;
    
    public function setCode(string $code);
}
