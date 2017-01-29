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

use WellCommerce\Bundle\DoctrineBundle\Repository\EntityRepository;
use WellCommerce\Bundle\OrderBundle\Entity\OrderStatus;

/**
 * Class OrderStatusRepository
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
class OrderStatusRepository extends EntityRepository implements OrderStatusRepositoryInterface
{
    public function getDataGridFilterOptions(): array
    {
        $options  = [];
        $statuses = $this->getCollection();
        $statuses->map(function (OrderStatus $status) use (&$options) {
            $options[] = [
                'id'          => $status->getId(),
                'name'        => $status->translate()->getName(),
                'hasChildren' => false,
                'parent'      => null,
                'weight'      => $status->getId(),
            ];
        });
        
        return $options;
    }
}
