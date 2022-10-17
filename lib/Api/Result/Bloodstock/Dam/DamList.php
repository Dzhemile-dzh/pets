<?php
namespace Api\Result\Bloodstock\Dam;

use Api\Result\Json as Result;

class DamList extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'list' => '\Api\Output\Mapper\Bloodstock\Dam\DamList'
        ];
    }
}
