<?php

namespace Api\Result\Results;

class Search extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'search_result' => '\Api\Output\Mapper\Results\Search'
        ];
    }
}
