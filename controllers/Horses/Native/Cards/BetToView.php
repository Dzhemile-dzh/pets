<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Cards;

use Controllers\Basic;
use Api\Exception\NotFound;
use Bo\Native\Cards\BetToView as Bo;
use Api\Result\Native\Cards\BetToView as Result;
use Api\Input\Request\Horses\Native\Cards\BetToView as Request;

/**
 * @package Controllers\Horses\Native\Cards
 */
class BetToView extends Basic
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
        $result->setData(['perform' => $bo->getData()]);

        $this->setResult($result);
    }
}
