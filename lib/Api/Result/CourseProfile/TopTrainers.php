<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/7/2016
 * Time: 4:07 PM
 */

namespace Api\Result\CourseProfile;

class TopTrainers extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'top_trainers.nh_flat' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.chase_turf' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.flat_turf' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.hurdle_turf' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.point_to_point' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.hunter_chase' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.nh_flat_aw' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.flat_aw' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.hurdle_aw' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
            'top_trainers.chase_aw' => '\Api\Output\Mapper\CourseProfile\TopTrainers',
        ];
    }
}
