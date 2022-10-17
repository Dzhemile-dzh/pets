<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/1/2016
 * Time: 3:17 PM
 */

namespace Api\Result\Signposts;

class HorsesForCourses extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'horses_for_courses' => '\Api\Output\Mapper\Signposts\HorsesForCourses',
            'horses_for_courses.entries' => '\Api\Output\Mapper\Signposts\Entries',
        ];
    }
}
