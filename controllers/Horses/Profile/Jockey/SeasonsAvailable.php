<?php

namespace Controllers\Horses\Profile\Jockey;

use Api\Input\Request\Horses\Profile\Jockey\SeasonsAvailable as Request;
use Api\Result\JockeyProfile\SeasonsAvailable as Result;
use Controllers\Horses\Profile\Jockey;

/**
 * Class SeasonsAvailable
 * @package Controllers\Horses\Profile\Jockey
 */
class SeasonsAvailable extends Jockey
{
    /**
     * @param Request $request
     */
    public function actionGetSeasonsAvailable(Request $request)
    {
        $bo = new \Bo\Profile\Jockey\SeasonsAvailable($request);

        $result = (new Result())->setData(
            [
                'seasons_available' => $bo->getSeasonsAvailable()
            ]
        );

        $this->setResult($result);
    }
}
