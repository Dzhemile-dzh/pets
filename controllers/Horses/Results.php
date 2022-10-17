<?php

namespace Controllers\Horses;

use RP\ContentAttributes\Element\Tags;
use \Api\Input\Request\Horses\Results as InputRequest;

/**
 * Class Results
 * @package Controllers\Horses
 */
class Results extends \Controllers\Basic
{
    /**
     * @param InputRequest\Index $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetIndex(InputRequest\Index $request)
    {
        $resultsObject = new \Bo\Results($request);
        $raceInfo = $resultsObject->getRaceInfo();
        $raceResult = $resultsObject->getResultsByRaceId();

        $result = (new \Api\Result\Results\Index());

        if (empty($raceInfo)) {
            $result->setEmptyResultException(new \Api\Exception\NotFound(7101));
            $result->setData(null);
        } elseif (empty($raceResult)) {
            $result->setEmptyResultException(new \Api\Exception\NotFound(25));
            $result->setData(null);
        } else {
            $raceIds = $resultsObject->getRaceIds();
            $result->setData(
                [
                    'race_info'         => $raceInfo,
                    'non_runners'       => $resultsObject->getNonRunners(),
                    'statistic'         => $resultsObject->getStatistic(),
                    'result'            => $raceResult,
                    'next_race_id'      => $raceIds['next_race_id'],
                    'prev_race_id'      => $raceIds['prev_race_id'],
                    'first_race_id'     => $raceIds['first_race_id'],
                    'last_race_id'      => $raceIds['last_race_id'],
                    'draw_bias_index'   => $resultsObject->getDbi(),
                    'next_run'          => $resultsObject->addNextRun(),
                ]
            );
        }

        $this->setResult($result);
    }

    /**
     * @param InputRequest\RaceInfo $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetRaceInfo(InputRequest\RaceInfo $request)
    {
        $resultsObject = new \Bo\Results($request);
        $raceIds = $resultsObject->getRaceIds();

        $result = (new \Api\Result\Results\RaceInfo())
            ->setEmptyResultException(new \Api\Exception\NotFound(7101))
            ->setData(
                (Object)[
                    'race_info' => $resultsObject->getRaceInfo(),
                    'next_race_id'      => $raceIds['next_race_id'],
                    'prev_race_id'      => $raceIds['prev_race_id'],
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param InputRequest\DateRequest $request
     *
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     */
    public function actionGetDate(InputRequest\DateRequest $request)
    {
        $meetings = new \Bo\Results($request);

        $result = (new \Api\Result\Results\ResultsDate())
            ->setData($meetings->getResultsByDate());

        $this->setResult($result);
    }

    /**
     * @param InputRequest\Fast $request
     */
    public function actionGetFast(InputRequest\Fast $request)
    {
        $resultsObject = new \Bo\Results($request);

        $result = (new \Api\Result\Results\Fast())->setData(
            (Object)['fast_result' => $resultsObject->getFastResult()]
        );

        $this->setResult($result);
    }
    /**
     * @param InputRequest\FastByRace $request
     */
    public function actionGetFastByRace(InputRequest\FastByRace $request)
    {
        $resultsObject = new \Bo\Results($request);

        $result = (new \Api\Result\Results\Fast())->setData(
            (Object)['fast_result' => $resultsObject->getFastByRaceResult()]
        );

        $this->setResult($result);
    }

    /**
     * @param InputRequest\Courses $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetCourses(InputRequest\Courses $request)
    {
        $resultsObject = new \Bo\Results($request);

        $result = (new \Api\Result\Results\Courses())
            ->setEmptyResultException(new \Api\Exception\NotFound(4104))
            ->setData((Object)['list' => $resultsObject->getCourses()]);

        $this->setResult($result);
    }

    /**
     * @param InputRequest\Search $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetSearch(InputRequest\Search $request)
    {
        $resultsObject = new \Bo\Results($request);

        $result = (new \Api\Result\Results\Search())
            ->setEmptyResultException(new \Api\Exception\NotFound(5))
            ->setData($resultsObject->getSearchResult());

        $this->setResult($result);
    }

    /**
     * @param InputRequest\WinningTimes $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetWinningTimes(InputRequest\WinningTimes $request)
    {
        $resultsObject = new \Bo\Results($request);

        $result = (new \Api\Result\Results\WinningTimes())
            ->setData(
                (Object)[
                    'winning_times' => $resultsObject->getWinningTimes()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param InputRequest\DateRequest $request
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetAllRaces(InputRequest\DateRequestAllRaces $request)
    {
        $meetings = new \Bo\Results($request);

        $result = (new \Api\Result\Results\ResultsDate())
            ->setData($meetings->getResultsByDate(true, $request->getReturnP2P()));

        $this->setResult($result);
    }

    /**
     * @param InputRequest\PastWinners $request
     * @throws \Exception
     */
    public function actionGetPastWinners(InputRequest\PastWinners $request)
    {
        $resultsObject = new \Bo\Results($request);
        $result = new \Api\Result\Results\PastWinners();

        $result->setData(
            (Object)[
                'past_winners' => $resultsObject->getPastWinners(),
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param InputRequest\SalesData $request
     */
    public function actionGetResultsSalesData(InputRequest\SalesData $request)
    {
        $results = new \Bo\Results($request);

        $result = new \Api\Result\Results\SalesData();

        $result->setData(
            [
                'sales' => $results->getResultsSalesData($request),
            ]
        );

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
        $tags->addResultGroup();
    }
}
