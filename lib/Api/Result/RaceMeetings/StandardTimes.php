<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 7/22/2016
 * Time: 12:30 PM
 */

namespace Api\Result\RaceMeetings;

class StandardTimes extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'standard_times.flat_records' => '\Api\Output\Mapper\RaceMeetings\StandardTimes',
            'standard_times.jumps_records' => '\Api\Output\Mapper\RaceMeetings\StandardTimes',
        ];
    }
}
