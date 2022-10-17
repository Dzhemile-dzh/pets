<?php

declare(strict_types=1);

namespace Controllers\Horses\Native\Competitor;

use Controllers\Basic;
use Bo\Native\Competitor\CompetitorDetails as Bo;
use Api\Result\Native\Competitor\CompetitorDetails as Result;
use Api\Input\Request\Horses\Native\Competitor\CompetitorDetails as Request;
use Api\Exception\NotFound;

/**
 * @package Controllers\Horses\Native\Competitor
 */
class CompetitorDetails extends Basic
{
    /**
     * @param Request $request
     *
     * @throws \Exception
     */
    public function actionGetData(Request $request): void
    {
        $bo = new Bo($request);

        $result = new Result();
        $result->setEmptyResultException(
            new NotFound(
                15000,
                [$request->getHorseId(), $request->getRaceId()]
            )
        );

        $competitor = $bo->getCompetitorData($request->getHorseId(), $request->getRaceId());
        $races = $bo->getCompetitorResults($request->getHorseId(), $competitor->race_datetime);
        $result->setData(
            (Object)[
                'course' => $bo->getCourseData($request->getRaceId()),
                'competitor' => $competitor,
                'raceRecord' => $bo->getRaceRecords($races),
                'results' => $races,
            ]
        );
        $this->setResult($result);
    }
}
