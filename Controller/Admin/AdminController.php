<?php

namespace WellCommerce\Bundle\CoreBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use WellCommerce\Bundle\CoreBundle\Controller\ControllerInterface;

/**
 * Class AdminController
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class AdminController implements ControllerInterface
{
    protected $manager;
    protected $formBuilder;
    protected $dataGrid;
    
    public function indexAction(): Response
    {
        return $this->displayTemplate('index', [
            'datagrid' => $this->dataGrid,
        ]);
    }
}
