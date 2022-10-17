<?php

namespace Api\Result\CourseProfile;

class Statistics extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'statistics.top_trainers' => '\Api\Output\Mapper\CourseProfile\Statistics\TopTrainers',
            'statistics.top_jockeys' => '\Api\Output\Mapper\CourseProfile\Statistics\TopJockeys',
            'statistics.top_owners' => '\Api\Output\Mapper\CourseProfile\Statistics\TopOwners',
            'statistics.top_horses' => '\Api\Output\Mapper\CourseProfile\Statistics\TopHorses',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\SimpleSeasonInfo'
        ];
    }
}
