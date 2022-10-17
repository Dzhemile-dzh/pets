<?php

namespace Controllers\Horses\Bloodstock;

use Bo\Bloodstock\Statistics as Bo;
use RP\ContentAttributes\Element\Tags;
use Api\Result\Bloodstock\Statistics as Result;
use Api\Input\Request\Horses\Bloodstock\Statistics as Request;
use \Api\Constants\Horses as Constants;

/**
 * Class Statistics
 *
 * @package Controllers\Horses\Bloodstock
 */
class Statistics extends \Controllers\Basic
{
    /**
     * @param Request\TopStallions $request
     *
     * @throws \Exception
     */
    public function actionGetTopStallions(Request\TopStallions $request)
    {
        $bo = new Bo\TopStallions($request);

        $result = new Result\TopStallions();
        $result->setData(['top_stallions' => $bo->getTopStallions()]);

        $this->setResult($result);
    }

    /**
     * @param Request\Yearlings $request
     *
     * @throws \Exception
     */
    public function actionGetYearlings(Request\Yearlings $request)
    {
        $bo = new Bo\Yearlings($request);

        $result = new Result\Yearlings();
        $result->setData(['yearlings' => $bo->prepareRows($bo->getRows())]);

        $this->setResult($result);
    }

    /**
     * @param Request\TopSires $request
     *
     * @throws \Exception
     */
    public function actionGetTopSires(Request\TopSires $request)
    {
        $bo = new Bo\TopSires($request);
        if ($request->getRaceType() == Constants::RACE_TYPE_JUMPS_ALIAS) {
            $result = new Result\TopSiresJump();
        } else {
            $result = new Result\TopSiresFlat();
        }

        $result->setData(['top_sires' => $bo->prepareRows($bo->getRows())]);

        $this->setResult($result);
    }

    /**
     * @param Request\Rating $request
     *
     * @throws \Exception
     */
    public function actionGetRating(Request\Rating $request)
    {
        $bo = new Bo\Rating($request);

        $result = new Result\Rating();
        $result->setData(['rating_statistic' => $bo->getRatingStatistic()]);

        $this->setResult($result);
    }

    /**
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();

        $ca = $this->getContentAttributes();

        /** @var Tags $tags */
        $tags = $ca->tags();
        $tags->addStatisticsGroup();
    }
}
