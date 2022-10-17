<?php

namespace Bo\Profile;

use Api\Constants\Horses;
use RP\Util\Url;
use \Api\Exception\ValidationError;

/**
 * Class Course
 *
 * @package Bo\Profile
 */
class Course extends \Bo\Standart
{
    use \Api\Bo\Traits\AddVideoDetails;

    const MODEL_COURSE = 'course';
    const MODEL_RACE_INSTANCE = 'raceInstance';
    const COURSE_TYPE_CODE_BOTH = 'B';
    const RACE_TYPE_AW_CODES = ['W', 'X', 'Y', 'Z'];
    const RACE_TYPE_HUNTER_CODES = ['H', 'B'];
    const RACE_TYPE_CHASE_CODES = ['C', 'P', 'U'];
    const RACE_TYPE_FLAT_TURF_CODES = ['F'];

    /**
     * @var array
     */
    private static $mapsForRaceTypes = [
        'H' => 'h',
        'C' => 'ch',
        'U' => 'ch',
        'W' => 'aw',
        'X' => 'aw',
        'Y' => 'aw',
        'Z' => 'aw',
        'B' => '',
        'F' => ''
    ];

    /**
     * @param \Api\Input\Request\Horses\Profile $request
     *
     * @return static
     */
    public static function initByModel(\Api\Input\Request\Horses\Profile $request)
    {
        $bo = new static($request);

        $request->set(static::MODEL_COURSE, $bo->getModelCourse());
        $request->set(static::MODEL_RACE_INSTANCE, $bo->getModelRaceInstance());

        return $bo;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\CourseProfile\Course
     */
    protected function getModelCourse()
    {
        return new \Models\Bo\CourseProfile\Course();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\CourseProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\CourseProfile\RaceInstance();
    }

    /**
     * @return array
     */
    public function getUpcomingRaces()
    {
        return $this->getModelCourse()->getUpcomingRaces(
            $this->request->getCourseId()
        );
    }

    /**
     * @return array
     */
    public function getProfile()
    {
        return $this->getModelCourse()->getProfile(
            $this->request->getCourseId()
        );
    }

    /**
     * @return array|null
     */
    public function getPrincipleRaceResults()
    {
        $races = $this->getModelCourse()->getPrincipleRaceResults($this->request);

        if (is_null($races)) {
            return null;
        }
        $this->addVideoDetails($races);

        return array_values($races);
    }

    /**
     * @return \Object
     */
    public function getStatistics()
    {
        $topJockeys = $this->getModelRaceInstance()->getStatisticsTopJockeys($this->request);
        $topTrainers = $this->getModelRaceInstance()->getStatisticsTopTrainers($this->request);
        $topOwners = $this->getModelRaceInstance()->getStatisticsTopOwners($this->request);
        $topHorses = $this->getModelRaceInstance()->getStatisticsTopHorses($this->request);

        return (Object)[
            'top_jockeys' => (empty($topJockeys)) ? null : $topJockeys,
            'top_trainers' => (empty($topTrainers)) ? null : $topTrainers,
            'top_owners' => (empty($topOwners)) ? null : $topOwners,
            'top_horses' => (empty($topHorses)) ? null : $topHorses
        ];
    }

    /**
     * @return object
     */
    public function getStandardTimes()
    {
        $model = $this->getModelCourse();
        return $model->getRecordsForStandardTimes(
            $this->request->getCourseId(),
            $this->getModelSelectors()->getGroupedRaceTypeCodes()
        );
    }

    /**
     * @return array|null
     */
    public function getAdmission()
    {
        return $this->getModelCourse()->getAdmission($this->request);
    }

    /**
     * @return array|null
     */
    public function getDirections()
    {
        return $this->getModelCourse()->getDirections($this->request);
    }

    /**
     * @return array|null
     */
    public function getCourseMap()
    {
        $courseMaps = $this->getModelCourse()->getCourseMap($this->request->getCourseId());

        if (!empty($courseMaps)) {
            $courseMaps = $this->addMapImagePath($courseMaps);
            $courseMaps = $this->groupCourseMapByRaceTypeCode($courseMaps);
        } else {
            $courseMaps = null;
        }
        return $courseMaps;
    }

    /**
     * @param $absPart
     * @param $uriPart
     * @param $type
     *
     * @return string
     */
    private function prepareAbsoluteImagePath($absPart, $uriPart, $type)
    {
        return $absPart . 'course_maps/' . $type . '/' . $uriPart . '.jpg';
    }

    /**
     *
     * Race types:
     *
     * B    NH Flat
     * C    Chase Turf
     * F    Flat Turf
     * H    Hurdle Turf
     * P    Point-To-Point
     * U    Hunter Chase
     * W    NH Flat AW
     * X    Flat AW
     * Y    Hurdle AW
     * Z    Chase AW
     *
     * are mapped as:
     *
     * h - H
     * ch - C,U
     * aw - W,X,Y,Z
     * <empty> - B,F
     *
     * @param \Phalcon\Mvc\Model\Row[] $courseMaps
     *
     * @return \Phalcon\Mvc\Model\Row[]
     */
    public function addMapImagePath($courseMaps)
    {
        $conf = \Phalcon\DI::getDefault()->get('config');
        $absPart = (isset($conf->application->imagesurl))
            ? $conf->application->imagesurl . '/' : '';

        // adding exception into creating images for some courses
        if (count($courseMaps) > 0 && in_array($courseMaps[0]->course_uid, [38, 174])) {
            $imgExceptions = [
                38 => "newmarketrm",
                174 => "newmarketsj"
            ];

            foreach ($courseMaps as $key => $courseMap) {
                $courseMap->small_map_image_path =
                    $this->prepareAbsoluteImagePath(
                        $absPart,
                        $imgExceptions[$courseMap->course_uid],
                        'small'
                    );
                $courseMap->large_map_image_path =
                    $this->prepareAbsoluteImagePath(
                        $absPart,
                        $imgExceptions[$courseMap->course_uid],
                        'large'
                    );
            }
            return $courseMaps;
        }
        // course uid 4 => "bangor-on-deeh" - for this course only we want to leave any signs it contains
        if (count($courseMaps) > 0 && $courseMaps[0]->course_uid !== 4) {
            $imagePathPart1 = preg_replace(
                ['/-aw$/', '/-/'],
                ['', ''],
                Url::convertStringToUrlFormat($courseMaps[0]->course_name)
            );
        } else {
            $imagePathPart1 = Url::convertStringToUrlFormat($courseMaps[0]->course_name);
        }

        foreach ($courseMaps as $key => $courseMap) {
            $imagePathPart2 = $courseMap->country_code == 'IRE' ? '(ire)' : '';

            if (array_key_exists($courseMap->race_type_code, Course::$mapsForRaceTypes)) {
                $courseMap->small_map_image_path =
                    $this->prepareAbsoluteImagePath(
                        $absPart,
                        $imagePathPart1 . $imagePathPart2 . Course::$mapsForRaceTypes[$courseMap->race_type_code],
                        'small'
                    );
                $courseMap->large_map_image_path =
                    $this->prepareAbsoluteImagePath(
                        $absPart,
                        $imagePathPart1 . $imagePathPart2 . Course::$mapsForRaceTypes[$courseMap->race_type_code],
                        'large'
                    );
            } else {
                $courseMap->small_map_image_path = null;
                $courseMap->large_map_image_path = null;
            }
        }
        return $courseMaps;
    }

    /**
     * The method unites courses with certain race type codes.
     * Also method changes 'race_type_code' property [string -> array]
     * and writes codes such sources (courses that were united) to this field ('race_type_code')
     *
     * W,X,Y,Z  |  H,B  |  C,P,U  |  F
     *
     * @param \Phalcon\Mvc\Model\Row[] $rows
     *
     * @return \Phalcon\Mvc\Model\Row[]
     */
    private function groupCourseMapByRaceTypeCode(array $rows)
    {
        // different keys refer to the same object
        // we use this to group our entries
        $wxyz = array_fill_keys(self::RACE_TYPE_AW_CODES, new \stdClass());
        $hb = array_fill_keys(self::RACE_TYPE_HUNTER_CODES, new \stdClass());
        $cpu = array_fill_keys(self::RACE_TYPE_CHASE_CODES, new \stdClass());
        $f = array_fill_keys(self::RACE_TYPE_FLAT_TURF_CODES, new \stdClass());

        $aggregator = $wxyz + $hb + $cpu + $f;

        $rtn = [];
        $i = 0;

        foreach ($rows as $row) {
            $element = $aggregator[$row->race_type_code];
            if (isset($element->index)) {
                // We need only unique race_type_code. To achieve that we will set race_type_code as a key.
                // Later in mapper we will take only values of this array
                $rtn[$element->index]->race_type_code[$row->race_type_code] = $row->race_type_code;
            } else {
                $row->race_type_code = [$row->race_type_code => $row->race_type_code];
                $rtn[$i] = $row;
                $element->index = $i;
                $i++;
            }
        }
        return $rtn;
    }

    /**
     * @return mixed
     * @throws ValidationError
     */
    protected function getCourseDefaultValues()
    {
        if (!isset($this->courseDefaultValues)) {
            $this->courseDefaultValues = $this->getModelCourse()
                ->getDefaultValues($this->request);
            if (empty($this->courseDefaultValues)) {
                throw new ValidationError(13108);
            }
        }
        return $this->courseDefaultValues;
    }

    /**
     * @return string
     * @throws ValidationError
     */
    protected function getDefaultRaceType()
    {
        if (!isset($this->defaultRaceType)) {
            $this->defaultRaceType = $this->getCourseDefaultValues()['course_type_code'] == self::COURSE_TYPE_CODE_BOTH
                ?
                $this->getModelSelectors()->getRaceTypeKey(
                    $this->getModelRaceInstance()->getLastRaceTypeCode($this->request->getCourseId())
                )
                : $this->getModelSelectors()->getRaceTypeKey(
                    $this->getCourseDefaultValues()['course_type_code']
                );
        }
        return $this->defaultRaceType;
    }

    /**
     * @return array
     * @throws ValidationError
     */
    public function getSeasonsAvailable()
    {
        $course = $this->getModelCourse();
        $profile = $course->getProfile($this->request->getCourseId());

        if (empty($profile)) {
            throw new ValidationError(5101);
        }
        return $course->getSeasonsAvailable($this->request, $profile->country_code);
    }

    /**
     *
     * return object
     */
    public function getTopJockeys()
    {
        $result = $this->getModelCourse()->getTopJockeys($this->request, [], false);

        return $result[$this->request->getCourseId()]['race_types'] ?? [];
    }

    /**
     * @return object
     */
    public function getTopTrainers()
    {
        $result = $this->getModelCourse()->getTopTrainers($this->request);

        return $result[$this->request->getCourseId()]['race_types'] ?? [];
    }

    /**
     * @return object
     */
    public function getTopOwners()
    {
        $result = $this->getModelCourse()->getTopOwners($this->request);

        return $result[$this->request->getCourseId()]['race_types'] ?? [];
    }

    /**
     * @return mixed
     */
    public function getAverageTimes()
    {
        $times = $this->getModelCourse()->getAverageTimes($this->request, $this->getModelSelectors());
        $result = new \StdClass();

        if (isset($times)) {
            foreach ($times as $time) {
                $result->{$time->course_type}[] = $time;
            }
        }

        if (!isset($result->jumps)) {
            $result->jumps = null;
        }

        if (!isset($result->flat)) {
            $result->flat = null;
        }

        return $result;
    }
}
