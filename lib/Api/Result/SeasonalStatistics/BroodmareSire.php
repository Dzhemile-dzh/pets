<?php
namespace Api\Result\SeasonalStatistics;

class BroodmareSire extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'season' => '\Api\Output\Mapper\SeasonalStatistics\Season',
            'seasonal_broodmare_sire_statistics' => '\Api\Output\Mapper\SeasonalStatistics\BroodmareSire',
            'seasonal_broodmare_sire_statistics.progeny_performers' => '\Api\Output\Mapper\SeasonalStatistics\BroodmareSireProgenyPerformers',
        ];
    }
}
