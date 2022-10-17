<?php

namespace Api\Result\CourseProfile;

/**
 * Class Standard
 *
 * @package Api\Result\CourseProfile
 */
class Standard extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\CourseProfile\Standard',
        ];
    }
}
