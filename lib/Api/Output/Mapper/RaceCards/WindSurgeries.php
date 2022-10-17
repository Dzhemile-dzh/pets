<?php

namespace Api\Output\Mapper\RaceCards;

use Api\Output\Mapper;

/**
 * Class WindSurgeries
 *
 * @package Api\Output\Mapper\RaceCards
 */
class WindSurgeries extends Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(dbYNFlagToBoolean)is_wind_surgery_first_time' => 'wind_surgery_first_time',
            '(dbYNFlagToBoolean)is_wind_surgery_second_time' => 'wind_surgery_second_time',
        ];
    }
}
