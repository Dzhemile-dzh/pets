<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 9/2/2016
 * Time: 10:26 AM
 */

namespace Api\Output\Mapper\RaceCards;

class PressChallenge extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            '(getSilkImagePath)' => 'silk_image_path',
            'course_name' => 'course_name',
            'course_uid' => 'course_uid',
            'rp_abbrev_4' => 'course_abbrev',
            'bet_return' => 'bet_return_percent',
            '(strip_tags)newspaper' => 'newspaper',
            'tipster' => 'tipster',
            'wins' => 'wins',
            'runs' => 'runs',
            'strike_rate' => 'strike_rate',
            'favs_tipped' => 'favs_tipped_percent',
            '(trim)nap_time' => 'nap_time',
            'course' => 'course_name_abbrev',
            'nap_wins' => 'nap_wins',
            'nap_runs' => 'nap_runs',
            'profit_loss' => 'profit_loss',
            'curr_seq' => 'curr_seq',
            'month_wins' => 'month_wins',
            'month_runs' => 'month_runs',
            'month_profit_loss' => 'month_profit_loss',
            'bank' => 'bank'
        ];
    }
}
