<?php

namespace Controllers\Horses\Bloodstock\Stallion;

use Controllers\Basic;
use Bo\Bloodstock\Stallion\ProgenyHorses as Bo;
use Api\Result\Bloodstock\Stallion\DamSireProgenyHorses as Result;
use Api\Input\Request\Horses\Bloodstock\Stallion\DamSireProgenyHorses as Request;

/**
 * Class DamSireProgenyHorses
 *
 * @package Controllers\Horses\Bloodstock\Stallion
 */
class DamSireProgenyHorses extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request)
    {
        $bo = Bo::initByModel($request);

        $result = new Result();
        $result->setData([
            'dam_sire_progeny_horses' => $bo->getProgenyHorses(),
            'season_info' => (Object)[
                'raceType' => $request->getRaceType(),
                'seasonYearBegin' => $request->getSeasonYearBegin(),
                'seasonYearEnd' => $request->getSeasonYearEnd(),
                'more_progeny_available' => $bo->isMoreProgenyAvailable(),
                'number' => $request->getNumber(),
            ],
        ]);

        $this->setResult($result);
    }
}
