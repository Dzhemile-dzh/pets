<?php

namespace Api\Result\TotePredictor\Meeting;

use Api\Result\Json as Result;

/**
 * Class Scoop6
 *
 * @package Api\Result\TotePredictor
 */
class Scoop6 extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'race' => 'Api\Output\Mapper\TotePredictor\Race',
            'race.runners' => 'Api\Output\Mapper\TotePredictor\Runner',
        ];
    }
}
