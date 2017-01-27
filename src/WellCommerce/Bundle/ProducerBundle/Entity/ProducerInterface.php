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

namespace WellCommerce\Bundle\ProducerBundle\Entity;

use Doctrine\Common\Collections\Collection;
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TranslatableInterface;
use WellCommerce\Bundle\DelivererBundle\Entity\DelivererInterface;
use WellCommerce\Bundle\ShopBundle\Entity\ShopCollectionAwareInterface;

/**
 * Interface ProducerInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface ProducerInterface extends
    EntityInterface,
    TranslatableInterface,
    TimestampableInterface,
    BlameableInterface,
    ShopCollectionAwareInterface
{
    public function getProducts(): Collection;
    
    public function getDeliverers(): Collection;
    
    public function setDeliverers(Collection $collection);
    
    public function addDeliverer(DelivererInterface $deliverer);
}
