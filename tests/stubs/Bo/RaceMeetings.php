<?php

namespace Tests\Stubs\Bo;

use Tests\Stubs\DataProvider\Bo\RaceMeetings\SilksGen;

class RaceMeetings extends \Bo\RaceMeetings
{
    /**
     * @return \Tests\Stubs\Models\Bo\RaceMeetings\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\RaceMeetings\RaceInstance();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceMeetings\Course
     */
    public function getModelCourse()
    {
        return new \Tests\Stubs\Models\Bo\RaceMeetings\Course();
    }

    /**
     * @return \Tests\Stubs\Models\CourseDirections
     */
    protected function getModelCourseDirections()
    {
        return new \Tests\Stubs\Models\CourseDirections();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceMeetings\Database
     */
    protected function getModelSelectors()
    {
        $selectors = new \Models\Selectors();
        $selectors->setDb(new \Tests\Stubs\Models\Bo\RaceMeetings\Database());
        return $selectors;
    }

    /**
     * @return \Tests\Stubs\Models\Bo\RaceMeetings\CourseRecords
     */
    protected function getModelCourseRecords()
    {
        return new \Tests\Stubs\Models\Bo\RaceMeetings\CourseRecords();
    }

    /**
     * @return SilksGen
     */
    protected function getSilksGenDataProvider()
    {
        return new SilksGen();
    }
}
