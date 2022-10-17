<?php

namespace Api\Result\LookupTable;

/**
 * @package Api\Result\LookupTable
 */
class CourseList extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'table' => '\Api\Output\Mapper\LookupTable\CourseList',
        ];
    }
}
