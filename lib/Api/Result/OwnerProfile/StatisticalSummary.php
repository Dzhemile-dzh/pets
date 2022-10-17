<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\OwnerProfile;

class StatisticalSummary extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'statistical_summary' => '\Api\Output\Mapper\OwnerProfile\StatisticalSummary',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\StatisticalSummarySeasonInfo'
        ];
    }
}
