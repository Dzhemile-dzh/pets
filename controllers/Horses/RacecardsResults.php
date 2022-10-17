<?php

declare(strict_types=1);

namespace Controllers\Horses;

use Controllers\Basic;
use Bo\RacecardsResults as Bo;

use Api\Result\RacecardsResults\RacecardsResults as Result;
use Api\Input\Request\Horses\RacecardsResults as Request;

/**
 * Class RacecardsResults
 * @package Controllers\Horses
 */
class RacecardsResults extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);
        $result = new Result;

        $result->setData(['race'=> $bo->getData()], true);
        $this->setResult($result);
    }
}
