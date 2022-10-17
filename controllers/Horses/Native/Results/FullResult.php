<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Results;

use Controllers\Basic;
use Bo\Native\Results\FullResult as Bo;
use Api\Result\Native\Cards\Results\FullResult as Result;
use Api\Input\Request\Horses\Native\Results\FullResult as Request;

/**
 * @package Controllers\Horses\Native\Results
 */
class FullResult extends Basic
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

        $result->setData($bo->getData());

        $this->setResult($result);
    }
}
