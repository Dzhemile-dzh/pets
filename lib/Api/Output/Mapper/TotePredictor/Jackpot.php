<?php

namespace Api\Output\Mapper\TotePredictor;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Jackpot
 * @package Api\Output\Mapper\TotePredictor
 */
class Jackpot extends HorsesMapper
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
