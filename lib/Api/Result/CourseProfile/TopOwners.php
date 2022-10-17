<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/13/2016
 * Time: 3:13 PM
 */

namespace Api\Result\CourseProfile;

class TopOwners extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'top_owners.nh_flat' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.chase_turf' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.flat_turf' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.hurdle_turf' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.point_to_point' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.hunter_chase' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.nh_flat_aw' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.flat_aw' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.hurdle_aw' => '\Api\Output\Mapper\CourseProfile\TopOwners',
            'top_owners.chase_aw' => '\Api\Output\Mapper\CourseProfile\TopOwners'
        ];
    }
}
