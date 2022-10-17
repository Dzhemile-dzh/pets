<?php

namespace Api\Result\RaceCards;

use Api\Result\Json as Result;

/**
 * Class AllRaces
 *
 * @package Api\Result\RaceCards
 */
class AllRaces extends Result
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'list' => '\Api\Output\Mapper\RaceCards\RaceCardsDate\Meeting',
            'list.races' => '\Api\Output\Mapper\RaceCards\RaceCardsDate\ListRace'
        ];
    }
}
