<?php

namespace Api\Result\CourseProfile;

/**
 * Class AverageTimes
 * @package Api\Result\CourseProfile
 */
class AverageTimes extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'average_times.flat' => '\Api\Output\Mapper\CourseProfile\AverageTimes',
            'average_times.jumps' => '\Api\Output\Mapper\CourseProfile\AverageTimes',
        ];
    }
}
