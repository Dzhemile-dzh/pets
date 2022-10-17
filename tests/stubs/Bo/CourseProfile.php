<?php

namespace Tests\Stubs\Bo;

/**
 * Class CourseProfile
 *
 * @package Tests\Stubs\Bo
 */
class CourseProfile extends \Bo\Profile\Course
{
    /**
     * @return \Tests\Stubs\Models\Bo\CourseProfile\Course
     */
    protected function getModelCourse()
    {
        return new \Tests\Stubs\Models\Bo\CourseProfile\Course();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\CourseProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\CourseProfile\RaceInstance();
    }

    /**
     * @return \Models\Season
     *
     * @codeCoverageIgnore
     */
    public function getModelSeason()
    {
        return new \Tests\Stubs\Models\Season;
    }

    /**
     * @return array
     */
    public function getSeasonDefaultValues()
    {
        return [
            'seasonYearBegin' => 2015,
            'seasonYearEnd' => 2015,
            'raceType' => 'flat'
        ];
    }

    /**
     * @return \Tests\Stubs\Models\Selectors
     */
    protected function getModelSelectors()
    {
        $selectors = new \Models\Selectors();
        $selectors->setDb(new \Tests\Stubs\Models\Bo\Selectors\Database());
        return $selectors;
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
