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
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Identifiable;

/**
 * Class VariantOption
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class VariantOption implements VariantOptionInterface
{
    use Identifiable;
    
    /**
     * @var Variant
     */
    protected $variant;
    
    /**
     * @var Attribute
     */
    protected $attribute;
    
    /**
     * @var AttributeValue
     */
    protected $attributeValue;
    
    public function getVariant(): VariantInterface
    {
        return $this->variant;
    }
    
    public function setVariant(VariantInterface $variant)
    {
        $this->variant = $variant;
    }
    
    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }
    
    public function setAttribute(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
    
    public function getAttributeValue(): AttributeValue
    {
        return $this->attributeValue;
    }
    
    public function setAttributeValue(AttributeValue $attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }
}
