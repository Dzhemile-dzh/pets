<?php

namespace Api\Result\Bloodstock\Stallion;

class Index extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_horses' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyHorses',
            'progeny_entries' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyEntries',
            'progeny_results' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResults',
            'seasons_available' => '\Api\Output\Mapper\Bloodstock\Stallion\SeasonsAvailable',
            'fee_history' => '\Api\Output\Mapper\Bloodstock\Stallion\FeeHistory',
            'nick' => '\Api\Output\Mapper\Bloodstock\Stallion\Nick',
            'progeny_statistics.current_year' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyStatistics',
            'progeny_statistics.2000_to_date' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyStatistics',
            'progeny_statistics.1988_to_date' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyStatistics',
            'sale_statistics.sale_statistics' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatistics',
            'sale_statistics.sale_statistics.colts' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'sale_statistics.sale_statistics.fillies' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'sale_statistics.overall' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatistics',
            'sale_statistics.overall.colts' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'sale_statistics.overall.fillies' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'season_info.progeny_horses' => 'Api\Output\Mapper\SeasonInfo\StallionHorsesSeasonInfo',
            'season_info.progeny_results' => 'Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsSeasonInfo',
            'season_info.progeny_entries' => 'Api\Output\Mapper\SeasonInfo\RaceTypeSeasonInfo'
        ];
    }
}
