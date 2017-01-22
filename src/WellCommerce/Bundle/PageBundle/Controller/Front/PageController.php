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

namespace WellCommerce\Bundle\PageBundle\Controller\Front;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WellCommerce\Bundle\CoreBundle\Controller\Front\AbstractFrontController;
use WellCommerce\Bundle\PageBundle\Entity\PageInterface;
use WellCommerce\Component\Breadcrumb\Model\Breadcrumb;

/**
 * Class PageController
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class PageController extends AbstractFrontController
{
    /**
     * {@inheritdoc}
     */
    public function indexAction(PageInterface $page): Response
    {
        if (null !== $page->getParent()) {
            $this->getBreadcrumbProvider()->add(new Breadcrumb([
                'label' => $page->getParent()->translate()->getName(),
            ]));
        }
        
        $this->getBreadcrumbProvider()->add(new Breadcrumb([
            'label' => $page->translate()->getName(),
        ]));
        
        $this->getPageStorage()->setCurrentPage($page);
        
        return $this->displayTemplate('index', [
            'metadata' => $page->translate()->getMeta(),
        ]);
    }
}
