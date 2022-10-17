<?php

namespace Api\Result\Bloodstock\Stallion;

class SeasonsAvailable extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'seasons_available' => '\Api\Output\Mapper\Bloodstock\Stallion\SeasonsAvailable'
        ];
    }
}
