<?php

namespace Controllers\Horses\TotePredictor\Meeting;

use Controllers\Basic;
use Bo\TotePredictor\Meeting\Jackpot as Bo;
use \Api\Input\Request\Horses\TotePredictor\Meeting\Jackpot as Request;

/**
 * Class Jackpot
 * @package Controllers\Horses\TotePredictor\Meeting
 */
class Jackpot extends Basic
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $bo = new Bo($request);
        $result = (new \Api\Result\TotePredictor\Meeting\Jackpot())->setData(
            [
                'jackpot' => $bo->getData(),
            ]
        );

        $this->setResult($result);
    }
}
