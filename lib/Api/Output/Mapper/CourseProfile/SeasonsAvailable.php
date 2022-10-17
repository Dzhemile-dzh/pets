<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/14/2016
 * Time: 4:39 PM
 */
namespace Api\Output\Mapper\CourseProfile;

class SeasonsAvailable extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'season_type' => 'season_type',
            '(dateISO8601)season_start_date' => 'season_start_date',
            '(dateISO8601)season_end_date' => 'season_end_date',
            'season_desc' => 'season_desc',
        ];
    }
}
