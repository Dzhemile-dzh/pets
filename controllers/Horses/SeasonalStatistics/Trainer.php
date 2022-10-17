<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\Trainer as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class Trainer
 * @package Controllers\Horses\SeasonalStatistics
 */
class Trainer extends Basic
{
    /**
     * @param Request $request
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\Trainer())->setData(
            (Object)[
                'seasonal_trainer_statistics' => Bo::initByModel($request)->getTrainerStatistics() ? : null,
                'season' => $request->getSeasons(),
            ]
        );

        $this->setResult($result);
    }
}
