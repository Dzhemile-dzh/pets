<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\SeasonalStatistics;

class Trainer extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'season' => '\Api\Output\Mapper\SeasonalStatistics\Season',
            'seasonal_trainer_statistics' => '\Api\Output\Mapper\SeasonalStatistics\Trainer',
            'seasonal_trainer_statistics.top_jockey' => \Api\Output\Mapper\SeasonalStatistics\TrainerJockeys::class,
        ];
    }
}
