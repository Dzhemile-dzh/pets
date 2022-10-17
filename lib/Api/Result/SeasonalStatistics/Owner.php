<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\SeasonalStatistics;

class Owner extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'season' => '\Api\Output\Mapper\SeasonalStatistics\Season',
            'seasonal_owner_statistics' => '\Api\Output\Mapper\SeasonalStatistics\Owner',
            'seasonal_owner_statistics.top_trainer' => '\Api\Output\Mapper\SeasonalStatistics\OwnerTopTrainer',
        ];
    }
}
