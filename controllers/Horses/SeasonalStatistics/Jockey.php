<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\Jockey as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class Sire
 * @package Controllers\Horses\SeasonalStatistics
 */
class Jockey extends Basic
{
    /**
     * @param Jockey $request
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\Jockey())->setData(
            (Object)[
                'seasonal_jockey_statistics' => Bo::initByModel($request)->getJockeyStatistics() ? : null,
                'season' => $request->getSeasons(),
            ]
        );

        $this->setResult($result);
    }
}
