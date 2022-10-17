<?php

namespace Api\Result\Signposts;

class TopUpcomingRpr extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'top_upcoming_rpr' => '\Api\Output\Mapper\Signposts\TopUpcomingRpr',
        ];
    }
}
