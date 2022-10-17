<?php

namespace Api\Result\Signposts;

class TravellersCheck extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'travellers_check' => '\Api\Output\Mapper\Signposts\TravellersCheck',
        ];
    }
}
