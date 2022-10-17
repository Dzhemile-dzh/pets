<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/1/2016
 * Time: 11:49 AM
 */

namespace Api\Result\CourseProfile;

class TopJockeys extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        $raceTypesMappers = [
            'nh_flat' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'chase_turf' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'flat_turf' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'hurdle_turf' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'point_to_point' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'hunter_chase' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'nh_flat_aw' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'flat_aw' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'hurdle_aw' => '\Api\Output\Mapper\CourseProfile\TopJockeys',
            'chase_aw' => '\Api\Output\Mapper\CourseProfile\TopJockeys'
        ];

        $result = [];

        foreach ($this->data->top_jockeys as $raceType => $races) {
            $pathToField = 'top_jockeys.' . $raceType;
            $result += [$pathToField => $raceTypesMappers[$raceType]];
        }

        return $result;
    }
}
