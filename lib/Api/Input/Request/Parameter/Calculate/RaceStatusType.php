<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/30/2016
 * Time: 2:16 PM
 */

namespace Api\Input\Request\Parameter\Calculate;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;
use Bo\Profile\Course;

class RaceStatusType extends ByDefault
{
    const DEFAULT_COUNTRY_CODE = 'GB';
    const RACE_STATUS_BIG = 'big-race';
    const RACE_STATUS_ALL = 'all-races';

    private $raceStatusType;

    /**
     * @return string|null
     */
    public function getValue()
    {
        if ($this->getModelCourse()) {
            if (!$this->raceStatusType) {
                $profile = $this->getModelCourse()->getProfile($this->getRequest()->getId());

                $countryCode = $profile->country_code ?: self::DEFAULT_COUNTRY_CODE;
                $this->getRequest()->set('countryCode', $countryCode);

                $areBigRacesExist = $this->getModelCourse()->checkExistenceOfBigRaces(
                    $this->getRequest(),
                    $this->getRequest()->getSeasonDateBegin(),
                    $this->getRequest()->getSeasonDateEnd()
                );
                $this->raceStatusType = $areBigRacesExist ? self::RACE_STATUS_BIG : self::RACE_STATUS_ALL;
            }
            return $this->raceStatusType;
        }
    }

    /**
     * @return \Models\Bo\CourseProfile\Course
     */
    private function getModelCourse()
    {
        return $this->getRequest()->get(Course::MODEL_COURSE);
    }
}
