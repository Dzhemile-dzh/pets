<?php

namespace Controllers\Horses\LookupTable;

use Api\Input\Request\Horses\LookupTable\SalesVenues as Request;
use Api\Result\LookupTable\SalesVenues as Result;
use Bo\LookupTable\SalesVenues as Bo;

/**
 * @package Controllers\Horses
 */
class SalesVenues extends \Controllers\Basic
{
    /**
     * @param Request $request
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
