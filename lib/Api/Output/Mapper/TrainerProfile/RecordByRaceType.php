<?php

namespace Api\Output\Mapper\TrainerProfile;

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
            '(getPercent)place_1st_number,races_number' => 'percent',
            'place_1st_number' => 'place_1st_number',
            'place_2nd_number' => 'place_2nd_number',
            'place_3rd_number' => 'place_3rd_number',
            'place_4th_number' => 'place_4th_number',
            'win_prize' => 'win_prize',
            'total_prize' => 'total_prize',
            'euro_win_prize' => 'euro_win_prize',
            'euro_total_prize' => 'euro_total_prize',
            'net_win_prize_money' => 'net_win_prize_money',
            'net_total_prize_money' => 'net_total_prize_money',
            '(getStake)' => 'stake',
            'horses' => 'horses',
            'winners' => 'winners',
            'placed' => 'placed',
            'best_horse_uid' => 'horse_uid',
            '(fixAroHorseName)best_horse_name,best_horse_country_origin_code' => 'horse_name',
            'best_rp_postmark' => 'best_rp_postmark',
        ];
    }
}
