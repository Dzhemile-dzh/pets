<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\BroodmareSire as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class BroodmareSire
 * @package Controllers\Horses\SeasonalStatistics
 */
class BroodmareSire extends Basic
{
    /**
     * @param Request $request
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\BroodmareSire())->setData(
            (Object)[
                'seasonal_broodmare_sire_statistics' => Bo::initByModel($request)->getBroodmareSireStatistics() ? : null,
                'season' => $request->getSeasons(),
            ]
        );

        $this->setResult($result);
    }
}
