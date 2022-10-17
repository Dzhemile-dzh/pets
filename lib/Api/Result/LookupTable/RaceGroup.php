<?php

namespace Api\Result\LookupTable;

/**
 * @package Api\Result\LookupTable
 */
class RaceGroup extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'table' => '\Api\Output\Mapper\LookupTable\RaceGroup',
        ];
    }
}
