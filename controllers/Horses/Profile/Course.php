<?php

namespace Controllers\Horses\Profile;

use Api\Input\Request\Horses\Profile\Course as Request;
use Api\Result\CourseProfile as Result;
use Bo\Profile\Course as Bo;
use RP\ContentAttributes\Element\Tags;

/**
 * Class Course
 *
 * @package Controllers\Horses\Profile
 */
class Course extends \Controllers\Basic
{

    /**
     * @param Request\UpcomingRaces $request
     *
     * @throws \Api\Exception\NotFound
     * @throws \Exception
     */
    public function actionGetUpcomingRaces(Request\UpcomingRaces $request)
    {
        $result = (new Result\UpcomingRaces())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'upcoming_races' => Bo::init($request)->getUpcomingRaces()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\PrincipleRaceResults $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetPrincipleRaceResults(Request\PrincipleRaceResults $request)
    {
        $result = (new Result\PrincipleRaceResults())->setData(
            (Object)[
                'principle_race_results' => Bo::initByModel($request)->getPrincipleRaceResults(),
                'season_info' => (Object)[
                    'raceType' => $request->getRaceType(),
                    'coursePrincipalSeason' => $request->getCoursePrincipalSeason(),
                    'raceStatusType' => $request->getRaceStatusType()
                ]
            ]
        );

        $this->setResult($result);
    }

    /**
     * @param Request\Statistics $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetStatistics(Request\Statistics $request)
    {
        $result = (new Result\Statistics())
            ->setData(
                (Object)[
                    'statistics' => Bo::initByModel($request)->getStatistics(),
                    'season_info' => (Object)[
                        'seasonYearBegin' => $request->getSeasonYearBegin(),
                        'seasonYearEnd' => $request->getSeasonYearEnd(),
                        'raceType' => $request->getRaceType()
                    ]
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\StandardTimes $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetStandardTimes(Request\StandardTimes $request)
    {
        $result = (new Result\StandardTimes())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'standard_times' => Bo::init($request)->getStandardTimes()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\CourseMap $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetCourseMap(Request\CourseMap $request)
    {
        $result = (new Result\CourseMap())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'course_map' => Bo::init($request)->getCourseMap()
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
        $result = (new Result\Index())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'profile' => Bo::init($request)->getProfile(),
                    'admission' => Bo::init(Request\Admission::init($request))->getAdmission(),
                    'directions' => Bo::init(Request\Directions::init($request))->getDirections(),
                    'course_map' => Bo::init(Request\CourseMap::init($request))->getCourseMap(),
                    'upcoming_races' => Bo::init(Request\UpcomingRaces::init($request))->getUpcomingRaces(),
                    'seasons_available' => Bo::init(Request\SeasonsAvailable::init($request))->getSeasonsAvailable()
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\Admission $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetAdmission(Request\Admission $request)
    {
        $result = (new Result\Admission())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'admission' => Bo::init($request)->getAdmission(),
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\Directions $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetDirections(Request\Directions $request)
    {
        $result = (new Result\Directions())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'directions' => Bo::init($request)->getDirections(),
                ]
            );

        $this->setResult($result);
    }

    /**
     * @param Request\SeasonsAvailable $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetSeasonsAvailable(Request\SeasonsAvailable $request)
    {
        $result = (new Result\SeasonsAvailable())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'seasons_available' => Bo::init($request)->getSeasonsAvailable(),
                ]
            );

        $this->setResult($result);
    }

    public function actionGetTopJockeys(Request\TopJockeys $request)
    {
        $result = (new Result\TopJockeys())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData(
                (Object)[
                    'top_jockeys' => Bo::init($request)->getTopJockeys()
                ]
            );

        $this->setResult($result);
    }

    public function actionGetTopTrainers(Request\TopTrainers $request)
    {
        if (!is_null($request->getRaceDate())) {
            $result = (new Result\DailyTopTrainers());
        } else {
            $result = (new Result\TopTrainers());
        }
        $result
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData((Object)[
                'top_trainers' => Bo::init($request)->getTopTrainers()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\TopOwners $request
     *
     * @throws \Exception
     */
    public function actionGetTopOwners(Request\TopOwners $request)
    {
        $result = (new Result\TopOwners())
            ->setEmptyResultException(new \Api\Exception\NotFound(5101))
            ->setData((Object)[
                'top_owners' => Bo::init($request)->getTopOwners()
            ]);

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
