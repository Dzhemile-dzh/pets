<?php

namespace Api\Result\RaceCards;

class RaceCardUpcoming extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'list' => '\Api\Output\Mapper\RaceCards\RaceCardsUpcoming\Upcoming',
        ];
    }
}
