<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 12/24/2015
 * Time: 5:13 PM
 */

namespace Api\Output\Mapper\SeasonInfo;

class HorsesSeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'seasonYearBegin' => 'season_year_begin',
            'raceType' => 'race_type',
            'countryCode' => 'country_code',
        ];
    }
}
