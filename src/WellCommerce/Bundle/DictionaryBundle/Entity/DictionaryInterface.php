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

namespace WellCommerce\Bundle\DictionaryBundle\Entity;

use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TranslatableInterface;

/**
 * Interface DictionaryInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface DictionaryInterface extends EntityInterface, TranslatableInterface, TimestampableInterface, BlameableInterface
{
    public function getIdentifier() : string;
    
    public function setIdentifier(string $identifier);
}
