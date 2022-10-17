<?php

namespace Controllers\Horses\RaceCards;

use \Api\Input\Request\Horses\RaceCards as Request;
use \Api\Result\RaceCards as Result;
use \Bo\RaceCards as Bo;

/**
 * Class TenYearTrends
 *
 * @package Controllers\Horses\RaceCards
 */
class TenYearTrends extends \Controllers\Basic
{
    /**
     * @param Request\TenYearTrends $request
     *
     * @throws \Exception
     */
    public function actionGetTenYearTrends(Request\TenYearTrends $request)
    {
        $raceCards = new Bo\TenYearTrends($request->getRaceId());

        $result = new Result\TenYearTrends();

        $result->setEmptyResultException(new \Api\Exception\NotFound(25))->setData(
            (Object)[
                'ten_year_trends' => $raceCards->getTenYearTrends(),
            ]
        );

        $this->setResult($result);
    }
}
