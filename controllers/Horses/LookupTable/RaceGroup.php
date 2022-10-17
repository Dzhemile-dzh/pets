<?php

namespace Controllers\Horses\LookupTable;

use Api\Input\Request\Horses\LookupTable\RaceGroup as Request;
use Api\Result\LookupTable\RaceGroup as Result;
use Bo\LookupTable\RaceGroup as Bo;

/**
 * @package Controllers\Horses
 */
class RaceGroup extends \Controllers\Basic
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
