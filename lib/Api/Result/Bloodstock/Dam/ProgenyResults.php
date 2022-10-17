<?php

namespace Api\Result\Bloodstock\Dam;

class ProgenyResults extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny-results' => '\Api\Output\Mapper\Bloodstock\Dam\ProgenyResults'
        ];
    }
}
