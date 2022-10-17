<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 9/21/2016
 * Time: 6:44 PM
 */

namespace Api\Output\Mapper\OwnerProfile;

class RecordByRaceType extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'group_name' => 'group_name',
            'races_number' => 'races_number',
            'place_1st_number' => 'place_1st_number',
            'place_2nd_number' => 'place_2nd_number',
            'place_3rd_number' => 'place_3rd_number',
            'place_4th_number' => 'place_4th_number',
            '(roundNullable)win_prize,2' => 'win_prize',
            '(roundNullable)total_prize,2' => 'total_prize',
            '(roundNullable)euro_win_prize,2' => 'euro_win_prize',
            '(roundNullable)euro_total_prize,2' => 'euro_total_prize',
            '(roundNullable)net_win_prize_money,2' => 'net_win_prize_money',
            '(roundNullable)net_total_prize_money,2' => 'net_total_prize_money',
            '(getStake)' => 'stake',
            '(getPercent)place_1st_number,races_number' => 'win_percent',
            'horses' => 'horses',
            'winners' => 'winners',
            'placed' => 'placed',
            'best_horse_uid' => 'horse_uid',
            '(fixAroHorseName)best_horse_name,best_horse_country_origin_code' => 'horse_name',
            'best_rp_postmark' => 'best_rp_postmark',
        ];
    }
}
