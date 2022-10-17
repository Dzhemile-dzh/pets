<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceMeetings;

class MeetingInfo extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    protected function getMap()
    {
        return [
            'rp_admission_prices' => 'rp_admission_prices',
            'rp_parking' => 'rp_parking',
            'rp_children' => 'rp_children',
            'rp_disabled' => 'rp_disabled',
            'rp_flat_course_comment' => 'rp_flat_course_comment',
            'rp_jump_course_comment' => 'rp_jump_course_comment',
            'course_stewards' => 'Peter Crafts, Lucinda Henson',
            'course_stewards_secs' => 'course_stewards_secs',
            'course_starters' => 'course_starters',
            'course_judge' => 'course_judge',
            'course_scales_clerk' => 'course_scales_clerk',
            'course_clerk' => 'course_clerk',
            'course_address' => 'course_address',
            'course_tel' => 'course_tel',
            'course_name' => 'course_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'course_type_code' => 'course_type_code',
            '(trim)country_code' => 'country_code',
            'course_directions' => 'course_directions'
        ];
    }
}
