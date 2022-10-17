<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\CourseProfile;

class UpcomingRaces extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'upcoming_races' => '\Api\Output\Mapper\CourseProfile\UpcomingRace'
        ];
    }
}
