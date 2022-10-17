<?php

namespace Api\Output\Mapper\SeasonInfo;

/**
 * Class StatisticalSummarySeasonInfo
 *
 * @package Api\Output\Mapper\SeasonInfo
 */
class StatisticalSummarySeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'raceType' => 'race_type',
            'countryCode' => 'country_code',
            '(dateISO8601)season_start_date' => 'season_start_date',
            '(dateISO8601)season_end_date' => 'season_end_date',
        ];
    }
}
