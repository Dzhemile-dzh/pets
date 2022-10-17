<?php

namespace Controllers\Horses\RaceCards;

use Controllers\Basic;
use Bo\RaceCards\WindSurgeries as Bo;
use Api\Result\RaceCards\WindSurgeries as Result;
use Api\Input\Request\Horses\RaceCards\WindSurgeries as Request;

/**
 * Class WindSurgeries
 *
 * @package Controllers\Horses\RaceCards
 */
class WindSurgeries extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(['wind_surgeries' => $bo->getData()]);

        $this->setResult($result);
    }
}
