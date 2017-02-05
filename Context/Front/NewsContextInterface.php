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

namespace WellCommerce\Bundle\CmsBundle\Context\Front;

use WellCommerce\Bundle\CmsBundle\Entity\News;

/**
 * Interface NewsContextInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface NewsContextInterface
{
    public function setCurrentNews(News $news);
    
    public function getCurrentNews(): News;
    
    public function hasCurrentNews(): bool;
}
