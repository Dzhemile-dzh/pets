<?php

namespace Controllers\Horses\Profile\Trainer;

use Api\Input\Request\Horses\Profile\Trainer\SeasonsAvailable as Request;
use Api\Result\TrainerProfile\SeasonsAvailable as Result;
use Controllers\Horses\Profile\Trainer;

/**
 * Class SeasonsAvailable
 * @package Controllers\Horses\Profile\Trainer
 */
class SeasonsAvailable extends Trainer
{
    /**
     * @param Request $request
     */
    public function actionGetSeasonsAvailable(Request $request)
    {
        $bo = new \Bo\Profile\Trainer\SeasonsAvailable($request);

        $result = (new Result())->setData(
            [
                'seasons_available' => $bo->getSeasonsAvailable()
            ]
        );

        $this->setResult($result);
    }
}
