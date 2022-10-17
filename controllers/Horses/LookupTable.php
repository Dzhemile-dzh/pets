<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 25.09.2014
 * Time: 12:01
 */

namespace Controllers\Horses;

class LookupTable extends \Controllers\Basic
{
    /**
     * @param \Api\Input\Request\Horses\LookupTable\Going $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetGoing(\Api\Input\Request\Horses\LookupTable\Going $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getGoingTypeTable()]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\RaceType $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetRaceType(\Api\Input\Request\Horses\LookupTable\RaceType $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getRaceTypeTable()]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\CourseType $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetCourseType(\Api\Input\Request\Horses\LookupTable\CourseType $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getCourseTypeTable()]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\Country $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetCountry(\Api\Input\Request\Horses\LookupTable\Country $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getCountryTable()]
            );

        $this->setResult($result);
    }

    public function actionGetFinishingPositions(\Api\Input\Request\Horses\LookupTable\FinishingPositions $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\LookupTable\FinishingPositions())
            ->setData(
                (Object)['table' => $bo->getRaceOutcomeTable()]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\HorseColour $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetHorseColour(\Api\Input\Request\Horses\LookupTable\HorseColour $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getHorseColourTable()]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\HorseSex $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetHorseSex(\Api\Input\Request\Horses\LookupTable\HorseSex $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getHorseSexTable()]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\MeetingColoursLookup $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetMeetingColoursLookup(\Api\Input\Request\Horses\LookupTable\MeetingColoursLookup $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getMeetingColoursLookupTable()]
            );

        $this->setResult($result);
    }
    /**
     * @param \Api\Input\Request\Horses\LookupTable\AdditionalCourseInfo $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetAdditionalCourseInfo(\Api\Input\Request\Horses\LookupTable\AdditionalCourseInfo $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getAdditionalCourseInfoTable()]
            );

        $this->setResult($result);
    }

    /**
     * @param \Api\Input\Request\Horses\LookupTable\Odds $request
     *
     * @throws \Api\Exception\NotFound
     */
    public function actionGetOdds(\Api\Input\Request\Horses\LookupTable\Odds $request)
    {
        $bo = new \Bo\LookupTable($request);

        $result = (new \Api\Result\Json())
            ->setData(
                (Object)['table' => $bo->getOddsTable()]
            );

        $this->setResult($result);
    }
}
