<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Cards;

use Controllers\Basic;
use Bo\Native\Cards\CardsList as Bo;
use Api\Result\Native\Cards\CardsList as Result;
use Api\Input\Request\Horses\Native\Cards\CardsList as Request;

/**
 * @package Controllers\Horses\Native\Cards
 */
class CardsList extends Basic
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

        $result->setData(['cards' => $bo->getData()]);

        $this->setResult($result);
    }
}
