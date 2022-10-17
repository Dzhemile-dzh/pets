<?php

namespace Api\Result\TotePredictor;

/**
 * Class Race
 * @package Api\Result\TotePredictor
 */
class Race extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race' => '\Api\Output\Mapper\TotePredictor\Race',
            'race.runners' => '\Api\Output\Mapper\TotePredictor\Runner',
        ];
    }
}
