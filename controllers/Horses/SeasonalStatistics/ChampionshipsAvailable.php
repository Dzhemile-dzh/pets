<?php

namespace Controllers\Horses\SeasonalStatistics;

use Controllers\Basic;
use Api\Input\Request\Horses\SeasonalStatistics\ChampionshipsAvailable as Request;
use Api\Result\SeasonalStatistics as Result;
use Bo\SeasonalStatistics as Bo;

/**
 * Class ChampionshipsAvailable
 * @package Controllers\Horses\SeasonalStatistics
 */
class ChampionshipsAvailable extends Basic
{
    /**
     * @param Request $request
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $result = (new Result\ChampionshipsAvailable())->setData(
            (Object)[
                'championships_available' => Bo::init($request)->getChampionshipsAvailable() ? : null
            ]
        );

        $this->setResult($result);
    }
}
