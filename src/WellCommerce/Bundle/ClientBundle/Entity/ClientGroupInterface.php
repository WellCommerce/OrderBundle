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
use WellCommerce\Bundle\DoctrineBundle\Entity\BlameableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TimestampableInterface;
use WellCommerce\Bundle\DoctrineBundle\Entity\TranslatableInterface;
use WellCommerce\Bundle\PageBundle\Entity\Page;

/**
 * Interface ClientGroupInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface ClientGroupInterface extends EntityInterface, TranslatableInterface, TimestampableInterface, BlameableInterface
{
    public function getDiscount(): float;
    
    public function setDiscount(float $discount);
    
    public function setClients(Collection $clients);
    
    public function getClients(): Collection;
    
    public function addClient(ClientInterface $client);
    
    public function getPages(): Collection;
    
    public function setPages(Collection $pages);
    
    public function addPage(Page $page);
}
