<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/06/14
 * Time: 3:35 AM
 */

namespace Api\Result\SeasonalStatistics;

class FirstCrop extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'seasonal_first_crop_statistics' => '\Api\Output\Mapper\SeasonalStatistics\FirstCrop',
            'seasonal_first_crop_statistics.progeny_performers' => '\Api\Output\Mapper\SeasonalStatistics\SireProgenyPerformers',
        ];
    }
}
