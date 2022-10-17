<?php

namespace Api\Result\RaceCards;

class PastWinners extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'past_winners' => '\Api\Output\Mapper\RaceCards\PastWinners',
        ];
    }
}
