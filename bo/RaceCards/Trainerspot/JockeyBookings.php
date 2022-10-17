<?php

namespace Bo\RaceCards\Trainerspot;

use Bo\Standart;
use \Api\Input\Request\Horses\RaceCards\Trainerspot\JockeyBookings as InputRequest;
use \Api\DataProvider\Bo\RaceCards\Trainerspot\JockeyBookings as DataProvider;

/**
 * Class JockeyBookings
 *
 * @package Bo\RaceCards\Trainerspot
 */
class JockeyBookings extends Standart
{
    const LAST_4_YEARS = 4;
    const CURRENT_COURSE_SEASON = 'currentCourseSeason';
    const CURRENT_SEASON = 'currentSeason';
    const COURSE_5_SEASON = 'course5Season';
    const LAST_5_SEASON = 'last5Season';
    const PERCENT_LIMIT = 25;
    const WINS_LIMIT = 1;
    const PROFIT_LIMIT = 1;

    /**
     * RaceTrace constructor.
     *
     * @param InputRequest $request
     */
    public function __construct(InputRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     */
    public function getJockeyBookings()
    {
        $dataProvider = new DataProvider();
        $dataProvider->setRequest($this->getRequest());
        $todayRaces = $dataProvider->getTodayRaces();
        $raceType = $this->getRequest()->getRaceType();
        $baseStats = $dataProvider->getSeasonsStatsBase();

        $results = [];
        foreach ($todayRaces as $courseId => $todayData) {
            if (!array_key_exists($courseId, $baseStats)) {
                continue;
            }
            $course = new \stdClass();
            $course->course_uid = $courseId;
            $course->course_name = $todayData->course_name;
            $course->jockey_bookings = [];
            foreach ($todayData['jockeys'] as $jockeyId => $jockeyInfo) {
                if (!array_key_exists($jockeyId, $baseStats[$courseId]['jockeys'])) {
                    continue;
                }
                foreach ($jockeyInfo['trainers'] as $trainerId => $trainerInfo) {
                    if (!array_key_exists($trainerId, $baseStats[$courseId]['jockeys'][$jockeyId]['trainers'])) {
                        continue;
                    }
                    $stats = $baseStats[$courseId]['jockeys'][$jockeyId]['trainers'][$trainerId];
                    $curCourseSeason = $this->getSeasonData($stats, self::CURRENT_COURSE_SEASON);
                    $curSeason = $this->getSeasonData($stats, self::CURRENT_SEASON);
                    $course5Season = $this->getSeasonData($stats, self::COURSE_5_SEASON);
                    $last5Season = $this->getSeasonData($stats, self::LAST_5_SEASON);

                    if (empty($curCourseSeason) && empty($last5Season) && empty($curSeason) && empty($course5Season)) {
                        continue;
                    }
                    if ($this->compare([$curCourseSeason, $curSeason])) {
                        $curSeason = null;
                    }
                    if ($this->compare([$curCourseSeason, $course5Season])) {
                        $course5Season = null;
                    }
                    if ($this->compare([$last5Season, $curSeason]) || $this->compare([$last5Season, $course5Season])) {
                        $last5Season = null;
                    }

                    if (empty($curCourseSeason) && empty($last5Season) && empty($curSeason) && empty($course5Season)) {
                        continue;
                    }
                    $course->jockey_bookings[] = (object)[
                        'jockey_uid' => $jockeyInfo->jockey_uid,
                        'jockey_name' => $jockeyInfo->jockey_style_name,
                        'trainer_uid' => $trainerInfo->trainer_uid,
                        'trainer_name' => $trainerInfo->trainer_style_name,
                        'current_course_season' => $curCourseSeason,
                        'current_season' => $curSeason,
                        'course_5_season' => $course5Season,
                        'last_5_season' => $last5Season,
                        'runners' => $trainerInfo->runners
                    ];
                }
            }
            if (!empty($course->jockey_bookings)) {
                $results[$raceType][] = (object)$course;
            }
        }

        return $results;
    }

    /**
     * @param array $stats
     *
     * @return bool
     */
    private function compare($stats)
    {
        if (empty($stats[0]) || empty($stats[1])) {
            return false;
        }

        return ($stats[0]->wins == $stats[1]->wins
            && $stats[0]->runs == $stats[1]->runs
        );
    }

    /**
     * @param object $stats
     */
    protected function setPercents($stats)
    {
        $stats->percent = ($stats->runs > 0) ? (100 * $stats->wins / $stats->runs) : 0;
        $stats->percent5 = ($stats->runs5 > 0) ? (100 * $stats->wins5 / $stats->runs5) : 0;
        $stats->percentCourse = ($stats->runsCourse > 0) ? (100 * $stats->winsCourse / $stats->runsCourse) : 0;
        $stats->percentCourse5 = ($stats->runsCourse5 > 0) ? (100 * $stats->winsCourse5 / $stats->runsCourse5) : 0;
    }

    /**
     * @param object $data
     * @param string $seasonFlag
     *
     * @return null|object
     */
    protected function getSeasonData($data, $seasonFlag)
    {
        $res = null;

        switch ($seasonFlag) {
            case self::CURRENT_SEASON:
                $res = (Object)[
                    'wins' => $data->wins,
                    'runs' => $data->runs,
                    'stake' => $data->stake,
                    'percent' => ($data->runs > 0) ? (100 * $data->wins / $data->runs) : 0
                ];
                break;
            case self::LAST_5_SEASON:
                $res = (Object)[
                    'wins' => $data->wins5,
                    'runs' => $data->runs5,
                    'stake' => $data->stake5,
                    'percent' => ($data->runs5 > 0) ? (100 * $data->wins5 / $data->runs5) : 0
                ];
                break;
            case self::CURRENT_COURSE_SEASON:
                $res = (Object)[
                    'wins' => $data->winsCourse,
                    'runs' => $data->runsCourse,
                    'stake' => $data->stakeCourse,
                    'percent' => ($data->runsCourse > 0) ? (100 * $data->winsCourse / $data->runsCourse) : 0
                ];
                break;
            case self::COURSE_5_SEASON:
                $res = (Object)[
                    'wins' => $data->winsCourse5,
                    'runs' => $data->runsCourse5,
                    'stake' => $data->stakeCourse5,
                    'percent' => ($data->runsCourse5 > 0) ? (100 * $data->winsCourse5 / $data->runsCourse5) : 0
                ];
                break;
        }
        if ($res->stake < self::PROFIT_LIMIT
            || $res->wins <= self::WINS_LIMIT
            || $res->percent < self::PERCENT_LIMIT) {
            return null;
        }
        return $res;
    }
}
