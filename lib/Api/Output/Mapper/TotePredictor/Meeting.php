<?php

namespace Api\Output\Mapper\TotePredictor;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Meeting
 *
 * @package Api\Output\Mapper\TotePredictor
 */
class Meeting extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'races' => 'races',
        ];
    }
}
