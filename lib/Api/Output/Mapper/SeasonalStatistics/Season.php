<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\SeasonalStatistics;

class Season extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'season_uid' => 'season_uid',
            '(dateISO8601)season_start_date' => 'season_start_date',
            '(dateISO8601)season_end_date' => 'season_end_date',
            'season_type_code' => 'season_type_code',
            'season_race_type' => 'season_race_type',
            'season_country_code' => 'season_country_code',
            'season_desc' => 'season_desc'
        ];
    }
}
