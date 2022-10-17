<?php

namespace Controllers\Horses\TotePredictor\Meeting;

use Controllers\Basic;
use Bo\TotePredictor\Meeting\Scoop6 as Bo;
use Api\Result\TotePredictor\Meeting\Scoop6 as Result;
use Api\Input\Request\Horses\TotePredictor\Meeting\Scoop6 as Request;

/**
 * Class Scoop6
 *
 * @package Controllers\Horses\TotePredictor
 */
class Scoop6 extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $bo = new Bo($request);
        $result = (new Result())->setData(['race' => $bo->getData(),]);
        $this->setResult($result);
    }
}
