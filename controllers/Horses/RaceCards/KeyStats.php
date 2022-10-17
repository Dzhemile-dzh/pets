<?php

namespace Controllers\Horses\RaceCards;

use Bo\RaceCards as Bo;
use Controllers\Horses\RaceCards;
use Api\Result\RaceCards\KeyStats as Result;
use Api\Input\Request\Horses\RaceCards\KeyStats as Request;

/**
 * Class KeyStats
 *
 * @package Controllers\Horses\RaceCards
 */
class KeyStats extends RaceCards
{
    /**
     * @param Request $request
     */
    public function actionGetKeyStats(Request $request)
    {
        $raceCards = new Bo($request);

        $result = new Result();
        $result->setData(['key_stats' => $raceCards->retrieveVerdict()]);

        $this->setResult($result);
    }
}
