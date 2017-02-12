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

namespace WellCommerce\Bundle\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use WellCommerce\Bundle\AppBundle\DataGrid\ClientGroupDataGrid;
use WellCommerce\Bundle\AppBundle\Form\Admin\ClientGroupFormBuilder;
use WellCommerce\Bundle\AppBundle\Manager\ClientGroupManager;
use WellCommerce\Bundle\CoreBundle\Controller\ControllerInterface;

/**
 * Class ClientGroupController
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ClientGroupController implements ControllerInterface
{
    private $manager;
    private $formBuilder;
    private $dataGrid;
    
    public function __construct(ClientGroupManager $manager, ClientGroupFormBuilder $formBuilder, ClientGroupDataGrid $dataGrid)
    {
        $this->manager     = $manager;
        $this->formBuilder = $formBuilder;
        $this->dataGrid    = $dataGrid;
    }
    
    public function indexAction(): Response
    {
        return $this->displayTemplate('index', [
            'datagrid' => $this->dataGrid,
        ]);
    }
    
    public function addAction(): Response
    {
        $resource = $this->manager->initResource();
        $form     = $this->formBuilder->createForm(['name' => 'client_group'], $resource);
        
        if ($form->handleRequest()->isSubmitted()) {
            if ($form->isValid()) {
                $this->getManager()->createResource($resource);
            }
            
            return $this->createFormDefaultJsonResponse($form);
        }
        
        return $this->displayTemplate('add', [
            'form' => $form,
        ]);
    }
}
