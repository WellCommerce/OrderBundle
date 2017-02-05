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

namespace WellCommerce\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class WellCommerceCoreExtension
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class WellCommerceCoreExtension extends AbstractExtension
{
    /**
     * @var array
     */
    private $routingDiscriminatorMap;
    
    /**
     * @var array
     */
    private $routingGeneratorMap = [];
    
    protected function processExtensionConfiguration(array $configuration, ContainerBuilder $container)
    {
        parent::processExtensionConfiguration($configuration, $container);
        
        foreach ($configuration['dynamic_routing'] as $discriminatorName => $options) {
            $this->routingDiscriminatorMap[$discriminatorName] = $options['entity'];
            $this->routingGeneratorMap[$options['entity']]     = $options;
        }
        
        $router = $container->getDefinition('routing.chain_router');
        foreach ($configuration['routers'] as $id => $priority) {
            $router->addMethodCall('add', [new Reference($id), (int)$priority]);
        }
        
        $container->setAlias('router', 'routing.chain_router');
        $container->setParameter('routing_discriminator_map', $this->routingDiscriminatorMap);
        $container->setParameter('routing_generator_map', $this->routingGeneratorMap);
        
        $requestHandlers      = $configuration['request_handler'];
        $serializationMapping = $configuration['serialization'];
        
        foreach ($requestHandlers as $rootName => $options) {
            $this->registerRequestHandler($rootName, $options, $container);
        }
        
        $container->setParameter('api.serialization_mapping_map', $serializationMapping);
    }
    
    private function registerRequestHandler(string $name, array $options, ContainerBuilder $container)
    {
        if (true === $options['enabled']) {
            $definition = new Definition($options['class']);
            $definition->addArgument($name);
            $definition->addArgument(new Reference($options['manager']));
            $definition->addArgument(new Reference('serializer'));
            $definition->addTag('api.request_handler');
            $container->setDefinition($name . '.api.request_handler', $definition);
        }
    }
}
