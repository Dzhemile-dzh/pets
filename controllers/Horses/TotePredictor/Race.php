<?php

namespace Controllers\Horses\TotePredictor;

use Controllers\Basic;
use Api\Exception\NotFound;
use Bo\TotePredictor\Race as Bo;
use Api\Result\TotePredictor\Race as Result;
use Api\Input\Request\Horses\TotePredictor\Race as Request;

/**
 * Class Race
 *
 * @package Controllers\Horses
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
        $bo = new Bo($request);

        $result = new Result();
        $result->setEmptyResultException(new NotFound(1103, $request->getRaceId()));
        $result->setData(['race' => $bo->getData()]);

        $this->setResult($result);
    }
}
