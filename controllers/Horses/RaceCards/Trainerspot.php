<?php

namespace Controllers\Horses\RaceCards;

use \Api\Input\Request\Horses\RaceCards\Trainerspot as Request;
use \Api\Result\RaceCards\Trainerspot as Result;
use \Bo\RaceCards\Trainerspot as Bo;

/**
 * Class Trainerspot
 *
 * @package Controllers\Horses\RaceCards
 */
class Trainerspot extends \Controllers\Basic
{
    /**
     * @param Request\InForm $request
     *
     * @throws \Exception
     */
    public function actionGetInForm(Request\InForm $request)
    {
        $bo = new Bo\Form($request);
        $result = new Result\Form();

        $result->setData((Object)[
            'trainerspot' => $bo->getForm($request)
        ]);

        $this->setResult($result);
    }

    /**
     * @param Request\OutOfForm $request
     *
     * @throws \Exception
     */
    public function actionGetOutOfForm(Request\OutOfForm $request)
    {
        $bo = new Bo\Form($request);
        $result = new Result\Form();

        $result->setData((Object)[
            'trainerspot' => $bo->getForm($request)
        ]);

        $this->setResult($result);
    }

    /**
     * @param Request\RaceTrace $request
     *
     * @throws \Exception
     */
    public function actionGetRaceTrace(Request\RaceTrace $request)
    {
        $raceCards = new Bo\RaceTrace($request);
        $result = new Result\RaceTrace();

        $result->setData((Object)[
            'trainerspot' => $raceCards->getRaceTraceData()
        ]);

        $this->setResult($result);
    }

    /**
     * @param Request\CourseSpecialists $request
     *
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     */
    public function actionGetCourseSpecialists(Request\CourseSpecialists $request)
    {
        $raceCards = new Bo\CourseSpecialists($request);
        $result = new Result\CourseSpecialists($request);

        $result->setData((Object)[
            'trainerspot' => $raceCards->getCourseSpecialists()
        ]);

        $this->setResult($result);
    }

    /**
     * @param Request\JockeyBookings $request
     *
     * @throws \Exception
     */
    public function actionGetJockeyBookings(Request\JockeyBookings $request)
    {
        $raceCards = new Bo\JockeyBookings($request);
        $result = new Result\JockeyBookings($request);

        $result->setData((Object)[
            'trainerspot' => $raceCards->getJockeyBookings()
        ]);

        $this->setResult($result);
    }
}
