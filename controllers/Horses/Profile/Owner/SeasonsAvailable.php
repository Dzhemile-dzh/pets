<?php

namespace Controllers\Horses\Profile\Owner;

use Api\Input\Request\Horses\Profile\Owner\SeasonsAvailable as Request;
use Api\Result\OwnerProfile\SeasonsAvailable as Result;
use Controllers\Horses\Profile\Owner;

/**
 * Class SeasonsAvailable
 * @package Controllers\Horses\Profile\Owner
 */
class SeasonsAvailable extends Owner
{
    /**
     * @param Request $request
     */
    public function actionGetSeasonsAvailable(Request $request)
    {
        $bo = new \Bo\Profile\Owner\SeasonsAvailable($request);

        $result = (new Result())->setData(
            [
                'seasons_available' => $bo->getSeasonsAvailable()
            ]
        );

        $this->setResult($result);
    }
}
