<?php
namespace RP\Util\Methods;

/**
 * trait GetCourseImagePath
 *
 * @package RP\Util\Methods
 */
trait GetCourseImagePath
{
    /**
     * @return string
     */
    public function getCourseImagePath()
    {
        $pathParts = [];

        if (!empty($this->country_code)) {
            $pathParts[] = $this->country_code;
        }

        if (!empty($this->course_uid)) {
            $pathParts[] = $this->course_uid;
        }

        if (!empty($this->course_teaser_suffix)) {
            $pathParts[] = $this->course_teaser_suffix;
        }

        return implode('-', $pathParts);
    }
}
