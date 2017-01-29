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

namespace WellCommerce\Bundle\ContactBundle\Context\Front;

use WellCommerce\Bundle\ContactBundle\Entity\Contact;

/**
 * Class ContactContext
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ContactContext implements ContactContextInterface
{
    /**
     * @var Contact
     */
    protected $currentContact;
    
    /**
     * {@inheritdoc}
     */
    public function setCurrentContact(Contact $contact)
    {
        $this->currentContact = $contact;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCurrentContact(): Contact
    {
        return $this->currentContact;
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasCurrentContact(): bool
    {
        return $this->currentContact instanceof Contact;
    }
}
