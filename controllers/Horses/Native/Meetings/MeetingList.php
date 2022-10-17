<?php

namespace Controllers\Horses\Native\Meetings;

use Controllers\Basic;
use Bo\Native\Meetings\MeetingList as Bo;
use Api\Result\Native\Meetings\MeetingList as Result;
use Api\Input\Request\Horses\Native\Meetings\MeetingList as Request;

/**
 * Class MeetingList
 *
 * @package Controllers\Horses\Native\Meetings\MeetingList
 */
class MeetingList extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetListByDate(Request $request): void
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(['meetings' => $bo->getListByDate()]);

        $this->setResult($result);
    }
}
