<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Cards;

use Controllers\Basic;
use Bo\Native\Cards\FullCard as Bo;
use Api\Result\Native\Cards\FullCard as Result;
use Api\Input\Request\Horses\Native\Cards\FullCard as Request;

/**
 * @package Controllers\Horses\Native\Cards
 */
class FullCard extends Basic
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
