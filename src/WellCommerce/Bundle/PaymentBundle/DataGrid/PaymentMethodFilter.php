<?php

namespace WellCommerce\Bundle\PaymentBundle\DataGrid;

use WellCommerce\Bundle\DoctrineBundle\Repository\RepositoryInterface;
use WellCommerce\Bundle\PaymentBundle\Entity\PaymentMethod;

/**
 * Class PaymentMethodFilter
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class PaymentMethodFilter
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
