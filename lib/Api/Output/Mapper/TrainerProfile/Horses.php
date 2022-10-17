<?php

namespace Api\Output\Mapper\TrainerProfile;

class Horses extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'races_number' => 'races_number',
            'place_1st_number' => 'place_1st_number',
            'win_prize' => 'win_prize',
            '(setZeroIfEmpty)total_prize' => 'total_prize',
            'euro_win_prize' => 'euro_win_prize',
            'euro_total_prize' => 'euro_total_prize',
            'net_win_prize_money' => 'net_win_prize_money',
            'net_total_prize_money' => 'net_total_prize_money',
            '(getStake)' => 'stake',
            'rpr' => 'rpr',
            'owner_uid' => 'owner_uid',
            'owner_style_name' => 'owner_style_name',
            'owner_ptp_type_code' => 'owner_ptp_type_code',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_name',
        ];
    }
}
