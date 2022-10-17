<?php

namespace Api\Output\Mapper\JockeyProfile;

/**
 * Class Horses
 *
 * @package Api\Output\Mapper\JockeyProfile
 */
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
            '(roundNullable)win_prize,2' => 'win_prize',
            '(round)total_prize,2' => 'total_prize',
            '(roundNullable)euro_win_prize,2' => 'euro_win_prize',
            '(roundNullable)euro_total_prize,2' => 'euro_total_prize',
            '(roundNullable)net_win_prize_money,2' => 'net_win_prize_money',
            '(roundNullable)net_total_prize_money,2' => 'net_total_prize_money',
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
