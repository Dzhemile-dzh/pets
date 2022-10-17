<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\FirstCrop as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class FirstCrop
 * @package Controllers\Horses\SeasonalStatistics
 */
class FirstCrop extends Basic
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\FirstCrop())->setData(
            (Object)[
                'seasonal_first_crop_statistics' => Bo::init($request)->getFirstCropStatistics() ? : null
            ]
        );

        $this->setResult($result);
    }
}
