<?php
namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

class TopTrainers extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        $result = [
            'courses' => '\Api\Output\Mapper\RaceMeetings\TopTrainers'
        ];

        $raceTypesMappers = [
            'overall' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'nh_flat' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'chase_turf' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'flat_turf' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersFlat',
            'hurdle_turf' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'point_to_point' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'hunter_chase' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'nh_flat_aw' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'flat_aw' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersFlat',
            'hurdle_aw' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
            'chase_aw' => '\Api\Output\Mapper\CourseProfile\DailyTopTrainersJumps',
        ];

        foreach ($this->data->courses as $course) {
            foreach ($course->top_trainers as $raceType => $races) {
                $pathToField = 'courses.top_trainers.' . $raceType;
                $result += [$pathToField => $raceTypesMappers[$raceType]];
            }
        }

        return $result;
    }
}
