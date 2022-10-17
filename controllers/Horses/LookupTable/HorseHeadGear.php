<?php

namespace Controllers\Horses\LookupTable;

use Api\Input\Request\Horses\LookupTable\HorseHeadGear as Request;
use Api\Result\LookupTable\HorseHeadGear as Result;
use Bo\LookupTable\HorseHeadGear as Bo;

/**
 * @package Controllers\Horses
 */
class HorseHeadGear extends \Controllers\Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(['table' => $bo->getData()]);

        $this->setResult($result);
    }
}
