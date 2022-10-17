<?php
namespace Api\Result\Bloodstock\Sales;

use Api\Result\Json as Result;

class PreviouslySold extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'previously-sold' => '\Api\Output\Mapper\Bloodstock\Sales\PreviouslySold',
        ];
    }
}
