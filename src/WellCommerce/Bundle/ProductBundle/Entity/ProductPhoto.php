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

use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Identifiable;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Sortable;
use WellCommerce\Bundle\DoctrineBundle\Entity\EntityInterface;
use WellCommerce\Bundle\MediaBundle\Entity\Media;

/**
 * Class Photo
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ProductPhoto implements EntityInterface
{
    use Identifiable;
    use Sortable;
    use Timestampable;
    use ProductAwareTrait;
    
    /**
     * @var bool
     */
    protected $mainPhoto = false;
    
    /**
     * @var Media
     */
    protected $photo;
    
    public function getPhoto(): Media
    {
        return $this->photo;
    }
    
    public function setPhoto(Media $photo)
    {
        $this->photo = $photo;
    }
    
    public function isMainPhoto(): bool
    {
        return $this->mainPhoto;
    }
    
    public function setMainPhoto(bool $mainPhoto)
    {
        $this->mainPhoto = $mainPhoto;
    }
}
