<?php
namespace Api\Output\Mapper\Bloodstock\Dam;

use Api\Output\Mapper;

class ProgenyResultsSeasons extends Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'season_type' => 'season_type',
            '(dateISO8601)season_start_date' => 'season_start_date',
            '(dateISO8601)season_end_date' => 'season_end_date',
            'season_desc' => 'season_desc',
        ];
    }
}
