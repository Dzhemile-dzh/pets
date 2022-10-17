<?php

namespace Api\Output\Mapper\Tipping\Success;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Main
 *
 * @package Api\Output\Mapper\Tipping\Success
 */
class Main extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'winning_tip' => 'winning_tip',
            'upcoming_tip' => 'upcoming_tip'
         ];
    }
}
