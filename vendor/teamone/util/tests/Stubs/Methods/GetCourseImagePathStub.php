<?php

namespace Test\Stubs\Methods;

/**
 * Class GetCourseImagePathStub
 * @package Test\Stubs\Methods
 */
class GetCourseImagePathStub
{
    public $country_code;
    public $course_uid;
    public $course_teaser_suffix;

    public function __construct($country_code_, $course_uid_, $course_teaser_suffix_)
    {
        $this->country_code         = $country_code_;
        $this->course_uid           = $course_uid_;
        $this->course_teaser_suffix = $course_teaser_suffix_;
    }

    use \RP\Util\Methods\GetCourseImagePath;
}
