<?php

namespace Bo;

use Phalcon\DI;

abstract class Standart
{

    const VALUE_YES = 'Y';
    const VALUE_NO = 'N';

    protected $request;

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @return static
     */
    public static function init(\Api\Input\Request\HorsesRequest $request)
    {
        $bo = new static($request);
        return $bo;
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     */
    public function __construct(\Api\Input\Request\HorsesRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return static
     */
    public function resetRequest(\Api\Input\Request\HorsesRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return \Api\Input\Request\HorsesRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Horse
     */
    protected function getModelHorse()
    {
        return new \Models\Horse();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\PostdataResultsNew
     */
    protected function getModelPostdataResultsNew()
    {
        return new \Models\PostdataResultsNew();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Models\HorseRace();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Course
     */
    protected function getModelCourse()
    {
        return new \Models\Course();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\RaceInstancePrize
     */
    protected function getModelRaceInstancePrize()
    {
        return new \Models\RaceInstancePrize();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Season
     */
    public function getModelSeason()
    {
        return new \Models\Season();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Trainer
     */
    protected function getModelTrainer()
    {
        return new \Models\Trainer();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Selectors
     */
    protected function getModelSelectors()
    {
        return  DI::getDefault()->getService('selectors')->resolve();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\CourseDirections
     */
    protected function getModelCourseDirections()
    {
        return new \Models\CourseDirections();
    }

    /**
     * @param array $rows
     * @param string $fieldName
     *
     * @return array
     */
    protected function getFieldFromArrayOfRows(array $rows, $fieldName, callable $conditionCallback = null)
    {
        $result = [];

        foreach ($rows as $row) {
            if (is_null($conditionCallback) || call_user_func_array($conditionCallback, [$row])) {
                $result[] = $row->{$fieldName};
            }
        }

        return $result;
    }
}
