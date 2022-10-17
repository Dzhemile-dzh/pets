<?php

declare(strict_types=1);

namespace Controllers\Horses\Predictor;

use \Api\Exception\NotFound;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Api\Input\Request\Horses\Predictor\Index as Request;
use \Api\DataProvider\Bo\Predictor\RaceInstance as DataProvider;

/**
 * Class NextRace
 *
 * @package Controllers\Horses\Predictor
 */
class NextRace extends Race
{
    /**
     * @throws NotFound
     * @throws ResultsetException
     * @throws \Exception
     */
    public function actionGetNextRace(): void
    {
        $dataProvider = new DataProvider();
        $raceId = $dataProvider->getNextRaceId();

        if (!($raceId > 0)) {
            throw new NotFound(1113);
        }

        $this->actionGetIndex(
            new Request(
                [],
                [
                    'raceId' => $raceId
                ]
            )
        );
    }
}
