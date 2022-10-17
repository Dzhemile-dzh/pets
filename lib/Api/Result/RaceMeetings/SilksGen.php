<?php
namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

class SilksGen extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            '\Api\Output\Mapper\RaceMeetings\SilksGen',
        ];
    }
}
