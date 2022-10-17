<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards;

class BettingForecast extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'country_origin_code' => 'country_origin_code',
            'start_number' => 'start_number',
            'forecast_odds_value' => 'forecast_odds_value',
            'forecast_odds_desc' => 'forecast_odds_desc',
            '(forecastOddsStyle)forecast_odds_desc' => 'forecast_odds_style',
        ];
    }
}
