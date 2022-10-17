<?php

namespace Tests\Stubs\Bo;

class LookupTable extends \Bo\LookupTable
{
    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\GoingType
     */
    protected function getModelGoingType()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\GoingType();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\RaceOutcome
     */
    protected function getModelRaceOutcome()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\RaceOutcome();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\RaceType
     */
    protected function getModelRaceType()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\RaceType();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\CourseType
     */
    protected function getModelCourseType()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\CourseType();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\Country
     */
    protected function getModelCountry()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\Country();
    }

    /**
     * @return \Models\Bo\LookupTable\HorseColour|\Tests\Stubs\Models\Bo\LookupTable\HorseColour
     */
    protected function getModelHorseColour()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\HorseColour();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\HorseSex
     */
    protected function getModelHorseSex()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\HorseSex();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\MeetingColoursLookup
     */
    protected function getModelMeetingColoursLookup()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\MeetingColoursLookup();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\Odds
     */
    protected function getModelOdds()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\Odds();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\LookupTable\AdditionalCourseInfo
     */
    protected function getModelAdditionalCourseInfo()
    {
        return new \Tests\Stubs\Models\Bo\LookupTable\AdditionalCourseInfo();
    }
}
