<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/6/2016
 * Time: 4:57 PM
 */

namespace Api\Result\RaceCards;

class TenYearTrends extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'ten_year_trends.trends' => '\Api\Output\Mapper\RaceCards\TenYearTrends\Trends',
            'ten_year_trends.winning_trainers' => '\Api\Output\Mapper\RaceCards\TenYearTrends\WinningTrainers',
            'ten_year_trends.jockeys' => '\Api\Output\Mapper\RaceCards\TenYearTrends\Jockeys',
            'ten_year_trends.previous_run' => '\Api\Output\Mapper\RaceCards\TenYearTrends\PreviousRun',
            'ten_year_trends.favourites.1st_favourite' => '\Api\Output\Mapper\RaceCards\TenYearTrends\Favourites',
            'ten_year_trends.favourites.2nd_favourite' => '\Api\Output\Mapper\RaceCards\TenYearTrends\Favourites',
        ];
    }
}
