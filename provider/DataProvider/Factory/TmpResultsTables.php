<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/6/2016
 * Time: 2:48 PM
 */

namespace Api\DataProvider\Factory;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Results\TmpTable\HorseRaceInstance;
use Api\DataProvider\Bo\Results\TmpTable\CourseRaceTime;

class TmpResultsTables
{
    /**
     * @var \Api\DataProvider\Bo\Results\TmpTable[]
     */
    private static $resultsCourseTables = [];

    /**
     * @var \Api\DataProvider\Bo\Results\TmpTable[]
     */
    private static $resultsInstanceTables = [];

    /**
     * @param int $raceId
     * @param bool $includeNonRunners
     * @return \Api\DataProvider\Bo\Results\TmpTable|mixed
     */
    public function getHorseRaceInstance($raceId, $includeNonRunners = false)
    {
        if (!isset(self::$resultsInstanceTables[$raceId])) {
            $instance = new HorseRaceInstance($includeNonRunners);
            $instance->setRaceId($raceId);
            self::$resultsInstanceTables[$raceId] = $instance;
        }
        return self::$resultsInstanceTables[$raceId]->getTmpTable();
    }

    /**
     * @param int $raceId
     * @return \Api\DataProvider\Bo\Results\TmpTable|mixed
     */
    public function getCourseRaceTime($raceId)
    {
        $key = $raceId . str_replace(', ', '_', Constants::FRENCH_COURSES);

        if (!isset(self::$resultsCourseTables[$key])) {
            $instance = new CourseRaceTime();
            $instance->setRaceId($raceId);
            self::$resultsCourseTables[$key] = $instance;
        }

        return self::$resultsCourseTables[$key]->getTmpTable();
    }
}
