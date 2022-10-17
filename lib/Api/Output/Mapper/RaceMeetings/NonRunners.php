<?php
namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper;
use Api\Methods\RemoveDotFromAwCourse;
use Api\Row\Methods\GetGoingDescription;

class NonRunners extends Mapper\HorsesMapper
{
    use RemoveDotFromAwCourse;
    use GetGoingDescription;
    use Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'mixed_course_uid' => 'mixed_course_uid',
            'rp_abbrev_3' => 'rp_abbrev_3',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'country_code' => 'country_code',
            '(getGoingDescription)race_status_code,md_going_desc,pmd_going_desc' => 'going_desc',
            'stalls_position' => 'stalls_position',
            '(removeAllExtraSymbols)weather_cond' => 'weather_cond',
            'races' => 'races',
        ];
    }
}
