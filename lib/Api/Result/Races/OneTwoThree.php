<?php

namespace Api\Result\Races;

use Api\Result\Json as Result;

/**
 * Class OneTwoThree
 * @package Api\Result\Races
 */
class OneTwoThree extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'races'               => 'Api\Output\Mapper\Races\OneTwoThree',
            'races.runners'       => 'Api\Output\Mapper\Races\Runners',
        ];
    }
}
