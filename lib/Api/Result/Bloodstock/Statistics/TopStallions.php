<?php

namespace Api\Result\Bloodstock\Statistics;

use Api\Result\Json as Result;

/**
 * Class TopStallions
 *
 * @package Api\Result\Bloodstock\Statistics
 */
class TopStallions extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'top_stallions' => 'Api\Output\Mapper\Bloodstock\Statistics\TopStallions',
            'top_stallions.progeny_performers' => 'Api\Output\Mapper\Bloodstock\Statistics\SireProgenyPerformers',
        ];
    }
}
