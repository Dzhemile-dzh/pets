<?php

namespace Controllers\Horses\TotePredictor;

use Controllers\Basic;
use Bo\TotePredictor\Meeting as Bo;
use \Api\Input\Request\Horses\TotePredictor\Meeting as Request;

/**
 * Class Meeting
 * @package Controllers\Horses\TotePredictor
 */
class Meeting extends Basic
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function actionGetMeeting(Request $request)
    {
        $bo = new Bo($request);
        $result = (new \Api\Result\TotePredictor\Meeting())->setData(
            [
                'meeting' => $bo->getData(),
            ]
        );

        $this->setResult($result);
    }
}
