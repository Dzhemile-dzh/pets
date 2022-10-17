<?php
namespace Api\Row\Methods;

/**
 * trait GetCourseImagePath
 *
 * @package RP\Util\Methods
 */
trait GetCourseImagePath
{
    /**
     * @param $countryCode
     * @param $courseUid
     * @param $courseStraightRoundJubileeCode
     * @param $courseRaceTypeCode
     * @return string
     */
    public function getCourseImagePath($countryCode, $courseUid, $courseStraightRoundJubileeCode, $courseRaceTypeCode)
    {
        $pathParts = [];

        if (!empty($countryCode)) {
            $pathParts[] = $countryCode;

            static $neededCountries = ['GB', 'IRE'];

            if (!empty($courseUid) && in_array($countryCode, $neededCountries)) {
                $pathParts[] = $courseUid;
            }

            $courseTeaserSuffix = $this->getCourseTeaserSuffix($countryCode, $courseUid, $courseStraightRoundJubileeCode, $courseRaceTypeCode);

            if (!empty($courseTeaserSuffix) && in_array($countryCode, $neededCountries)) {
                $pathParts[] = $courseTeaserSuffix;
            }
        }

        return implode('-', $pathParts);
    }

    public function getCourseTeaserSuffix($countryCode, $courseUid, $courseStraightRoundJubileeCode, $courseRaceTypeCode)
    {
        $suffix = '';

        if (!empty($countryCode)) {
            if ($countryCode == 'GB') {
                if ($courseUid == $this->getSecondTrackId()) {
                    $suffix = (strtolower($courseStraightRoundJubileeCode) == 'g') ? 'g' : 'm';
                } elseif ($courseRaceTypeCode == 'F') {
                    $suffix = 'f';
                } elseif ($courseRaceTypeCode == 'X') {
                    $suffix = 'x';
                } elseif (in_array($courseRaceTypeCode, ['B', 'H', 'C', 'U'])) {
                    $suffix = 'c';
                }
            } elseif ($countryCode == 'IRE') {
                $suffix = '';
            } else {
                $suffix = strtolower($countryCode);
            }
        }
        return $suffix;
    }

    protected function getSecondTrackId(){
        return 32;
    }
}
