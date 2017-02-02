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

namespace WellCommerce\Bundle\ThemeBundle\Context\Front;

use WellCommerce\Bundle\ThemeBundle\Entity\Theme;

/**
 * Class ThemeContext
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ThemeContext implements ThemeContextInterface
{
    /**
     * @var Theme
     */
    protected $currentTheme;
    
    public function setCurrentTheme(Theme $theme)
    {
        $this->currentTheme = $theme;
    }
    
    public function getCurrentTheme(): Theme
    {
        return $this->currentTheme;
    }
    
    public function getCurrentThemeFolder(): string
    {
        return $this->currentTheme->getFolder();
    }
    
    public function hasCurrentTheme(): bool
    {
        return $this->currentTheme instanceof Theme;
    }
    
}
