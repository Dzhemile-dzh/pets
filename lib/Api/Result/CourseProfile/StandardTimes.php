<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\CourseProfile;

class StandardTimes extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'standard_times.flat' => '\Api\Output\Mapper\CourseProfile\StandardTimes',
            'standard_times.jumps' => '\Api\Output\Mapper\CourseProfile\StandardTimes'
        ];
    }
}
