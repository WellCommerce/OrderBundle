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

namespace WellCommerce\Bundle\OrderBundle\Repository;

use Doctrine\Common\Collections\Collection;
use WellCommerce\Bundle\DoctrineBundle\Repository\RepositoryInterface;

/**
 * Interface ShippingMethodRepositoryInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface ShippingMethodRepositoryInterface extends RepositoryInterface
{
    public function getShippingMethods(): Collection;
}