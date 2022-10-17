<?php

namespace Api\Result\OwnerProfile;

use Api\Result\Json as Result;

/**
 * Class SeasonsAvailable
 * @package Api\Result\OwnerProfile
 */
class SeasonsAvailable extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'seasons_available' => '\Api\Output\Mapper\OwnerProfile\SeasonsAvailable',
        ];
    }
}
