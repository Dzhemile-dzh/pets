<?php

namespace Api\Result\Meetings\WeatherConditions;

use Api\Result\Json as Result;

/**
 * Class WeatherConditions
 *
 * @package Api\Result\Meetings\WeatherConditions
 */
class WeatherConditions extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'meetings' => 'Api\Output\Mapper\Meetings\WeatherConditions',
        ];
    }
}
