<?php

namespace Api\Output\Mapper\SeasonInfo;

class SimpleSeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'seasonYearBegin' => 'season_year_begin',
            'seasonYearEnd' => 'season_year_end',
            'raceType' => 'race_type'
        ];
    }
}
