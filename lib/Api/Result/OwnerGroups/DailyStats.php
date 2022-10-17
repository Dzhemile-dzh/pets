<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * Class HorseList
 *
 * @package Api\Result\OwnerGroups
 */
class DailyStats extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'daily_stats' => 'Api\Output\Mapper\OwnerGroups\DailyStats'
        ];
    }
}
