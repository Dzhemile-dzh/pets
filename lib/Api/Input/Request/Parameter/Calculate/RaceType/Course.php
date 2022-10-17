<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/30/2016
 * Time: 12:33 PM
 */

namespace Api\Input\Request\Parameter\Calculate\RaceType;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;
use Bo\Profile\Course as BoCourse;

class Course extends ByDefault
{
    const RACE_TYPE_CODE_FLAT_AND_JUMP = 'B';

    private $raceType;

    /**
     * @return string|null
     */
    public function getValue()
    {
        if ($this->getModelCourse() && $this->getModelRaceInstance()) {
            if (!$this->raceType) {
                $raceTypeCode = $this->getModelCourse()->getDefaultValues($this->getRequest())['course_type_code'];
                if ($raceTypeCode === self::RACE_TYPE_CODE_FLAT_AND_JUMP) {
                    $defaultRaceType = $this->getRequest()->getSelectors()->getRaceTypeKey(
                        $this->getModelRaceInstance()->getLastRaceTypeCode($this->getRequest()->getCourseId())
                    );
                } else {
                    $defaultRaceType = $this->getRequest()->getSelectors()->getRaceTypeKey($raceTypeCode);
                }
                $this->raceType = $defaultRaceType;
            }
            return $this->raceType;
        }
    }

    /**
     * @return \Models\Bo\CourseProfile\Course
     */
    private function getModelCourse()
    {
        return $this->getRequest()->get(BoCourse::MODEL_COURSE);
    }

    /**
     * @return \Models\Bo\CourseProfile\RaceInstance
     */
    private function getModelRaceInstance()
    {
        return $this->getRequest()->get(BoCourse::MODEL_RACE_INSTANCE);
    }
}
