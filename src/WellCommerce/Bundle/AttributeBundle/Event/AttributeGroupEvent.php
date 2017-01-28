<?php
/**
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\AttributeBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use WellCommerce\Bundle\AttributeBundle\Entity\AttributeGroupInterface;

/**
 * Class AttributeGroupEvent
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class AttributeGroupEvent extends Event
{
    const POST_INIT_EVENT   = 'attribute_group.post_init';
    const PRE_UPDATE_EVENT  = 'attribute_group.pre_update';
    const POST_UPDATE_EVENT = 'attribute_group.post_update';
    const PRE_CREATE_EVENT  = 'attribute_group.pre_create';
    const POST_CREATE_EVENT = 'attribute_group.post_create';
    const PRE_REMOVE_EVENT  = 'attribute_group.pre_remove';
    const POST_REMOVE_EVENT = 'attribute_group.post_remove';
    
    private $attributeGroup;
    
    public function __construct(AttributeGroupInterface $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;
    }
    
    public function getAttributeGroup(): AttributeGroupInterface
    {
        return $this->attributeGroup;
    }
}