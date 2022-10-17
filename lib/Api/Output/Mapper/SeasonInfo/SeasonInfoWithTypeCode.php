<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 12/24/2015
 * Time: 5:13 PM
 */

namespace Api\Output\Mapper\SeasonInfo;

class SeasonInfoWithTypeCode extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'seasonYearBegin' => 'season_year_begin',
            'seasonYearEnd' => 'season_year_end',
            'raceType' => 'race_type',
            'countryCode' => 'country_code',
            'statisticsTypeCode' => 'statistics_type',
        ];
    }
}
