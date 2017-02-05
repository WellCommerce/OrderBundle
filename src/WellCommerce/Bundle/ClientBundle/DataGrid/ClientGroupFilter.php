<?php

namespace WellCommerce\Bundle\ClientBundle\DataGrid;

use WellCommerce\Bundle\ClientBundle\Entity\ClientGroup;
use WellCommerce\Bundle\CoreBundle\Repository\RepositoryInterface;

/**
 * Class ClientGroupFilter
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class ClientGroupFilter
{
    private $repository;
    
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function getOptions(): array
    {
        $options = [];
        $groups  = $this->repository->getCollection();
        $groups->map(function (ClientGroup $group) use (&$options) {
            $options[] = [
                'id'          => $group->getId(),
                'name'        => $group->translate()->getName(),
                'hasChildren' => false,
                'parent'      => null,
                'weight'      => $group->getId(),
            ];
        });
        
        return $options;
    }
}
