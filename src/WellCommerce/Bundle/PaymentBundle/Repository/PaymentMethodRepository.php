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
namespace WellCommerce\Bundle\PaymentBundle\Repository;

use WellCommerce\Bundle\DoctrineBundle\Repository\EntityRepository;
use WellCommerce\Bundle\PaymentBundle\Entity\PaymentMethod;

/**
 * Class PaymentMethodRepository
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class PaymentMethodRepository extends EntityRepository implements PaymentMethodRepositoryInterface
{
    public function getDefaultPaymentMethod(): PaymentMethod
    {
        return $this->findOneBy([], ['hierarchy' => 'asc']);
    }
    
    public function getDataGridFilterOptions(): array
    {
        $options = [];
        $methods = $this->getCollection();
        $methods->map(function (PaymentMethod $method) use (&$options) {
            $options[] = [
                'id'          => $method->getId(),
                'name'        => $method->translate()->getName(),
                'hasChildren' => false,
                'parent'      => null,
                'weight'      => $method->getId(),
            ];
        });
        
        return $options;
    }
}
