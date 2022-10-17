<?php

namespace Api\Output\Mapper\Results\Courses;

use Api\Output\Mapper;

class Country extends Mapper\HorsesMapper
{
    use Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(trim)country_code' => 'country_code',
            'country_desc' => 'country_desc',
            '(getCourseContinent)country_code' => 'course_region',
            'courses'=>'courses'
        ];
    }
}
