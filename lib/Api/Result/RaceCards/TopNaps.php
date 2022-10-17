<?php
namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

class TopNaps extends Result
{
    protected function getMappers()
    {
        return [
            'top_naps' => '\Api\Output\Mapper\RaceCards\TopNaps'
        ];
    }
}
