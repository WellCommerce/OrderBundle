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
namespace WellCommerce\Bundle\CoreBundle\Controller\Front;

use WellCommerce\Bundle\CatalogBundle\Storage\CategoryStorageInterface;
use WellCommerce\Bundle\ClientBundle\Entity\Client;
use WellCommerce\Bundle\CoreBundle\Controller\AbstractController;
use WellCommerce\Bundle\OrderBundle\Provider\Front\OrderProviderInterface;
use WellCommerce\Bundle\CatalogBundle\Storage\ProducerStorageInterface;
use WellCommerce\Bundle\ProductBundle\Storage\ProductStorageInterface;
use WellCommerce\Bundle\ProductStatusBundle\Storage\ProductStatusStorageInterface;

/**
 * Class AbstractFrontController
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractFrontController extends AbstractController implements FrontControllerInterface
{
    protected function getCategoryStorage(): CategoryStorageInterface
    {
        return $this->get('category.storage');
    }
    
    protected function getProductStorage(): ProductStorageInterface
    {
        return $this->get('product.storage');
    }
    
    protected function getProductStatusStorage(): ProductStatusStorageInterface
    {
        return $this->get('product_status.storage');
    }
    
    protected function getProducerStorage(): ProducerStorageInterface
    {
        return $this->get('producer.storage');
    }
    
    protected function getOrderProvider(): OrderProviderInterface
    {
        return $this->get('order.provider.front');
    }
    
    protected function getAuthenticatedClient(): Client
    {
        return $this->getSecurityHelper()->getAuthenticatedClient();
    }
}
