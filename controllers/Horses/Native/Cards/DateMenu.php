<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Cards;

use Controllers\Basic;
use Bo\Native\Cards\DateMenu as Bo;
use Api\Result\Native\Cards\DateMenu as Result;
use Api\Input\Request\Horses\Native\Cards\DateMenu as Request;

/**
 * @package Controllers\Horses\Native\Cards
 */
class DateMenu extends Basic
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

        $result->setData([
            'actionType' => 'card',
            'dates' => $bo->getData()
        ]);

        $this->setResult($result);
    }
}
