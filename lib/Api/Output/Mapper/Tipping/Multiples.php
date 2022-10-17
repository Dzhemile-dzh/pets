<?php

namespace Api\Output\Mapper\Tipping;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Multiples
 *
 * @package Api\Output\Mapper\Tipping\Multiples
 */
class Multiples extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'tipping_headline' => 'tipping_headline',
            'tips' => 'tips'
         ];
    }
}
