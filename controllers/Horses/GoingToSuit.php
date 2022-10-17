<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 12:30 PM
 */

namespace Controllers\Horses;

use Api\Input\Request\Horses\GoingToSuit as Request;
use Bo\Bloodstock\Stallion\ProgenyStatisticsGoingForm;

class GoingToSuit extends \Controllers\Basic
{
    public function actionGetIndex(Request\Index $request)
    {
        $bo = new \Bo\GoingToSuit\GoingToSuit($request);

        try {
            $race = $bo->getGoingToSuit();
            $horsesUid = $bo->getHorsesUid();

            $boProgenyStatGoingForm = new ProgenyStatisticsGoingForm($request);
            $bo->combineHorsesAndGoingForm(
                $bo->prepareRows($bo->getRows()),
                $boProgenyStatGoingForm->getGoingFormByHorses($horsesUid)
            );
        } catch (\LogicException $e) {
            $race = null;
        }

        $result = new \Api\Result\GoingToSuit\GoingToSuit();
        $result->setData(
            (Object)[
                'race' => $race
            ]
        );

        $this->setResult($result);
    }

    /** Race level response
     *
     * @param Request\Index|Request\RaceLevel $request
     */
    public function actionGetRaceLevel(Request\RaceLevel $request)
    {
        $bo = new \Bo\GoingToSuit\RaceLevel($request);

        try {
            $races = $bo->getRaceLevel();
        } catch (\LogicException $e) {
            $races = null;
        }

        $result = new \Api\Result\GoingToSuit\RaceLevel();
        $result->setData(
            (Object)[
                'race_level' => $races
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\RaceFlags $request
     */
    public function actionGetRaceFlags(Request\RaceFlags $request)
    {
        $bo = new \Bo\GoingToSuit\RaceFlags($request);

        try {
            $race = $bo->getRaceFlags();
            $horsesUid = $bo->getHorsesUid();

            $boProgenyStatGoingForm = new ProgenyStatisticsGoingForm($request);
            $bo->buildRaceFlags(
                $bo->prepareRows($bo->getRows()),
                $boProgenyStatGoingForm->getGoingFormByHorses($horsesUid)
            );
        } catch (\LogicException $e) {
            $race = null;
        }

        $result = (new \Api\Result\GoingToSuit\RaceFlags())
            ->setData(
                (Object)[
                    'race_flags' => $race
                ]
            );
        $this->setResult($result);
    }
}
