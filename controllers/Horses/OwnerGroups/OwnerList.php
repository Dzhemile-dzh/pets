<?php

namespace Controllers\Horses\OwnerGroups;

use Controllers\Basic;
use Bo\OwnerGroups\OwnerList as Bo;
use Api\Result\OwnerGroups\OwnerList as Result;
use Api\Input\Request\Horses\OwnerGroups\OwnerList as Request;

/**
 * @package Controllers\Horses\OwnerGroups
 */
class OwnerList extends Basic
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
        $result->setData(['owner_list' => $bo->getData()]);

        $this->setResult($result);
    }
}
