<?php

namespace Controllers\Horses\OwnerGroups;

use Controllers\Basic;
use Bo\OwnerGroups\TrainerList as Bo;
use Api\Result\OwnerGroups\TrainerList as Result;
use Api\Input\Request\Horses\OwnerGroups\TrainerList as Request;

/**
 * Class TrainerList
 * @package Controllers\Horses\OwnerGroups
 */
class TrainerList extends Basic
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(
            [
                'trainer_list' => $bo->getData()
            ]
        );

        $this->setResult($result);
    }
}
