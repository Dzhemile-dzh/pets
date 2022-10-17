<?php

declare(strict_types=1);

namespace Controllers\Horses\AdPrompts;

use Api\Result\AdPrompts\NextRace as Result;
use Controllers\Basic;
use Api\Input\Request\Horses\AdPrompts\NextRace as Request;
use Bo\AdPrompts\NextRace as Bo;

/**
 * Class NextRace
 * @package Controllers\Horses\AdPrompts
 */
class NextRace extends Basic
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

        $result = $result->setData((object)$bo->getData());
        $this->setResult($result);
    }
}
