<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/7/2016
 * Time: 4:07 PM
 */

namespace Api\Result\CourseProfile;

class DailyTopTrainers extends \Api\Result\Json
{
    protected function getMappers()
    {
        $raceTypesMappers = [
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

        $result = [];

        foreach ($this->data->top_trainers as $raceType => $races) {
            $pathToField = 'top_trainers.' . $raceType;
            if (isset($raceTypesMappers[$raceType])) {
                $result += [$pathToField => $raceTypesMappers[$raceType]];
            }
        }

        return $result;
    }
}
