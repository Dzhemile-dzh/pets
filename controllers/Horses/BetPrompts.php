<?php

namespace Controllers\Horses;

use Controllers\Basic;
use Bo\BetPrompts as Bo;
use Api\Result\BetPrompts\BetPrompts as Result;
use Api\Input\Request\Horses\BetPrompts\Index as Request;

/**
 * Class BetPrompts
 *
 * @package Controllers\Horses
 */
class BetPrompts extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetIndex(Request $request)
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setData(['bet_prompts' => $bo->getBetPrompts()]);

        $this->setResult($result);
    }
}
