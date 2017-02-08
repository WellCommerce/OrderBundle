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
namespace WellCommerce\Bundle\CoreBundle\Helper;

/**
 * Class Helper
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class Helper
{
    /**
     * Replaces commas with dots
     *
     * @param $value
     *
     * @return string
     */
    public static function changeCommaToDot($value)
    {
        return str_replace(',', '.', $value);
    }
    
    /**
     * Converts string to snake-case
     *
     * @param string $value
     * @param string $delimiter
     *
     * @return string
     */
    public static function snake($value, $delimiter = '_')
    {
        $replace = '$1' . $delimiter . '$2';
        
        return ctype_lower($value) ? $value : strtolower(preg_replace('/(.)([A-Z])/', $replace, $value));
    }
}
