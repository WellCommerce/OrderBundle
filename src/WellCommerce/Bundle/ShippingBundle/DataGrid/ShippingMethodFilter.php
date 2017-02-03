<?php

namespace WellCommerce\Bundle\ShippingBundle\DataGrid;

use WellCommerce\Bundle\DoctrineBundle\Repository\RepositoryInterface;
use WellCommerce\Bundle\ShippingBundle\Entity\ShippingMethod;

/**
 * Class ShippingMethodFilter
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class ShippingMethodFilter
{
    private $repository;
    
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function getOptions(): array
    {
        $options = [];
        $methods = $this->repository->getCollection();
        $methods->map(function (ShippingMethod $method) use (&$options) {
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
