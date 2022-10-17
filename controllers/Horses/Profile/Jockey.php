<?php

namespace Controllers\Horses\Profile;

use Api\Input\Request\Horses\Profile\Jockey as Request;
use Api\Result\JockeyProfile as Result;
use Bo\Profile\Jockey as Bo;
use Bo\Profile\RecordByRaceType\Jockey as BoRbr;
use RP\ContentAttributes\Element\Tags;

class Jockey extends \Controllers\Basic
{

    /**
     * @param Request\Statistics $request
     *
     * @throws \Exception
     */
    public function actionGetStatistics(Request\Statistics $request)
    {
        $result = (new Result\Statistics())->setData(
            (Object)[
                'statistics' => Bo::initByModel($request)->getStatistics(),
                'season_info' => (Object)[
                    'seasonYearBegin' => $request->getSeasonYearBegin(),
                    'seasonYearEnd' => $request->getSeasonYearEnd(),
                    'raceType' => $request->getRaceType(),
                    'countryCode' => $request->getCountryCode(),
                    'statisticsTypeCode' => $request->getStatisticsTypeCode(),
                ]
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Last14Days $request
     *
     * @throws \Exception
     */
    public function actionGetLast14Days(Request\Last14Days $request)
    {
        $result = (new Result\Last14Days())->setData(
            (Object)[
                'last_14_days' => Bo::init($request)->getLast14Days()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Horses $request
     *
     * @throws \Exception
     */
    public function actionGetHorses(Request\Horses $request)
    {
        $result = (new Result\Horses())->setData(
            (Object)[
                'horses' => Bo::initByModel($request)->getHorses(),
                'season_info' => (Object)[
                    'seasonYearBegin' => $request->getSeasonYearBegin(),
                    'raceType' => $request->getRaceType(),
                    'countryCode' => $request->getCountryCode(),
                ]
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\StatisticalSummary $request
     *
     * @throws \Exception
     */
    public function actionGetStatisticalSummary(Request\StatisticalSummary $request)
    {
        $bo = Bo::initByModel($request);
        $summary = $bo->getStatisticalSummary();

        list($start, $end) = \Bo\Profile::getSeasonInfoWithDateRange($summary);

        $result = (new Result\StatisticalSummary())->setData(
            (Object)[
                'statistical_summary' => $summary,
                'season_info' => (Object)[
                    'raceType' => $request->getRaceType(),
                    'countryCode' => $request->getCountryCode(),
                    'season_start_date' => $start,
                    'season_end_date' => $end,
                ]
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\RecordByRaceType $request
     *
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function actionGetRecordByRaceType(Request\RecordByRaceType $request)
    {
        $bo = BoRbr::initByModel($request);

        $result = (new Result\RecordByRaceType())->setData(
            (Object)[
                'record_by_race_type' => $bo->prepareRows($bo->getRows()),
                'season_info' => (Object)[
                    'seasonYearBegin' => $request->getSeasonYearBegin(),
                    'seasonYearEnd' => $request->getSeasonYearEnd(),
                    'seasonDateBegin' => $request->getSeasonDateBegin(),
                    'seasonDateEnd' => $request->getSeasonDateEnd(),
                    'raceType' => $request->getRaceType(),
                    'countryCode' => $request->getCountryCode()
                ]
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\BookedRides $request
     *
     * @throws \Exception
     */
    public function actionGetBookedRides(Request\BookedRides $request)
    {
        $result = (new Result\BookedRides())->setData(
            (Object)[
                'booked_rides' => Bo::init($request)->getBookedRides()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\BigRaceWins $request
     *
     * @throws \Exception
     */
    public function actionGetBigRaceWins(Request\BigRaceWins $request)
    {
        $result = (new Result\BigRaceWins())->setData(
            (Object)[
                'big_race_wins' => Bo::init($request)->getBigRaceWins()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Index $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetIndex(Request\Index $request)
    {
        $requestBRB = Request\RecordByRaceType::init($request);
        $boRBR = BoRbr::initByModel($requestBRB);

        $result = new Result\Index();
        $result->setEmptyResultException(new \Api\Exception\NotFound(6108));

        try {
            $recordByRaceType = $boRBR->prepareRows($boRBR->getRows());
            $statisticalSummary = Bo::initByModel(Request\StatisticalSummary::init($request))->getStatisticalSummary();
            $seasonInfo = (Object)[
                'seasonYearBegin' => $requestBRB->getSeasonYearBegin(),
                'seasonYearEnd' => $requestBRB->getSeasonYearEnd(),
                'raceType' => $requestBRB->getRaceType(),
                'countryCode' => $requestBRB->getCountryCode(),
            ];
        } catch (\Api\Exception\NotFound $e) {
            $recordByRaceType = null;
            $statisticalSummary = null;
            $seasonInfo = null;
        }

        $result->setData(
            (Object)[
                'profile' => Bo::init($request)->getJockey(),
                'big_race_wins' => Bo::init(Request\BigRaceWins::init($request))->getBigRaceWins(),
                'last_14_days' => Bo::init(Request\Last14Days::init($request))->getLast14Days(),
                'booked_rides' => Bo::init(Request\BookedRides::init($request))->getBookedRides(),
                'record_by_race_type' => $recordByRaceType,
                'statistical_summary' => $statisticalSummary,
                'season_info' => $seasonInfo,
            ]
        );

        $this->setResult($result);
    }

    public function initialize()
    {
        parent::initialize();
        $ca = $this->getContentAttributes();
        /** @var Tags $tags */
        $tags = $ca->tags();
        $tags->addJokeyGroup();
    }
}
