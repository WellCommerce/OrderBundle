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
use Symfony\Component\DependencyInjection\Reference;
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
            
            if (false === $container->has($controllerServiceId)) {
                $manager     = $this->getManager($baseName, $container);
                $formBuilder = $this->getFormBuilder($baseName, $container);
                $dataGrid    = $this->getDataGrid($baseName, $container);
                $dataSet     = $this->getDataSet($baseName, $container);
                $definition  = $definitionFactory->create($className, $manager, $formBuilder, $dataGrid, $dataSet);
                $container->setDefinition($controllerServiceId, $definition);
            }
        }
    }
    
    private function getManager(string $baseName, ContainerBuilder $container)
    {
        $managerServiceId = $this->serviceIdGenerator->getServiceId($baseName, 'manager');
        
        return $container->has($managerServiceId) ? new Reference($managerServiceId) : null;
    }
    
    private function getFormBuilder(string $baseName, ContainerBuilder $container)
    {
        $managerServiceId = $this->serviceIdGenerator->getServiceId($baseName, 'form_builder.admin');
        
        return $container->has($managerServiceId) ? new Reference($managerServiceId) : null;
    }
    
    private function getDataGrid(string $baseName, ContainerBuilder $container)
    {
        $managerServiceId = $this->serviceIdGenerator->getServiceId($baseName, 'datagrid');
        
        return $container->has($managerServiceId) ? new Reference($managerServiceId) : null;
    }
    
    private function getDataSet(string $baseName, ContainerBuilder $container)
    {
        $managerServiceId = $this->serviceIdGenerator->getServiceId($baseName, 'dataset.admin');
        
        return $container->has($managerServiceId) ? new Reference($managerServiceId) : null;
    }
}
