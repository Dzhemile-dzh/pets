<?php

namespace Tests\Stubs\Bo\RaceCards;

/**
 * Class RaceWFA
 *
 * @package Tests\Stubs\Bo\RaceCards
 */
class RaceWFA extends \Bo\RaceCards\RaceWFA
{
    public function __construct($raceId = null)
    {
        if ((!is_null($raceId) && !is_numeric($raceId)) || $raceId < 0) {
            throw new \Api\Exception\InternalServerError(3);
        }
        $this->setRaceId($raceId);
    }
}
