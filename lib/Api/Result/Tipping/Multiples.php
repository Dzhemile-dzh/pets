<?php

namespace Api\Result\Tipping;

use Api\Result\Json as Result;

/**
 * Class Multiples
 *
 * @package Api\Result\Tipping
 */
class Multiples extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'tipping_multiples' => '\Api\Output\Mapper\Tipping\Multiples',
            'tipping_multiples.tips' => '\Api\Output\Mapper\Tipping\Singles',
        ];
    }
}
