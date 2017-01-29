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

namespace WellCommerce\Bundle\LocaleBundle\Entity;

use Knp\DoctrineBehaviors\Model\Blameable\Blameable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use WellCommerce\Bundle\CurrencyBundle\Entity\CurrencyAwareTrait;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Enableable;
use WellCommerce\Bundle\DoctrineBundle\Behaviours\Identifiable;

/**
 * Class Locale
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class Locale implements LocaleInterface
{
    use Identifiable;
    use Enableable;
    use Timestampable;
    use Blameable;
    use CurrencyAwareTrait;
    
    protected $code = '';
    
    public function getCode(): string
    {
        return $this->code;
    }
    
    public function setCode(string $code)
    {
        $this->code = $code;
    }
}
