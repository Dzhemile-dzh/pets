<?php

namespace Bo\RaceCards\Trainerspot;

use Bo\Standart;
use \Api\Input\Request\Horses\RaceCards\Trainerspot\CourseSpecialists as InputRequest;
use \Api\DataProvider\Bo\RaceCards\Trainerspot\CourseSpecialists as DataProvider;

/**
 * Class CourseSpecialists
 *
 * @package Bo\RaceCards\Trainerspot
 */
class CourseSpecialists extends Standart
{
    const CUR_SEASON = 'cur';
    const LAST_5_SEASONS = 'last5';
    const PERCENT_LIMIT = 25;
    const WINS_LIMIT = 1;

    /**
     * CourseSpecialists constructor.
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
    public function getCourseSpecialists()
    {
        $dataProvider = new DataProvider();
        $dataProvider->setRequest($this->getRequest());
        $todayRaces = $dataProvider->getTodayRaces();
        $seasonStats = $dataProvider->getSeasonsStats();
        $raceType = $this->getRequest()->getRaceType();

        $results = [];
        foreach ($todayRaces as $courseId => $courseStat) {
            $course = new \stdClass();
            $course->course_uid = $courseId;
            $course->course_name = $courseStat->course_name;
            $course->course_specialists = [];
            foreach ($courseStat['trainers'] as $trainerId => $trainerStat) {
                if (!array_key_exists($trainerId, $seasonStats[$courseId]['trainers'])) {
                    continue;
                }
                foreach ($trainerStat->description as $categoryId => $season) {
                    if (!array_key_exists($categoryId, $seasonStats[$courseId]['trainers'][$trainerId]->description)) {
                        continue;
                    }
                    $data = $seasonStats[$courseId]['trainers'][$trainerId]->description[$categoryId];
                    $data->percent = ($data->runs > 0) ? (100 * $data->wins / $data->runs) : 0;
                    $data->percent5 = ($data->runs5 > 0) ? (100 * $data->wins5 / $data->runs5) : 0;

                    if ($data->percent < $this::PERCENT_LIMIT) {
                        $this->resetSeasonData($data, $this::CUR_SEASON);
                    }
                    if ($data->percent5 < $this::PERCENT_LIMIT || $data->wins == $data->wins5) {
                        $this->resetSeasonData($data, $this::LAST_5_SEASONS);
                    }

                    if (!$this->isSeasonQualified($data)) {
                        continue;
                    }
                    $course->course_specialists[] = (object)[
                        'description' => $categoryId,
                        'trainer_uid' => $trainerStat->trainer_uid,
                        'trainer_name' => $trainerStat->trainer_style_name,
                        'current_season' => ($this->isSeasonQualified($data, $this::CUR_SEASON))
                            ? $this->getSeasonData($data, $this::CUR_SEASON)
                            : null,
                        'last_5_season' => (
                            $this->isSeasonQualified($data, $this::LAST_5_SEASONS)
                            && $data->wins5 != $data->wins
                        )
                            ? $this->getSeasonData($data, $this::LAST_5_SEASONS)
                            : null,
                        'runners' => $season->runners
                    ];
                }
            }
            if (!empty($course->course_specialists)) {
                $results[$raceType][] = (object)$course;
            }
        }

        return $results;
    }

    /**
     * @param object $data
     * @param string $seasonFlag
     *
     * @return null|object
     */
    protected function getSeasonData(&$data, $seasonFlag)
    {
        $res = null;
        if ($seasonFlag == $this::CUR_SEASON) {
            $res = (Object)[
                'wins' => $data->wins,
                'runs' => $data->runs,
                'stake' => $data->stake,
            ];
        } elseif ($seasonFlag == $this::LAST_5_SEASONS) {
            $res = (Object)[
                'wins' => $data->wins5,
                'runs' => $data->runs5,
                'stake' => $data->stake5,
            ];
        }
        return $res;
    }

    /**
     * @param object $data
     * @param string $seasonFlag
     */
    protected function resetSeasonData($data, $seasonFlag)
    {
        if ($seasonFlag == $this::CUR_SEASON) {
            $data->wins = 0;
            $data->runs = 0;
            $data->stake = 0.0;
        } elseif ($seasonFlag == $this::LAST_5_SEASONS) {
            $data->wins5 = 0;
            $data->runs5 = 0;
            $data->stake5 = 0.0;
        }
    }

    /**
     * @param array       $data
     * @param null|string $seasonFlag
     *
     * @return bool
     */
    protected function isSeasonQualified($data, $seasonFlag = null)
    {
        switch ($seasonFlag) {
            case $this::CUR_SEASON:
                $res = ($data->wins > $this::WINS_LIMIT && $data->percent >= $this::PERCENT_LIMIT);
                break;
            case $this::LAST_5_SEASONS:
                $res = ($data->wins5 > $this::WINS_LIMIT && $data->percent5 >= $this::PERCENT_LIMIT);
                break;
            default:
                $res = ($data->wins > $this::WINS_LIMIT || $data->wins5 > $this::WINS_LIMIT)
                    && ($data->percent >= $this::PERCENT_LIMIT || $data->percent5 >= $this::PERCENT_LIMIT);
                break;
        }
        return $res;
    }
}
