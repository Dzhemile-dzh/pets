<?php

namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

/**
 * Class KeyStats
 *
 * @package Api\Result\RaceCards
 */
class KeyStats extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'key_stats' => '\Api\Output\Mapper\RaceCards\KeyStats',
        ];
    }
}
