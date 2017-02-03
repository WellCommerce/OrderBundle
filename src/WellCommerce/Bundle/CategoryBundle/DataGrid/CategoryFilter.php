<?php

namespace WellCommerce\Bundle\CategoryBundle\DataGrid;

use Doctrine\Common\Collections\Criteria;
use WellCommerce\Bundle\CategoryBundle\Entity\Category;
use WellCommerce\Bundle\CategoryBundle\Repository\CategoryRepository;

/**
 * Class CategoryFilter
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class CategoryFilter
{
    private $repository;
    
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function getOptions(Category $parent = null): array
    {
        $options  = [];
        $criteria = new Criteria();
        $criteria->where($criteria->expr()->eq('parent', $parent));
        $categories = $this->repository->matching($criteria);
        $categories->map(function (Category $category) use (&$options) {
            $parentCategory = $category->getParent();
            $options[]      = [
                'id'          => $category->getId(),
                'name'        => $category->translate()->getName(),
                'hasChildren' => (bool)$category->getChildren()->count() > 0,
                'parent'      => ($parentCategory instanceof Category) ? $parentCategory->getId() : null,
                'weight'      => $category->getHierarchy(),
            ];
        });
        
        return $options;
    }
}
