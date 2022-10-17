<?php

namespace Controllers\Horses\OwnerGroups;

use Controllers\Basic;
use Bo\OwnerGroups\DailyStats as Bo;
use Api\Result\OwnerGroups\DailyStats as Result;
use Api\Input\Request\Horses\OwnerGroups\DailyStats as Request;

/**
 * Class HorseList
 *
 * @package Controllers\Horses\OwnerGroups
 */
class DailyStats extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(['daily_stats' => $bo->getData()]);

        $this->setResult($result);
    }
}
