<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 4/7/2017
 * Time: 2:48 PM
 */

namespace Api\Result\SeasonalStatistics;

class SeasonsAvailable extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'seasons_available' => '\Api\Output\Mapper\SeasonalStatistics\SeasonsAvailable'
        ];
    }
}
