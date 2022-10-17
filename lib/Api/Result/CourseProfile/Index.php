<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\CourseProfile;

class Index extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\CourseProfile\Profile',
            'admission' => '\Api\Output\Mapper\CourseProfile\Admission',
            'directions' => '\Api\Output\Mapper\CourseProfile\Directions',
            'course_map' => '\Api\Output\Mapper\CourseProfile\CourseMap',
            'upcoming_races' => '\Api\Output\Mapper\CourseProfile\UpcomingRace',
            'seasons_available' => '\Api\Output\Mapper\CourseProfile\SeasonsAvailable',
        ];
    }
}
