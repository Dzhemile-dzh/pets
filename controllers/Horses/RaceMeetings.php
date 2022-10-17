<?php

namespace Controllers\Horses;

use Api\Exception\NotFound;
use Controllers\Basic;
use Api\Input\Request\Horses\RaceMeetings as Request;
use Api\Result\RaceMeetings as Result;
use Bo\RaceMeetings as Bo;
use RP\ContentAttributes\Element\Tags;

/**
 * Class RaceMeetings
 *
 * @package Controllers\Horses
 */
class RaceMeetings extends Basic
{
    /**
     * @param Request\MeetingInfo $request
     *
     * @throws \Exception
     */
    public function actionGetMeetingInfo(Request\MeetingInfo $request)
    {
        $result = (new Result\MeetingInfo());
        $result->setEmptyResultException(
            new NotFound(
                14000
            )
        );
        $result->setData(
            (Object)[
                'meeting_info' => Bo::init($request)->getMeetingInfo()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Favourites $request
     *
     * @throws \Exception
     */
    public function actionGetFavourites(Request\Favourites $request)
    {
        $result = (new Result\Favourites())->setData(
            (Object)[
                'favourites' => Bo::initByModel($request)->getFavourites(),
                'season_defaults' => [
                    'season_type_code' => $request->getSeasonTypeCode(),
                    'season_race_type' => $request->getRaceType()
                ]
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Signposts $request
     *
     * @throws \Exception
     */
    public function actionGetSignposts(Request\Signposts $request)
    {
        $result = (new Result\Signposts())->setData(
            (Object)[
                'signposts' => Bo::init($request)->getSignposts()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Statistics $request
     *
     * @throws \Exception
     */
    public function actionGetStatistics(Request\Statistics $request)
    {
        $result = (new Result\Statistics())->setData(
            (Object)[
                'statistics' => Bo::init($request)->getStatistics()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\StandardTimes $request
     *
     * @throws \Exception
     */
    public function actionGetStandardTimes(Request\StandardTimes $request)
    {
        $result = (new Result\StandardTimes())->setData(
            (Object)[
                'standard_times' => Bo::init($request)->getStandardTimes()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\RunnersIndex $request
     *
     * @throws \Exception
     */
    public function actionGetRunnersIndex(Request\RunnersIndex $request)
    {
        $result = (new Result\RunnersIndex())->setData(
            (Object)[
                'runners_index' => Bo::init($request)->getRunnersIndex()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\NonRunners $request
     *
     * @throws \Exception
     */
    public function actionGetNonRunners(Request\NonRunners $request)
    {
        $result = (new Result\NonRunners())->setData(
            (Object)[
                'non_runners' => Bo::init($request)->getNonRunners() ?: null
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\SilksGen $request
     *
     * @throws \Exception
     */
    public function actionGetSilksGen(Request\SilksGen $request)
    {
        $boMeetings = new \Bo\RaceMeetings($request);

        $result = new \Api\Result\RaceMeetings\SilksGen();
        $result->setData(
            (Object)[
                'silks_gen' => $boMeetings->getSilksGen()
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\TopTrainers $request
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function actionGetTopTrainers(Request\TopTrainers $request)
    {
        $boMeetings = new \Bo\RaceMeetings($request);

        $result = new \Api\Result\RaceMeetings\TopTrainers();
        $result->setData(
            (Object)[
                'courses' => $boMeetings->getTopPerformanceInfoFor('trainers')
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\JockeyChanges $request
     *
     * @throws \Exception
     */

    /**
     * @param Request\JockeyChanges $request
     */
    public function actionGetJockeyChanges(Request\JockeyChanges $request)
    {
        $boMeetings = new \Bo\RaceMeetings($request);

        $result = new \Api\Result\RaceMeetings\JockeyChanges();
        $result->setData($boMeetings->getJockeyChanges());

        $this->setResult($result);
    }

    /**
     * @param Request\TopJockeys $request
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function actionGetTopJockeys(Request\TopJockeys $request)
    {
        $boMeetings = new \Bo\RaceMeetings($request);

        $result = new \Api\Result\RaceMeetings\TopJockeys();
        $result->setData(
            (Object)[
                'courses' => $boMeetings->getTopPerformanceInfoFor('jockeys')
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\GoingChanges $request
     *
     * @throws \Exception
     */
    public function actionGetGoingChanges(Request\GoingChanges $request)
    {
        $boMeetings = new \Bo\RaceMeetings($request);

        $result = new \Api\Result\RaceMeetings\GoingChanges();

        $result->setEmptyResultException(
            new NotFound(
                18000
            )
        );

        $result->setData($boMeetings->getGoingChanges());

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
        $tags->addCourseGroup();
    }
}
