<?php

namespace Controllers\Horses\Profile;

use Api\Input\Request\Horses\Profile\Trainer as Request;
use Api\Result\TrainerProfile as Result;
use Bo\Profile\RecordByRaceType\Trainer as BoRbr;
use Bo\Profile\Trainer as Bo;
use RP\ContentAttributes\Element\Tags;

/**
 * Class Trainer
 *
 * @package Controllers\Horses\Profile
 */
class Trainer extends \Controllers\Basic
{
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
     * @param Request\Last14DaysForm $request
     *
     * @throws \Exception
     */
    public function actionGetLast14DaysForm(Request\Last14DaysForm $request)
    {
            $result = (new Result\Last14DaysForm())->setData(
                (Object)[
                'last_14_days_form' => Bo::init($request)->getLast14DaysForm()
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
        $bo = Bo::initByModel($request);

        $result = (new Result\Horses())->setData(
            (Object)[
                'horses' => $bo->getHorses(),
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
     * @throws \Api\Exception\NotFound
     * @throws \Api\Exception\ValidationError
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
     * @param Request\Entries $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetEntries(Request\Entries $request)
    {
        $result = (new Result\Entries())->setData(
            (Object)[
                'entries' => Bo::init($request)->getEntries()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Statistics $request
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
                    'statisticsTypeCode' => $request->getStatisticsTypeCode()
                ]
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\RecordByRaceType $request
     * @throws \Api\Exception\ValidationError
     */
    public function actionGetRecordByRaceType(Request\RecordByRaceType $request)
    {
        $bo = BoRbr::initByModel($request);

        $result = (new Result\RecordByRaceType())->setData(
            (Object)[
                'record_by_race_type' => $bo->prepareRows($bo->getRows()),
                'season_info' => (Object)[
                    'seasonYearBegin' => $request->getSeasonYearBegin(),
                    'seasonYearEnd'   => $request->getSeasonYearEnd(),
                    'seasonDateBegin' => $request->getSeasonDateBegin(),
                    'seasonDateEnd'   => $request->getSeasonDateEnd(),
                    'raceType'        => $request->getRaceType(),
                    'countryCode'     => $request->getCountryCode()
                ]
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
        $boRBR = BoRbr::initByModel(Request\RecordByRaceType::init($request));

        $result = new Result\Index();
        $result->setEmptyResultException(new \Api\Exception\NotFound(8108));

        try {
            $recordByRaceType = $boRBR->prepareRows($boRBR->getRows());
            $statisticalSummary = Bo::initByModel(Request\StatisticalSummary::init($request))->getStatisticalSummary();
        } catch (\Api\Exception\ValidationError $e) {
            $recordByRaceType = null;
            $statisticalSummary = null;
        }

        $result->setData(
            (Object)[
                'profile' => Bo::init($request)->getTrainer(),
                'entries' => Bo::init(Request\Entries::init($request))->getEntries(),
                'big_race_wins' => Bo::init(Request\BigRaceWins::init($request))->getBigRaceWins(),
                'record_by_race_type' => $recordByRaceType,
                'statistical_summary' => $statisticalSummary,
                'last_14_days' => Bo::init(Request\Last14Days::init($request))->getLast14Days()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Results $request
     */
    public function actionGetResults(Request\Results $request)
    {
        $result = (new Result\Results())->setData(
            (Object)[
                'results' => Bo::init($request)->getResults()
            ]
        );
        $this->setResult($result);
    }


    public function initialize()
    {
        parent::initialize();
        $ca = $this->getContentAttributes();
        /**
        * @var Tags $tags
        */
        $tags = $ca->tags();
        $tags->addTrainerGroup();
    }
}
