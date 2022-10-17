<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/6/2016
 * Time: 4:59 PM
 */

namespace Api\Output\Mapper\RaceCards\TenYearTrends;

class Jockeys extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_name' => 'jockey_name',
            'wins' => 'wins',
            'placed' => 'placed',
            'rides' => 'rides',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_name',
            '(getSilkImagePath)' => 'silk_image_path',
        ];
    }
}
