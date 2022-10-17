<?php

namespace Controllers\Horses\Native\Cards\Predictor;

use Controllers\Basic;
use Api\Exception\NotFound;
use Bo\Native\Cards\Predictor\Race as Bo;
use Api\Result\Native\Cards\Predictor\Race as Result;
use Api\Input\Request\Horses\Native\Cards\Predictor\Race as Request;

/**
 * Class Race
 *
 * @package Controllers\Horses\Native\Cards\Predictor
 */
class Race extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetRace(Request $request)
    {
        $bo = new Bo($request->getRaceId());

        $result = new Result();
        $result->setEmptyResultException(new NotFound(1103, $request->getRaceId()));
        $result->setData(
            (Object)[
                'race' => $bo->getRace(),
                'runners' => $bo->getPointsData()
            ]
        );

        $this->setResult($result);
    }
}
