<?php

namespace Controllers\Horses;

use Controllers\Basic;
use Bo\DailyRaceMeetings as Bo;
use Api\Result\RaceMeetings\DailyRaceMeetings as Result;
use Api\Input\Request\Horses\RaceMeetings\DailyRaceMeetings as Request;

/**
 * Class DailyRaceMeetings
 *
 * @package Controllers\Horses\DailyRaceMeetings
 */
class DailyRaceMeetings extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetMeetings(Request $request)
    {
        $DailyRaceMeetingsBo = new Bo($request);
        $result = new Result();

        $result->setData(
            (Object)[
                'meetings' => $DailyRaceMeetingsBo->getMeetings()
            ]
        );

        $this->setResult($result);
    }
}
