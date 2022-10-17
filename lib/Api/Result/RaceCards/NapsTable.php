<?php
namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

class NapsTable extends Result
{
    protected function getMappers()
    {
        return [
            'naps_table' => '\Api\Output\Mapper\RaceCards\NapsTable'
        ];
    }
}
