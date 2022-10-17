<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/06/14
 * Time: 3:35 AM
 */

namespace Api\Result\SeasonalStatistics;

class Horse extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'season' => '\Api\Output\Mapper\SeasonalStatistics\Season',
            'seasonal_horse_statistics' => '\Api\Output\Mapper\SeasonalStatistics\Horse',
        ];
    }
}
