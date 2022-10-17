<?php

namespace Api\Result\Bloodstock\Stallion;

class ProgenyEntries extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_entries' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyEntries',
            'season_info' => 'Api\Output\Mapper\SeasonInfo\RaceTypeSeasonInfo'
        ];
    }
}
