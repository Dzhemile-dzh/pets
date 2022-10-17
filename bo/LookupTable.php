<?php

namespace Bo;

class LookupTable extends Standart
{
    /**
     * @return \Models\Bo\LookupTable\GoingType
     *
     * @codeCoverageIgnore
     */
    protected function getModelGoingType()
    {
        return new \Models\Bo\LookupTable\GoingType();
    }

    /**
     * @return array
     */
    public function getGoingTypeTable()
    {
        return $this->getModelGoingType()->getGoingTypeTable();
    }

    /**
     * @return \Models\Bo\LookupTable\AdditionalCourseInfo
     *
     * @codeCoverageIgnore
     */
    protected function getModelAdditionalCourseInfo()
    {
        return new \Models\Bo\LookupTable\AdditionalCourseInfo();
    }

    /**
     * @return array
     */
    public function getAdditionalCourseInfoTable()
    {
        return $this->getModelAdditionalCourseInfo()->getAdditionalCourseInfoTable($this->request->getStraightRoundJubileeCode());
    }

    /**
     * @return \Models\Bo\LookupTable\RaceType
     *
     * @codeCoverageIgnore
     */
    protected function getModelRaceType()
    {
        return new \Models\Bo\LookupTable\RaceType();
    }

    /**
     * @return array
     */
    public function getRaceTypeTable()
    {
        return $this->getModelRaceType()->getRaceTypeTable();
    }

    /**
     * @return \Models\Bo\LookupTable\RaceType
     *
     * @codeCoverageIgnore
     */
    protected function getModelCourseType()
    {
        return new \Models\Bo\LookupTable\CourseType();
    }

    /**
     * @return \Models\Bo\LookupTable\RaceOutcome
     *
     * @codeCoverageIgnore
     */
    protected function getModelRaceOutcome()
    {
        return new \Models\Bo\LookupTable\RaceOutcome();
    }

    /**
     * @return array
     */
    public function getCourseTypeTable()
    {
        return $this->getModelCourseType()->getCourseTypeTable();
    }

    /**
     * @return array
     */
    public function getRaceOutcomeTable()
    {
        return $this->getModelRaceOutcome()->getRaceOutcomeTable();
    }

    /**
     * @return \Models\Bo\LookupTable\Country
     *
     * @codeCoverageIgnore
     */
    protected function getModelCountry()
    {
        return new \Models\Bo\LookupTable\Country();
    }

    /**
     * @return array
     */
    public function getCountryTable()
    {
        return $this->getModelCountry()->getCountryTable();
    }

    /**
     * @return \Models\Bo\LookupTable\HorseColour
     *
     * @codeCoverageIgnore
     *
     */
    protected function getModelHorseColour()
    {
        return new \Models\Bo\LookupTable\HorseColour();
    }

    /**
     * @return array
     */
    public function getHorseColourTable()
    {
        return $this->getModelHorseColour()->getHorseColourTable();
    }

    /**
     * @return \Models\Bo\LookupTable\HorseSex
     */
    protected function getModelHorseSex()
    {
        return new \Models\Bo\LookupTable\HorseSex();
    }

    /**
     * @return array
     */
    public function getHorseSexTable()
    {
        return $this->getModelHorseSex()->getHorseSexTable();
    }

    /**
     * @return array
     */
    public function getMeetingColoursLookupTable()
    {
        return $this->getModelMeetingColoursLookup()->getMeetingColoursLookupTable();
    }

    /**
     * @return \Models\Bo\LookupTable\MeetingColoursLookup
     */
    protected function getModelMeetingColoursLookup()
    {
        return new \Models\Bo\LookupTable\MeetingColoursLookup();
    }

    /**
     * @return \Models\Bo\LookupTable\Odds
     */
    protected function getModelOdds()
    {
        return new \Models\Bo\LookupTable\Odds();
    }

    /**
     * @return array
     */
    public function getOddsTable()
    {
        return $this->getModelOdds()->getOddsTable();
    }
}
