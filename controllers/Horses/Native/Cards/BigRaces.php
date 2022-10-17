<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Cards;

use Controllers\Basic;
use Bo\Native\Cards\BigRaces as Bo;
use Api\Result\Native\Cards\BigRaces as Result;
use Api\Input\Request\Horses\Native\Cards\BigRaces as Request;

/**
 * @package Controllers\Horses\Native\Cards
 */
class BigRaces extends Basic
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

        $result->setData(['races' => $bo->getData()]);

        $this->setResult($result);
    }
}
