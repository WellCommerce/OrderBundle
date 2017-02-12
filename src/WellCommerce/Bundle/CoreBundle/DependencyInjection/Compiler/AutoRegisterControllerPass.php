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

namespace WellCommerce\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use WellCommerce\Bundle\AppBundle\Controller\Admin\ClientGroupController;
use WellCommerce\Bundle\CoreBundle\DependencyInjection\Definition\AdminControllerDefinitionFactory;

/**
 * Class AutoRegisterControllerPass
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class AutoRegisterControllerPass extends AbstractAutoRegisterPass
{
    public function process(ContainerBuilder $container)
    {
        $definitionFactory = new AdminControllerDefinitionFactory();
        $classes           = $this->classFinder->findAdminControllerClasses($this->bundle);
        
        foreach ($classes as $baseName => $className) {
            $controllerServiceId = $this->serviceIdGenerator->getServiceId($baseName, 'controller.admin');
            if ($controllerServiceId === 'client_group.controller.admin') {
                $definition = new Definition(ClientGroupController::class);
                $definition->setAutowired(true);
                $container->setDefinition('client_group.controller.admin', $definition);
            } else {
                if (false === $container->has($controllerServiceId)) {
                    $managerServiceId     = $this->serviceIdGenerator->getServiceId($baseName, 'manager');
                    $formBuilderServiceId = $this->serviceIdGenerator->getServiceId($baseName, 'form_builder.admin');
                    $dataGridServiceId    = $this->serviceIdGenerator->getServiceId($baseName, 'datagrid');
                    $dataSetServiceId     = $this->serviceIdGenerator->getServiceId($baseName, 'dataset.admin');
                    $manager              = $container->has($managerServiceId) ? new Reference($managerServiceId) : null;
                    $formBuilder          = $container->has($formBuilderServiceId) ? new Reference($formBuilderServiceId) : null;
                    $dataGrid             = $container->has($dataGridServiceId) ? new Reference($dataGridServiceId) : null;
                    $dataSet              = $container->has($dataSetServiceId) ? new Reference($dataSetServiceId) : null;
                    $definition           = $definitionFactory->create($className, $manager, $formBuilder, $dataGrid, $dataSet);
                    $container->setDefinition($controllerServiceId, $definition);
                }
            }
            
        }
    }
}
