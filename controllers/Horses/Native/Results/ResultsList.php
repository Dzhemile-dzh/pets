<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Results;

use Controllers\Basic;
use Bo\Native\Results\ResultsList as Bo;
use Api\Result\Native\Cards\Results\ResultsList as Result;
use Api\Input\Request\Horses\Native\Results\ResultsList as Request;

/**
 * @package Controllers\Horses\Native\Results
 */
class ResultsList extends Basic
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
