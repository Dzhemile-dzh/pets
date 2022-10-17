<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\JockeyProfile;

class RecordByRaceType extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'record_by_race_type' => '\Api\Output\Mapper\JockeyProfile\RecordByRaceType',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\RecordByRaceTypeStatisticInfo',
        ];
    }
}
