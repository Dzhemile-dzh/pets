<?php
namespace Api\Result\SeasonalStatistics;

class Sire extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'season' => '\Api\Output\Mapper\SeasonalStatistics\Season',
            'seasonal_sire_statistics' => '\Api\Output\Mapper\SeasonalStatistics\Sire',
            'seasonal_sire_statistics.progeny_performers' => '\Api\Output\Mapper\SeasonalStatistics\SireProgenyPerformers',
        ];
    }
}
