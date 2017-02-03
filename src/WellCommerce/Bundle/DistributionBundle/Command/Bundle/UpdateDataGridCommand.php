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

namespace WellCommerce\Bundle\DistributionBundle\Command\Bundle;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class UpdateDataGridCommand
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
final class UpdateDataGridCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setDescription('Generates the bundle skeleton');
        $this->setName('update:datagrid');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rootDir    = $this->getContainer()->get('kernel')->getRootDir() . '/../src/WellCommerce';
        $filesystem = new Filesystem();
        $finder     = new Finder();
        $finder->in($rootDir)->name('*DataGrid.php');
        foreach ($finder->files() as $file) {
            $contents    = $file->getContents();
            $pattern     = '/\$this->trans\((\'\w+\.\w+\.\w+\')\)/';
            $replacement = '${1}';
            $contents    = preg_replace($pattern, $replacement, $contents);
            $filesystem->dumpFile($file->getRealPath(), $contents);
        }
    }
}
