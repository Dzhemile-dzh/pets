<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile\Statistics;

/**
 * Class Statistics
 *
 * @package Api\Output\Mapper\HorseProfile
 */
class Course extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'course_name' => 'course',
            'course_type_code' => 'course_type_code',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(stringToURLkey)course_name' => 'course_key',
            'course_comment' => 'course_comment',
            'starts_number' => 'starts_number',
            'place_1st_number' => 'place_1st_number',
            'place_2nd_number' => 'place_2nd_number',
            'place_3rd_number' => 'place_3rd_number',
            'win_prize' => 'win_prize',
            'total_prize' => 'total_prize',
            'euro_win_prize' => 'euro_win_prize',
            'euro_total_prize' => 'euro_total_prize',
            'best_rp_topspeed' => 'best_rp_topspeed',
            'best_rp_postmark' => 'best_rp_postmark',
            'net_total_prize' => 'net_total_prize',
            'net_win_prize' => 'net_win_prize'
        ];
    }
}
