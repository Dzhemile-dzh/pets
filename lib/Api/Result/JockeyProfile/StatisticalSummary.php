<?php

namespace Api\Result\JockeyProfile;

/**
 * Class StatisticalSummary
 *
 * @package Api\Result\JockeyProfile
 */
class StatisticalSummary extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'statistical_summary' => '\Api\Output\Mapper\JockeyProfile\StatisticalSummary',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\StatisticalSummarySeasonInfo',
        ];
    }
}
