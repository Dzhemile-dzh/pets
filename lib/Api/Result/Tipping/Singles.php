<?php

namespace Api\Result\Tipping;

use Api\Result\Json as Result;

/**
 * Class Tippings
 *
 * @package Api\Result\Tipping
 */
class Singles extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'tipping_singles' => '\Api\Output\Mapper\Tipping\Singles',
        ];
    }
}
