<?php

namespace Tests\Stubs\Bo;

/**
 * Class Results
 *
 * @package Tests\Stubs\Bo
 */
class Results extends \Bo\Results
{

    /**
     * @return \Tests\Stubs\Models\Bo\Results\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\Results\RaceInstance();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Results\HorseRace
     */
    public function getModelHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\Results\HorseRace();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Results\RaceAttribLookup
     */
    protected function getModelRaceAttribLookup()
    {
        return new \Tests\Stubs\Models\Bo\Results\RaceAttribLookup();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Results\RaceInstancePrize
     */
    protected function getModelRaceInstancePrize()
    {
        return new \Tests\Stubs\Models\Bo\Results\RaceInstancePrize();
    }


    /**
     * @return \Tests\Stubs\Models\Bo\Results\FastHorseRace
     */
    protected function getModelFastHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\Results\FastHorseRace();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Results\RaceInstanceTote
     */
    protected function getModelRaseInstanceTote()
    {
        return new \Tests\Stubs\Models\Bo\Results\RaceInstanceTote();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Results\HorseRace
     */
    protected function getModelHorseRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\Results\HorseRace();
    }

    /**
     * @return \Tests\Stubs\Models\CourseDirections
     */
    protected function getModelCourseDirections()
    {
        return new \Tests\Stubs\Models\CourseDirections();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Results\Courses
     */
    protected function getModelCourse()
    {
        return new \Tests\Stubs\Models\Bo\Results\Courses();
    }

    /**
     * @param array $raceIDs
     *
     * @return VideoProviders
     */
    protected function getVideoProviders($raceIDs)
    {
        return new \Tests\Stubs\Bo\VideoProviders($raceIDs);
    }
}
