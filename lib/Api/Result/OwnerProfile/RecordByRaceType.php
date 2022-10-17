<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 9/21/2016
 * Time: 6:43 PM
 */

namespace Api\Result\OwnerProfile;

class RecordByRaceType extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'record_by_race_type' => '\Api\Output\Mapper\OwnerProfile\RecordByRaceType',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\RecordByRaceTypeStatisticInfo',
        ];
    }
}
