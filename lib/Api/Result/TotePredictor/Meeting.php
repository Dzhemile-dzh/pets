<?php

namespace Api\Result\TotePredictor;

/**
 * Class Race
 * @package Api\Result\TotePredictor
 */
class Meeting extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'meeting' => '\Api\Output\Mapper\TotePredictor\Meeting',
            'meeting.races' => '\Api\Output\Mapper\TotePredictor\Race',
            'meeting.races.runners' => '\Api\Output\Mapper\TotePredictor\Runner',
        ];
    }
}
