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

namespace WellCommerce\Bundle\ProductBundle\Entity;

use WellCommerce\Bundle\AttributeBundle\Entity\Attribute;
use WellCommerce\Bundle\AttributeBundle\Entity\AttributeValue;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;

/**
 * Interface VariantOptionInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface VariantOptionInterface extends EntityInterface
{
    public function getVariant(): VariantInterface;
    
    public function setVariant(VariantInterface $variant);
    
    public function getAttribute(): Attribute;
    
    public function setAttribute(Attribute $attribute);
    
    public function getAttributeValue(): AttributeValue;
    
    public function setAttributeValue(AttributeValue $attributeValue);
}
