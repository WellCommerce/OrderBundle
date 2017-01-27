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

namespace WellCommerce\Bundle\NewsBundle\Entity;

use DateTime;
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TranslatableInterface;
use WellCommerce\Bundle\ShopBundle\Entity\ShopCollectionAwareInterface;

/**
 * Interface NewsInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface NewsInterface extends EntityInterface, TimestampableInterface, TranslatableInterface, BlameableInterface, ShopCollectionAwareInterface
{
    public function getPublish(): bool;
    
    public function setPublish(bool $publish);
    
    public function getStartDate(): DateTime;
    
    public function setStartDate(DateTime $startDate);
    
    public function getEndDate(): DateTime;
    
    public function setEndDate(DateTime $endDate);
    
    public function getFeatured(): bool;
    
    public function setFeatured($featured);
}
