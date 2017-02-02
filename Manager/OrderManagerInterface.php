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

namespace WellCommerce\Bundle\OrderBundle\Manager;

use WellCommerce\Bundle\ClientBundle\Entity\Client;
use WellCommerce\Bundle\CoreBundle\Manager\ManagerInterface;
use WellCommerce\Bundle\OrderBundle\Entity\Order;
use WellCommerce\Bundle\ShopBundle\Entity\ShopInterface;

/**
 * Interface OrderManagerInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface OrderManagerInterface extends ManagerInterface
{
    public function getOrder(string $sessionId, Client $client = null, ShopInterface $shop, string $currency): Order;
    
    public function findOrder(string $sessionId, Client $client = null, ShopInterface $shop);
}
