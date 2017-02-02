<?php

namespace WellCommerce\Bundle\ApiBundle\Resolver;

use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class MappingFileResolver
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class MappingFileResolver
{
    /**
     * @var KernelInterface
     */
    private $kernel;
    
    /**
     * BundleConfigPathResolver constructor.
     *
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
    
    public function resolvePath(string $path): string
    {
        $resourcePathExploded = explode('/', $path);
        $resourcePathRoot     = array_shift($resourcePathExploded);
        
        if (strpos($resourcePathRoot, '@') === 0) {
            $mappingFileBundle = ltrim($resourcePathRoot, '@');
            $bundle            = $this->kernel->getBundle($mappingFileBundle);
            
            if ($bundle instanceof BundleInterface) {
                $resourcePathRoot = $bundle->getPath();
            }
        }
        
        array_unshift($resourcePathExploded, $resourcePathRoot);
        
        return implode('/', $resourcePathExploded);
    }
}
