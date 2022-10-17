<?php
namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

class TopJockeys extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        $result = [
            'courses' => '\Api\Output\Mapper\RaceMeetings\TopJockeysCourse'
        ];

        $raceTypesMappers = [
            'overall' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'nh_flat' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'chase_turf' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'flat_turf' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'hurdle_turf' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'point_to_point' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'hunter_chase' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'nh_flat_aw' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'flat_aw' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'hurdle_aw' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
            'chase_aw' => '\Api\Output\Mapper\RaceMeetings\TopJockeys',
        ];

        foreach ($this->data->courses as $course) {
            foreach ($course->top_jockeys as $raceType => $races) {
                $pathToField = 'courses.top_jockeys.' . $raceType;
                $result += [$pathToField => $raceTypesMappers[$raceType]];
            }
        }
        return $result;
    }
}
