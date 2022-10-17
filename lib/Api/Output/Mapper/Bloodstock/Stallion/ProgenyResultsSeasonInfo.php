<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 12/24/2015
 * Time: 5:13 PM
 */

namespace Api\Output\Mapper\Bloodstock\Stallion;

class ProgenyResultsSeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(intval)seasonYearBegin' => 'season_year_begin',
            '(intval)seasonYearEnd' => 'season_year_end',
            '(dateISO8601)seasonDateBegin' => 'season_date_begin',
            '(dateISO8601)seasonDateEnd' => 'season_date_end',
            'raceType' => 'race_type',
            'countryCode' => 'country_code',
            'surface' => 'surface',
            '(intval)month' => 'month'
        ];
    }
}
