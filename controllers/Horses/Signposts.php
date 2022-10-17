<?php

namespace Controllers\Horses;

use Api\Exception\NotFound;
use Api\Input\Request\Horses\Signposts as Request;
use Api\Result\Signposts as Result;
use Bo\Signposts as Bo;

/**
 * Class Signposts
 *
 * @package Controllers\Horses
 */
class Signposts extends \Controllers\Basic
{

    /**
     * @param Request\Index $request
     * @throws \Exception
     */
    public function actionGetIndex(Request\Index $request)
    {
        $bo = Bo::init($request);
        $result = (new Result\Index())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'hot_trainers' => $bo->resetRequest(Request\HotTrainers::init($request))->getHotTrainers(),
                'hot_jockeys' => $bo->resetRequest(Request\HotJockeys::init($request))->getHotJockeys(),
                'course_jockeys' => $bo->resetRequest(Request\CourseJockeys::init($request))->getCourseJockeys(),
                'course_trainers' => $bo->resetRequest(Request\CourseTrainers::init($request))->getCourseTrainers(),
                'top_upcoming_rpr' => $bo->resetRequest(Request\TopUpcomingRpr::init($request))->getTopUpcomingHorses(),
                'trainers_jockeys' => $bo->resetRequest(Request\TrainersJockeys::init($request))->getTrainersJockeys(),
                'horses_for_courses' => $bo->resetRequest(Request\HorsesForCourses::init($request))
                    ->getHorsesForCourses(),
                'ahead_of_handicapper' => $bo->resetRequest(Request\AheadOfHandicapper::init($request))
                    ->getAheadOfHandicapper(),
                'seven_day_winners' => $bo->resetRequest(Request\SevenDayWinners::init($request))->getSevenDayWinners(),
                'travellers_check' => $bo->resetRequest(Request\TravellersCheck::init($request))->getTravellersCheck(),
                'first_time_blinkers' => $bo->resetRequest(Request\FirstTimeBlinkers::init($request))
                    ->getFirstTimeBlinkers()
            ]);

        $this->setResult($result);
    }

    /**
     * @param $request
     * @throws \Exception
     */
    public function actionGetListForMobile($request)
    {
        $bo = new Bo($request);
        $result = (new Result\ListForMobile())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'hot_trainers' => $bo->buildListForMobile($bo->resetRequest(Request\HotTrainers::init($request))
                    ->getHotTrainers()),
                'hot_jockeys' => $bo->buildListForMobile($bo->resetRequest(Request\HotJockeys::init($request))
                    ->getHotJockeys()),
                'course_jockeys' => $bo->buildListForMobile($bo->resetRequest(Request\CourseJockeys::init($request))
                    ->getCourseJockeys()),
                'course_trainers' => $bo->buildListForMobile($bo->resetRequest(Request\CourseTrainers::init($request))
                    ->getCourseTrainers()),
                'travellers_check' => $bo->buildListForMobile($bo->resetRequest(Request\TravellersCheck::init($request))
                    ->getTravellersCheck()),
                'trainers_jockeys' => $bo->buildListForMobile($bo->resetRequest(Request\TrainersJockeys::init($request))
                    ->getTrainersJockeys()),
                'horses_for_courses' => $bo->buildListForMobile($bo->resetRequest(Request\HorsesForCourses::init($request))
                    ->getHorsesForCourses()),
                'ahead_of_handicapper' => $bo->buildListForMobile($bo->resetRequest(Request\AheadOfHandicapper::init($request))
                    ->getAheadOfHandicapper()),
                'seven_day_winners' => $bo->buildListForMobile($bo->resetRequest(Request\SevenDayWinners::init($request))
                    ->getSevenDayWinners())
            ], true);

        $this->setResult($result);
    }

    /**
     * @param Request\Sweetspots $request
     * @throws \Exception
     */
    public function actionGetSweetspots(Request\Sweetspots $request)
    {
        $result = (new Result\Sweetspots())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'sweet_spots' => Bo::init($request)->getSweetspots()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\HotTrainers $request
     * @throws \Exception
     */
    public function actionGetHotTrainers(Request\HotTrainers $request)
    {
        $result = (new Result\HotTrainers())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'hot_trainers' => Bo::init($request)->getHotTrainers()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\HotJockeys $request
     * @throws \Exception
     */
    public function actionGetHotJockeys(Request\HotJockeys $request)
    {
        $result = (new Result\HotJockeys())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'hot_jockeys' => Bo::init($request)->getHotJockeys()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\CourseJockeys $request
     * @throws \Exception
     */
    public function actionGetCourseJockeys(Request\CourseJockeys $request)
    {
        $result = (new Result\CourseJockeys())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'courses' => Bo::init($request)->getCourseJockeys()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\CourseTrainers $request
     * @throws \Exception
     */
    public function actionGetCourseTrainers(Request\CourseTrainers $request)
    {
        $result = (new Result\CourseTrainers())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'courses' => Bo::init($request)->getCourseTrainers()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\TopUpcomingRpr $request
     * @throws \Exception
     */
    public function actionGetTopUpcomingRpr(Request\TopUpcomingRpr $request)
    {
        $result = (new Result\TopUpcomingRpr())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'top_upcoming_rpr' => Bo::init($request)->getTopUpcomingHorses()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\TrainersJockeys $request
     * @throws \Exception
     */
    public function actionGetTrainersJockeys(Request\TrainersJockeys $request)
    {
        $result = (new Result\TrainersJockeys())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'trainers_jockeys' => Bo::init($request)->getTrainersJockeys()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\HorsesForCourses $request
     * @throws \Exception
     */
    public function actionGetHorsesForCourses(Request\HorsesForCourses $request)
    {
        $result = (new Result\HorsesForCourses())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'horses_for_courses' => Bo::init($request)->getHorsesForCourses()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\AheadOfHandicapper $request
     * @throws \Exception
     */
    public function actionGetAheadOfHandicapper(Request\AheadOfHandicapper $request)
    {
        $result = (new Result\AheadOfHandicapper())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'ahead_of_handicapper' => Bo::init($request)->getAheadOfHandicapper()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\SevenDayWinners $request
     * @throws \Exception
     */
    public function actionGetSevenDayWinners(Request\SevenDayWinners $request)
    {
        $result = (new Result\SevenDayWinners())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'seven_day_winners' => Bo::init($request)->getSevenDayWinners()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\TravellersCheck $request
     * @throws \Exception
     */
    public function actionGetTravellersCheck(Request\TravellersCheck $request)
    {
        $result = (new Result\TravellersCheck())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'travellers_check' => Bo::init($request)->getTravellersCheck()
            ]);

        $this->setResult($result);
    }

    /**
     * @param Request\FirstTimeBlinkers $request
     * @throws \Exception
     */
    public function actionGetFirstTimeBlinkers(Request\FirstTimeBlinkers $request)
    {
        $result = (new Result\FirstTimeBlinkers())
            ->setEmptyResultException(new NotFound(5))
            ->setData((Object)[
                'first_time_blinkers' => Bo::init($request)->getFirstTimeBlinkers()
            ]);

        $this->setResult($result);
    }
}
