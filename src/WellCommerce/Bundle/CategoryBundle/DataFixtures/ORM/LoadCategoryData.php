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

namespace WellCommerce\Bundle\CategoryBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use WellCommerce\Bundle\CategoryBundle\Entity\Category;
use WellCommerce\Bundle\CategoryBundle\Entity\CategoryTranslation;
use WellCommerce\Bundle\CoreBundle\DataFixtures\AbstractDataFixture;
use WellCommerce\Bundle\CoreBundle\Helper\Sluggable;
use WellCommerce\Bundle\LayoutBundle\Entity\LayoutBox;
use WellCommerce\Bundle\LayoutBundle\Entity\LayoutBoxTranslation;

/**
 * Class LoadCategoryData
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LoadCategoryData extends AbstractDataFixture implements FixtureInterface, OrderedFixtureInterface
{
    public static $samples
        = [
            'Smart TVs',
            'Streaming devices',
            'Accessories',
            'DVD & Blue-ray players',
            'Audio players',
            'Projectors',
            'Home theater',
        ];
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        if (!$this->isEnabled()) {
            return;
        }
        
        $this->addCategories($manager);
        
        $this->createLayoutBoxes($manager, [
            'category_menu'     => [
                'type' => 'CategoryMenu',
                'name' => 'Categories',
            ],
            'category_info'     => [
                'type' => 'CategoryInfo',
                'name' => 'Category',
            ],
            'category_products' => [
                'type'     => 'CategoryProducts',
                'name'     => 'Category products',
                'settings' => [
                    'per_page' => 10,
                ],
            ],
        ]);
        
        $manager->flush();
    }
    
    private function addCategories(ObjectManager $manager)
    {
        $shop      = $this->getReference('shop');
        $hierarchy = 0;
        
        foreach (self::$samples as $name) {
            $category = new Category();
            $category->setHierarchy($hierarchy++);
            $category->addShop($shop);
            foreach ($this->getLocales() as $locale) {
                /** @var CategoryTranslation $translation */
                $translation = $category->translate($locale->getCode());
                $translation->setName($name);
                $translation->setSlug($locale->getCode() . '/' . Sluggable::makeSlug($name));
            }
            $category->mergeNewTranslations();
            $manager->persist($category);
            $this->setReference('category_' . $name, $category);
        }
    }
}
