<?php

namespace Bo;

use Phalcon\Mvc\Model\Resultset\Utility\GroupResult;
use \Api\Constants\Horses as Constants;

/**
 * Class RaceMeetings
 *
 * @package Bo
 */
class RaceMeetings extends Profile
{
    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceMeetings\Course
     */
    protected function getDataProviderDefaultInfo()
    {
        return $this->getModelCourse();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceMeetings\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\RaceMeetings\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceMeetings\Course
     */
    public function getModelCourse()
    {
        return new \Models\Bo\RaceMeetings\Course();
    }
    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\CourseProfile\Course
     */
    protected function getModelCourseProfile()
    {
        return new \Models\Bo\CourseProfile\Course();
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
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceMeetings\CourseRecords
     */
    protected function getModelCourseRecords()
    {
        return new \Models\Bo\RaceMeetings\CourseRecords();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\RaceMeetings\SilksGen
     */
    protected function getSilksGenDataProvider()
    {
        return new \Api\DataProvider\Bo\RaceMeetings\SilksGen();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings
     */
    protected function getDailyRaceMeetingsDataProvider()
    {
        return new \Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings();
    }

    /**
     * @return General | null
     */
    public function getMeetingInfo()
    {
        $meetingInfo = $this->getModelCourse()->getMeetingInfo($this->request->getCourseId());

        if ($meetingInfo) {
            $courseDirections = $this->getModelCourseDirections()
                ->getCourseDirectionsByCourseId(
                    [$this->request->getCourseId()]
                );

            $meetingInfo->course_directions = isset($courseDirections[$this->request->getCourseId()])
                ? $courseDirections[$this->request->getCourseId()]
                : null;
        }

        return $meetingInfo;
    }

    /**
     * @return array
     */
    public function getFavourites()
    {
        $result = $this->getModelCourse()->getFavourites($this->request, $this->getModelSelectors());
        $rtn = $this->groupFavourites($result);
        return $rtn;
    }

    /**
     * @param $result
     *
     * @return array
     */
    private function groupFavourites($result)
    {
        $uniqueRaceId = [];
        $rtn = $this->createFavouritesDefaultReturn();

        foreach ($result as $value) {
            $handicapKey = $value->handicap_type;
            $groupKey = $value->group_by_value;

            $rtn[$handicapKey][$groupKey]->wins += $value['win'];

            if (!in_array($value->race_instance_uid, $uniqueRaceId)) {
                ++$rtn[$handicapKey][$groupKey]->runs;
                $uniqueRaceId[] = $value->race_instance_uid;
            }
            $rtn[$handicapKey][$groupKey]->stake += $value->profit_loss;
        }


        foreach ($rtn as $handicapType => $data) {
            foreach ($data as $groupType => $value) {
                if ($groupType == 'TOTAL') {
                    break;
                }
                $rtn[$handicapType]['TOTAL']->wins += $value->wins;
                $rtn[$handicapType]['TOTAL']->runs += $value->runs;
                $rtn[$handicapType]['TOTAL']->stake += $value->stake;
            }
        }

        return $rtn;
    }

    /**
     * @return array
     */
    private function createFavouritesDefaultReturn()
    {
        $keys = [
            'jumps' => [
                'HURDLE',
                'CHASE',
                'NHF',
                'TOTAL'
            ],
            'flat' => [
                '2YO',
                '3YO',
                '4YO+',
                'TOTAL'
            ]
        ];

        $default = ['handicap' => [], 'non_handicap' => []];

        if (!isset($keys[$this->request->getRaceType()])) {
            throw new \Exception("Default return doesn't contain a value for race type {$this->request->getRaceType()}");
        }

        foreach ($keys[$this->request->getRaceType()] as $val) {
            $default['handicap'][$val] = \Api\Row\RaceCards\Favourites::createFromArray(
                ['wins' => 0, 'runs' => 0, 'stake' => 0]
            );
            $default['non_handicap'][$val] = \Api\Row\RaceCards\Favourites::createFromArray(
                ['wins' => 0, 'runs' => 0, 'stake' => 0]
            );
        }

        return $default;
    }

    /**
     * @return object
     */
    public function getSignposts()
    {
        $courseId = $this->request->getCourseId();
        $raceDate = $this->request->getRaceDate();

        $sevenDayWinners = $this->getModelRaceInstance()->getSevenDayWinners($courseId, $raceDate);
        if (!empty($sevenDayWinners)) {
            $horseIds = array_map(
                function ($row) {
                    return $row->horse_uid;
                },
                $sevenDayWinners
            );
            $upcomingRaces = $this->getModelRaceInstance()->getUpcomingRace($horseIds, $this->request->getRaceDate());
            if (!empty($upcomingRaces)) {
                foreach ($sevenDayWinners as &$winner) {
                    $winner->upcoming_race = isset($upcomingRaces[$winner->horse_uid])
                        ? $upcomingRaces[$winner->horse_uid]
                        : null;
                }
                unset($winner);
            }
        }

        return (Object)[
            'travelers_check' => $this->getModelRaceInstance()->getTravelersCheck($courseId, $raceDate),
            'first_time_blinkers' => $this->getModelRaceInstance()->getFirstTimeBlinkers($courseId, $raceDate),
            'seven_day_winners' => $sevenDayWinners
        ];
    }

    /**
     * @return object
     * @throws \Exception
     */
    public function getStatistics()
    {
        $meetingInfo = $this->getModelCourse()->getMeetingInfo($this->request->getCourseId());
        $country = (isset($meetingInfo->country_code) && $meetingInfo->country_code == 'IRE')
            ? $meetingInfo->country_code : 'GB';

        $selectors = $this->getModelSelectors();
        $seasonTypeCode = $selectors->getSeasonTypeCode($country, $this->request->getRaceType());

        $seasonBeg = $selectors->getDb()->getSeasonDateBegin((int)date("Y", strtotime("-4 years")), $seasonTypeCode);
        $seasonEnd = $selectors->getDb()->getCurrentSeasonDateEnd($seasonTypeCode);

        $rtn = (Object)[
            'top_jockeys' => $this->getModelRaceInstance()->getStatisticsTopJockeys(
                $this->request,
                $seasonBeg,
                $seasonEnd
            ),
            'top_trainers' => $this->getModelRaceInstance()->getStatisticsTopTrainers(
                $this->request,
                $seasonBeg,
                $seasonEnd
            ),
            'top_owners' => $this->getModelRaceInstance()->getStatisticsTopOwners(
                $this->request,
                $seasonBeg,
                $seasonEnd
            ),
        ];
        return $rtn;
    }

    /**
     * @return object
     */
    public function getStandardTimes()
    {
        return (Object)[
            'flat_records' => $this->getModelCourseRecords()->getStandardTimesRecords(
                $this->request->getCourseId(),
                $this->getModelSelectors()->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS)
            ),
            'jumps_records' => $this->getModelCourseRecords()->getStandardTimesRecords(
                $this->request->getCourseId(),
                $this->getModelSelectors()->getRaceTypeCode(Constants::RACE_TYPE_JUMPS_ALIAS)
            ),
        ];
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General | null
     */
    public function getRunnersIndex()
    {
        return $this->getModelRaceInstance()->getRunnersIndexByDate(
            $this->request
        );
    }

    /**
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getNonRunners()
    {
        $nonRunners = $this->getModelRaceInstance()->getRunners($this->request);

        $groupResult = new GroupResult(['course_uid', 'race_instance_uid', 'horse_uid']);

        $data = $groupResult->getGroupedResult($nonRunners, [
            'course_uid',
            'mixed_course_uid',
            'rp_abbrev_3',
            'course_name',
            'course_style_name',
            'country_code',
            'pmd_going_desc',
            'md_going_desc',
            'stalls_position',
            'weather_cond',
            'races(\Phalcon\Mvc\Model\Row\General)' => [
                'race_datetime',
                'race_instance_uid',
                'race_instance_title',
                'race_status_code',
                'horses(\Api\Row\Results\Horse)' => [
                    'rp_owner_choice',
                    'owner_uid',
                    'horse_uid',
                    'horse_name',
                    'horse_style_name',
                    'horse_country_origin_code',
                    'trainer_name',
                    'trainer_uid',
                    'trainer_style_name',
                    'draw',
                    'race_number'
                ],
            ],
        ]);

        $result = $this->filterNonRunners($data);

        return $result;
    }

    /**
     * Will filter the races with non runners of the provided courses
     * If a course doesn't have races with non_runners, races value will be set to null
     * @param $data
     * @return array
     */
    private function filterNonRunners($data)
    {
        foreach ($data as $course_uid => &$course) {
            $hasFinishedRace = false;

            foreach ($course->races as $race_uid => &$race) {
                if (empty($race->race_instance_uid)) {
                    unset($data[$course_uid]['races'][$race_uid]);
                    continue;
                }

                if ($race->race_status_code == Constants::RACE_STATUS_RESULTS_STR) {
                    $hasFinishedRace = true;
                }
            }

            // If there are no races with non runners set the races value to null
            if (empty($course->races)) {
                $data[$course_uid]->races = null;
            }

            // We will use this race_status_code value in the mapper to determine the value of going_desc in the result
            $data[$course_uid]->race_status_code = $hasFinishedRace ? Constants::RACE_STATUS_RESULTS_STR : Constants::RACE_STATUS_OVERNIGHT_STR;
        }

        return $data;
    }

    public function getJockeyChanges()
    {
        $raceDate = $this->request->getRaceDate();
        $raceInstanceModel = $this->getModelRaceInstance();

        return [
            'jockey_changes' => $raceInstanceModel->getJockeyChanges($raceDate)
        ];
    }

    public function getSilksGen()
    {
        $fileType = $this->request->getType();

        return array_map(
            function ($value) use ($fileType) {
                return $value->getSilkImagePath($fileType);
            },
            $this->getSilksGenDataProvider()->getSilksGen($this->request)
        );
    }

    /**
     * @param string $entity Expected values are trainers or jockeys.
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getTopPerformanceInfoFor(string $entity): array
    {
        $getFunction = 'getTop' . ucfirst($entity);

        $requestedCourse = $this->request->getCourseId();

        $courses = $this->getDailyRaceMeetingsDataProvider()->getCourses($this->request->getRaceDate(), $requestedCourse);

        $courseUids = array_keys($courses);

        $topEntityPerformancePerCourse = $this->getModelCourseProfile()->{$getFunction}($this->request, $courseUids);
        foreach ($courses as $id => &$course) {
            if (isset($topEntityPerformancePerCourse[$id]->race_types) && !is_null($topEntityPerformancePerCourse[$id]->race_types)) {
                $course->{'top_' . $entity} = $topEntityPerformancePerCourse[$id]->race_types;
            } else {
                unset($courses[$id]);
            }
        }
        return $courses;
    }

    /**
     * @return array
     */
    public function getGoingChanges()
    {
        $raceDate = $this->request->getRaceDate();
        $raceInstanceModel = $this->getModelRaceInstance();

        return [
            'going_changes' => $raceInstanceModel->getGoingChanges($raceDate)
        ];
    }
}
