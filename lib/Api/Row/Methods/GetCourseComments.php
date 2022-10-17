<?php

namespace Api\Row\Methods;

use Api\Constants\Horses as Constants;

trait GetCourseComments
{
    /**
     * Return the correct course comments
     * @param string $race_type_code
     * @param string $rp_jump_course_comment
     * @param string $rp_flat_course_comment
     * @return string
     */
    public function getCourseComments($race_type_code, $rp_jump_course_comment, $rp_flat_course_comment)
    {
        $result = $rp_jump_course_comment;

        if (in_array($race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)) {
            $result = $rp_flat_course_comment;
        }

        return $result;
    }
}
