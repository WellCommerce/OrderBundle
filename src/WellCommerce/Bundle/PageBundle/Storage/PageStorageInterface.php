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

namespace WellCommerce\Bundle\PageBundle\Storage;

use WellCommerce\Bundle\PageBundle\Entity\Page;

/**
 * Interface PageStorageInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface PageStorageInterface
{
    public function setCurrentPage(Page $page);
    
    public function getCurrentPage(): Page;
    
    public function hasCurrentPage(): bool;
}
