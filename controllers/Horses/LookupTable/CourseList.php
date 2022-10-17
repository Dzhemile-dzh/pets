<?php

namespace Controllers\Horses\LookupTable;

use Api\Input\Request\Horses\LookupTable\CourseList as Request;
use Api\Result\LookupTable\CourseList as Result;
use Bo\LookupTable\CourseList as Bo;

/**
 * @package Controllers\Horses
 */
class CourseList extends \Controllers\Basic
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
