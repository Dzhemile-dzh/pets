<?php
namespace Api\Result\Bloodstock\Sales;

use Api\Result\Json as Result;

class Catalogue extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'catalogue' => '\Api\Output\Mapper\Bloodstock\Sales\Catalogue',
        ];
    }
}
