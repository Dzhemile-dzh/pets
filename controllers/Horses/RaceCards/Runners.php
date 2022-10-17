<?php

namespace controllers\Horses\RaceCards;

use Controllers\Basic;
use Api\Exception\ValidationError;
use Bo\RaceCards\Runners as RunnersBo;
use Api\Result\RaceCards\Runners as RunnersResult;
use \Api\Input\Request\Horses\RaceCards as Request;

/**
 * Class Runners
 * @package controllers\Horses\RaceCards
 */
class Runners extends Basic
{
    /**
     * @param Request\Runners $request
     * @throws ValidationError
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     */
    public function actionGetIndex(Request\Runners $request)
    {
        $raceCards = new RunnersBo($request);
        $runners = $raceCards->getRunners($request, false, null, $request->getReturnP2P());

        $this->setResult((new RunnersResult())->setData(['runners' => $runners]));
    }
}
