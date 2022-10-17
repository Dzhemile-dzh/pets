<?php

namespace Controllers\Horses\OwnerGroups;

use Controllers\Basic;
use Bo\OwnerGroups\Splash as Bo;
use Api\Result\OwnerGroups\Splash as Result;
use Api\Input\Request\Horses\OwnerGroups\Splash as Request;

/**
 * @package Controllers\Horses\OwnerGroups
 */
class Splash extends Basic
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
        $result->setData(['splash' => $bo->getData()]);

        $this->setResult($result);
    }
}
