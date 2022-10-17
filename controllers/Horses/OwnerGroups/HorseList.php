<?php

namespace Controllers\Horses\OwnerGroups;

use Controllers\Basic;
use Bo\OwnerGroups\HorseList as Bo;
use Api\Result\OwnerGroups\HorseList as Result;
use Api\Input\Request\Horses\OwnerGroups\HorseList as Request;

/**
 * Class HorseList
 *
 * @package Controllers\Horses\OwnerGroups
 */
class HorseList extends Basic
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
        $result->setData(['horse_list' => $bo->getData()]);
        $this->setResult($result);
    }
}
