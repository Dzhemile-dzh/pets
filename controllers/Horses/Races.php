<?php

declare(strict_types=1);

namespace Controllers\Horses;

use Api\Input\Request\Horses\Races\Request;
use Api\Input\Request\Horses\Races\RequestById;
use Controllers\Basic;
use Bo\Races as Bo;
use Api\Result\Races as Result;
use Exception;


/**
 * Class Races
 * @package Controllers\Horses\Races
 */
class Races extends Basic
{
    /**
     * @param Request $request
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);
        $result = new Result\OneTwoThree();

        $result->setData(['races' => $bo->getOneTwoThree()], true);
        $this->setResult($result);
    }

    /**
     * @param RequestById $request
     * @throws Exception
     */
    public function actionGetDataForRaceId(RequestById $request): void
    {
        $bo = new Bo($request);
        $result = new Result\OneTwoThreeRaceId();

        $result->setData(['runners' => $bo->getOneTwoThreeRaceId()]);
        $this->setResult($result);
    }

    /**
     * @param Request $request
     */
    public function actionGetFavourites(Request $request): void
    {
        $bo = new Bo($request);
        $result = new Result\Favourites();

        $result->setData(['races' => $bo->getFavourites()], true);
        $this->setResult($result);
    }

    /**
     * @param Request $request
     *
     * @throws Exception|Exception
     */
    public function actionGetRunnersIndex(Request $request)
    {
        $bo = new Bo($request);
        $result = new Result\RunnersIndex();

        $result->setData(['runners_index' => $bo->getRunnersIndex()], true);
        $this->setResult($result);
    }
}
