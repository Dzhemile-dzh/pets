<?php

namespace Api\Result\Results;

class Courses extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'list' => '\Api\Output\Mapper\Results\Courses\Country',
            'list.courses' => '\Api\Output\Mapper\Results\Courses\Course',
        ];
    }
}
