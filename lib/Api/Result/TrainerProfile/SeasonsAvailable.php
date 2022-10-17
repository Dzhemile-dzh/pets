<?php

namespace Api\Result\TrainerProfile;

use Api\Result\Json as Result;

/**
 * Class Last14Days
 * @package Api\Result\TrainerProfile
 */
class SeasonsAvailable extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'seasons_available' => '\Api\Output\Mapper\TrainerProfile\SeasonsAvailable',
        ];
    }
}
