<?php
namespace Api\Result\Signposts;

use Api\Result\Json as Result;

class FirstTimeBlinkers extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'first_time_blinkers' => '\Api\Output\Mapper\Signposts\FirstTimeBlinkers',
        ];
    }
}
