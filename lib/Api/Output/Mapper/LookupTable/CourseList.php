<?php

namespace Api\Output\Mapper\LookupTable;

/**
 * @package Api\Output\Mapper\LookupTable
 */
class CourseList extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @inheritdoc
     */
    protected function getMap()
    {
        return [
            'course_uid'                       => 'course_uid',
            'style_name'                       => 'course_name',
            '(getCourseContinent)country_code' => 'course_region',
            'country_code'                     => 'country_code',
            'course_code'                      => 'course_code',
            'course_type_code'                 => 'course_type_code',
            'rp_abbrev_3'                      => 'rp_abbrev_3',
        ];
    }
}
