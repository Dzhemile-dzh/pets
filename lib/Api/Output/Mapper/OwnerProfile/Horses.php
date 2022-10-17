<?php
/**
 * Created by PhpStorm.
 * User: Kateryna_Vozniuk
 * Date: 2/13/2015
 * Time: 12:12 PM
 */

namespace Api\Output\Mapper\OwnerProfile;

class Horses extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'races_number' => 'races_number',
            'place_1st_number' => 'place_1st_number',
            'win_prize' => 'win_prize',
            'total_prize' => 'total_prize',
            'euro_win_prize' => 'euro_win_prize',
            'euro_total_prize' => 'euro_total_prize',
            'net_win_prize_money' => 'net_win_prize_money',
            'net_total_prize_money' => 'net_total_prize_money',
            '(getStake)' => 'stake',
            'rpr' => 'rpr',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_name',
            'trainer_ptp_type_code' => 'trainer_ptp_type_code',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_name',
        ];
    }
}
