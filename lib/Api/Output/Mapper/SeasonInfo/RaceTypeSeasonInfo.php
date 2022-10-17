<?php

namespace Api\Output\Mapper\SeasonInfo;

class RaceTypeSeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'raceType' => 'race_type'
        ];
    }
}
