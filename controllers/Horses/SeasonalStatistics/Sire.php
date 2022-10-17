<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\Sire as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class Sire
 * @package Controllers\Horses\SeasonalStatistics
 */
class Sire extends Basic
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\Sire())->setData(
            (Object)[
                'seasonal_sire_statistics' => Bo::initByModel($request)->getSireStatistics() ? : null,
                'season' => $request->getSeasons()
            ]
        );

        $this->setResult($result);
    }
}
