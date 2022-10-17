<?php

namespace controllers\Horses\RaceCards\Date;

use Controllers\Basic;
use Api\Exception\InternalServerError;
use Bo\RaceCards\Date\AllMeetings as Bo;
use Api\Result\RaceCards\Date\AllMeetings as Result;
use Api\Input\Request\Horses\RaceCards\Date\AllMeetings as Request;

/**
 * @package controllers\Horses\RaceCards\Date
 */
class AllMeetings extends Basic
{
    /**
     * @param Request $request
     *
     * @throws InternalServerError
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(['all_meetings' => $bo->getData()]);

        $this->setResult($result);
    }
}
