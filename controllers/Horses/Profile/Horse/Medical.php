<?php

namespace Controllers\Horses\Profile\Horse;

use \Api\Input\Request\Horses\Profile\Horse\Medical as Request;
use \Bo\Profile\Horse\Medical as Bo;
use \Api\Result\HorseProfile\Medical as Result;

/**
 * Class Medical
 *
 * @package Controllers\Horses\Profile\Horse
 */
class Medical extends \Controllers\Basic
{
    /**
     * @param Request $request
     */
    public function actionGetMedical(Request $request)
    {
        $bo = new Bo($request);
        $this->setResult((new Result())->setData($bo->getResult()));
    }
}
