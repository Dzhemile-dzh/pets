<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\CourseProfile;

class CourseMap extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'course_map' => '\Api\Output\Mapper\CourseProfile\CourseMap'
        ];
    }
}
