<?php
namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper;

class TopJockeysCourse extends Mapper\HorsesMapper
{
    use Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(getCourseContinent)country_code' => 'course_region',
            'rp_abbrev_3' => 'rp_abbrev_3',
            'country_code' => 'country_code',
            'top_jockeys' => 'top_jockeys'
        ];
    }
}
