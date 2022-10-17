<?php

namespace Api\Result\LookupTable;

class FinishingPositions extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'table' => '\Api\Output\Mapper\LookupTable\FinishingPositions',
        ];
    }
}
