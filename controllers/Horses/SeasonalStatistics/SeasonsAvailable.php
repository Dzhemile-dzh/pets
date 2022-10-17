<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\SeasonsAvailable as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class SeasonsAvailable
 * @package Controllers\Horses\SeasonalStatistics
 */
class SeasonsAvailable extends Basic
{
    /**
     * @param Request $request
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\SeasonsAvailable())->setData(
            (Object)[
                'seasons_available' => Bo::init($request)->getSeasonsAvailable()
            ]
        );

        $this->setResult($result);
    }
}
