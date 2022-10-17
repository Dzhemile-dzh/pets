<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\Horse as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class Sire
 * @package Controllers\Horses\SeasonalStatistics
 */
class Horse extends Basic
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\Horse())->setData(
            (Object)[
                'seasonal_horse_statistics' => Bo::initByModel($request)->getHorseStatistics() ? : null,
                'season' => $request->getSeasons(),
            ]
        );

        $this->setResult($result);
    }
}
