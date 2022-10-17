<?php

namespace Api\Result\JockeyProfile;

use Api\Result\Json as Result;

/**
 * Class SeasonsAvailable
 * @package Api\Result\JockeyProfile
 */
class SeasonsAvailable extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'seasons_available' => '\Api\Output\Mapper\JockeyProfile\SeasonsAvailable',
        ];
    }
}
