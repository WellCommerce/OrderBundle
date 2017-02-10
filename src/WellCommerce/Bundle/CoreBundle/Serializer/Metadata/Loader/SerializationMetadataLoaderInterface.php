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

namespace WellCommerce\Bundle\CoreBundle\Serializer\Metadata\Loader;

/**
 * Interface SerializationMetadataLoaderInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface SerializationMetadataLoaderInterface
{
    const CACHE_FILENAME   = 'serialization.php';
    const MAPPING_FILENAME = 'serialization.yml';

    /**
     * @return \WellCommerce\Bundle\CoreBundle\Serializer\Metadata\Collection\SerializationMetadataCollection
     */
    public function loadMetadata();
}
