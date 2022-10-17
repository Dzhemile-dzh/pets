<?php

declare(strict_types=1);

namespace Api\Result\Races;

use Api\Result\Json as Result;

/**
 * Class OneTwoThreeRaceId
 * @package Api\Result\Races
 */
class OneTwoThreeRaceId extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'runners'       => 'Api\Output\Mapper\Races\Runners'
        ];
    }
}
