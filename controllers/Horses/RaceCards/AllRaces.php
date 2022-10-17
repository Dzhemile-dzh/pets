<?php

namespace Controllers\Horses\RaceCards;

use Bo\RaceCards as RaceCardsBo;
use Controllers\Horses\RaceCards;
use \Api\Exception\NotFound as NotFoundException;
use Api\Result\RaceCards\AllRaces as AllRacesResult;
use Api\Input\Request\Horses\RaceCards\AllRaces as AllRacesRequest;

/**
 * Class AllRaces
 *
 * @package Controllers\Horses\RaceCards
 */
class AllRaces extends RaceCards
{
    /**
     * @param AllRacesRequest $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetAllRaces(AllRacesRequest $request)
    {
        $raceCards = new RaceCardsBo($request);

        $result = new AllRacesResult();
        $result->setEmptyResultException(new NotFoundException(7102));

        $result->setData(
            (Object)[
                'list' => $raceCards->getList($request->getRaceDate(), true)
            ]
        );

        $this->setResult($result);
    }
}
