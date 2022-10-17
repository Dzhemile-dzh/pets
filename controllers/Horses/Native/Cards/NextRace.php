<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Cards;

use Api\Result\Native\Cards\NextRace as Result;
use Controllers\Basic;
use Bo\Native\Cards\NextRace as Bo;
use Api\Input\Request\Horses\Native\Cards\NextRace as Request;

/**
 * Class NextRace
 * @package Controllers\Horses\Native\Cards
 */
class NextRace extends Basic
{
    public function actionGetData(Request $request)
    {
        $bo = new Bo($request);
        $result = new Result();
        $result->setData($bo->getData());
        $this->setResult($result);
    }
}
