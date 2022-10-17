<?php

namespace Api\Output\Mapper\SeasonInfo;

class StallionHorsesSeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'raceType' => 'race_type',
            'seasonYearBegin' => 'season_year_begin',
            'seasonYearEnd' => 'season_year_end',
            'more_progeny_available' => 'more_progeny_available',
            '(returnInValidType)number' => 'number'
        ];
    }
}
