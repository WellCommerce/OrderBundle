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

namespace WellCommerce\Bundle\AppBundle\Renderer;

use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use WellCommerce\Bundle\AppBundle\Collection\LayoutBoxSettingsCollection;
use WellCommerce\Bundle\AppBundle\Configurator\LayoutBoxConfiguratorCollection;
use WellCommerce\Bundle\AppBundle\Entity\LayoutBox;
use WellCommerce\Bundle\AppBundle\Exception\LayoutBoxNotFoundException;
use WellCommerce\Bundle\CoreBundle\Controller\ControllerInterface;
use WellCommerce\Bundle\CoreBundle\DependencyInjection\AbstractContainerAware;
use WellCommerce\Bundle\DoctrineBundle\Manager\ManagerInterface;

/**
 * Class LayoutBoxRenderer
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class LayoutBoxRenderer extends AbstractContainerAware implements LayoutBoxRendererInterface
{
    /**
     * @var ManagerInterface
     */
    private $manager;
    
    /**
     * @var LayoutBoxConfiguratorCollection
     */
    private $configurators;
    
    public function __construct(LayoutBoxConfiguratorCollection $configurators, ManagerInterface $manager)
    {
        $this->manager       = $manager;
        $this->configurators = $configurators;
    }
    
    public function render(string $identifier, array $params): string
    {
        $content = $this->getLayoutBoxContent($identifier, $params);
        
        return $content->getContent();
    }
    
    private function findLayoutBox($identifier): LayoutBox
    {
        $layoutBox = $this->manager->getRepository()->findOneBy(['identifier' => $identifier]);
        
        if (!$layoutBox instanceof LayoutBox) {
            throw new LayoutBoxNotFoundException($identifier);
        }
        
        return $layoutBox;
    }
    
    private function getLayoutBoxContent(string $identifier, array $params = []): Response
    {
        $layoutBox  = $this->findLayoutBox($identifier);
        $controller = $this->resolveControllerService($layoutBox);
        $action     = $this->resolveControllerAction($controller);
        $settings   = $this->makeSettingsCollection($layoutBox, $params);
        
        return call_user_func_array([$controller, $action], [$settings]);
    }
    
    private function makeSettingsCollection(LayoutBox $box, array $params = []): LayoutBoxSettingsCollection
    {
        $defaultSettings = $box->getSettings();
        $settings        = array_merge($defaultSettings, $params);
        $collection      = new LayoutBoxSettingsCollection();
        
        foreach ($settings as $name => $value) {
            $collection->add($name, $value);
        }
        
        $collection->add('name', $box->translate()->getName());
        $collection->add('content', $box->translate()->getContent());
        
        return $collection;
    }
    
    private function resolveControllerService(LayoutBox $layoutBox): ControllerInterface
    {
        $boxType      = $layoutBox->getBoxType();
        $configurator = $this->configurators->get($boxType);
        $service      = $configurator->getControllerService();
        
        if (!$this->has($service)) {
            throw new ServiceNotFoundException($service);
        }
        
        return $this->get($service);
    }
    
    private function resolveControllerAction(ControllerInterface $controller): string
    {
        $currentAction = $this->getRouterHelper()->getCurrentAction();
        
        if ($this->getRouterHelper()->hasControllerAction($controller, $currentAction)) {
            return $currentAction;
        }
        
        return 'indexAction';
    }
}
