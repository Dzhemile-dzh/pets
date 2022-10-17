<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\SeasonalStatistics;

class Jockey extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'season' => '\Api\Output\Mapper\SeasonalStatistics\Season',
            'seasonal_jockey_statistics' => '\Api\Output\Mapper\SeasonalStatistics\Jockey',
        ];
    }
}
