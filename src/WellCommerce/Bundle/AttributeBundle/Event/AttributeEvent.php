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
 * Class AttributeEvent
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class AttributeEvent extends Event
{
    const POST_INIT_EVENT   = 'attribute.post_init';
    const PRE_UPDATE_EVENT  = 'attribute.pre_update';
    const POST_UPDATE_EVENT = 'attribute.post_update';
    const PRE_CREATE_EVENT  = 'attribute.pre_create';
    const POST_CREATE_EVENT = 'attribute.post_create';
    const PRE_REMOVE_EVENT  = 'attribute.pre_remove';
    const POST_REMOVE_EVENT = 'attribute.post_remove';
    
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