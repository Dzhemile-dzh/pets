<?php

namespace Api\Result\TrainerProfile;

class RecordByRaceType extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'record_by_race_type' => '\Api\Output\Mapper\TrainerProfile\RecordByRaceType',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\RecordByRaceTypeStatisticInfo',
        ];
    }
}
