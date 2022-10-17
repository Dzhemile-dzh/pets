<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\Owner as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class Owner
 * @package Controllers\Horses\SeasonalStatistics
 */
class Owner extends Basic
{
    /**
     * @param Request $request
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\Owner())->setData(
            (Object)[
                'seasonal_owner_statistics' => Bo::initByModel($request)->getOwnerStatistics() ? : null,
                'season' => $request->getSeasons(),
            ]
        );

        $this->setResult($result);
    }
}
