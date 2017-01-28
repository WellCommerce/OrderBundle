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

namespace WellCommerce\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use WellCommerce\Bundle\DoctrineBundle\DataFixtures\AbstractDataFixture;
use WellCommerce\Bundle\LayoutBundle\Entity\LayoutBox;
use WellCommerce\Bundle\LayoutBundle\Entity\LayoutBoxTranslation;
use WellCommerce\Bundle\ProductStatusBundle\Entity\ProductStatus;

/**
 * Class LoadSearchData
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LoadSearchData extends AbstractDataFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        if (!$this->isEnabled()) {
            return;
        }
        
        $this->createLayoutBoxes($manager, [
            'search' => [
                'type' => 'Search',
                'name' => 'Search results',
            ],
        ]);
        
        $manager->flush();
    }
}
