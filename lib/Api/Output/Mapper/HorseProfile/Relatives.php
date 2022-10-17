<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

use RP\Util\Math\GetPercent;

class Relatives extends \Api\Output\Mapper\HorsesMapper
{
    use GetPercent;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'main_type' => 'main_type',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'country_origin_code' => 'country_origin_code',
            'h_yob' => 'horse_yob',
            'horse_sex_code' => 'horse_sex_code',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_style_name,sire_ctry_orig' => 'sire_style_name',
            'sire_ctry_orig' => 'sire_country_origin_code',
            'avg_flat_win_dist_of_progeny' => 'avg_flat_win_dist_of_progeny',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'runs' => 'runs',
            'wins' => 'wins',
            '(getPercent)wins,runs' => 'win_percent',
            'places' => 'places',
            'total_prize_money' => 'total_prize_money',
            'euro_total_prize' => 'euro_total_prize_money',
            'stakes_winner' => 'stakes_winner',
            '(intval)stakes_winner' => 'stakes_placed',
            '(boolval)stakes_winner' => 'stakes_winner_or_placed',
            'rp_postmark' => 'best_rp_postmark',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong',
        ];
    }
}
