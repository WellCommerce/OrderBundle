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

namespace WellCommerce\Bundle\ClientBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\ShopBundle\Entity\ShopAwareInterface;

/**
 * Interface ClientInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface ClientInterface extends
    EntityInterface,
    \Serializable,
    BaseUserInterface,
    EquatableInterface,
    TimestampableInterface,
    BlameableInterface,
    ShopAwareInterface,
    EncoderAwareInterface
{
    public function getOrders(): Collection;
    
    public function getClientDetails(): ClientDetails;
    
    public function setClientDetails(ClientDetails $clientDetails);
    
    public function getContactDetails(): ClientContactDetails;
    
    public function setContactDetails(ClientContactDetails $contactDetails);
    
    public function getBillingAddress(): ClientBillingAddress;
    
    public function setBillingAddress(ClientBillingAddress $billingAddress);
    
    public function getShippingAddress(): ClientShippingAddress;
    
    public function setShippingAddress(ClientShippingAddress $shippingAddress);
}
