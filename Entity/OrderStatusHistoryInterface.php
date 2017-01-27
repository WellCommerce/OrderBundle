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

namespace WellCommerce\Bundle\OrderBundle\Entity;

use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;

/**
 * Interface OrderStatusHistoryInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface OrderStatusHistoryInterface extends EntityInterface, OrderAwareInterface, TimestampableInterface, BlameableInterface
{
    public function getOrderStatus();

    public function setOrderStatus(OrderStatusInterface $orderStatus = null);

    public function getComment() : string;

    public function setComment(string $comment);

    public function isNotify() : bool;

    public function setNotify(bool $notify);
}
