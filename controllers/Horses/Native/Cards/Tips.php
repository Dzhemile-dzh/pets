<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Cards;

use Controllers\Basic;
use Api\Exception\NotFound;
use Bo\Native\Cards\Tips as Bo;
use Api\Result\Native\Cards\Tips as Result;
use Api\Input\Request\Horses\Native\Cards\Tips as Request;

/**
 * @package Controllers\Horses\Native\Cards
 */
class Tips extends Basic
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
        $result->setEmptyResultException(new NotFound(1103, $request->getRaceId()));
        $result->setData($bo->getData());

        $this->setResult($result);
    }
}
