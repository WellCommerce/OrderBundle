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

namespace WellCommerce\Bundle\CategoryBundle\Entity;

use Doctrine\Common\Collections\Collection;
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TranslatableInterface;
use WellCommerce\Bundle\ShopBundle\Entity\ShopCollectionAwareInterface;

/**
 * Interface CategoryInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface CategoryInterface extends
    EntityInterface,
    TranslatableInterface,
    TimestampableInterface,
    BlameableInterface,
    ShopCollectionAwareInterface
{
    public function getSymbol(): string;
    
    public function setSymbol(string $symbol);
    
    public function getParent();

    public function setParent(CategoryInterface $parent = null);

    public function setChildren(Collection $children);

    public function getChildren() : Collection;

    public function addChild(CategoryInterface $child);

    public function getProducts() : Collection;

    public function setProducts(Collection $products);

    public function getProductsCount() : int;

    public function setProductsCount(int $productsCount);

    public function getChildrenCount() : int;

    public function setChildrenCount(int $childrenCount);
}
