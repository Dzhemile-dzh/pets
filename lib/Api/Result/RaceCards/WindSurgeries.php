<?php

namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

/**
 * Class WindSurgeries
 *
 * @package Api\Result\RaceCards
 */
class WindSurgeries extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'wind_surgeries' => 'Api\Output\Mapper\RaceCards\WindSurgeries',
        ];
    }
}
