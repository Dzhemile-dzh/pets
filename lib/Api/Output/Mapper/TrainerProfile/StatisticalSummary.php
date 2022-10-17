<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\TrainerProfile;

class StatisticalSummary extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            '(dateISO8601)season_start_date' => 'season_start_date',
            '(dateISO8601)season_end_date' => 'season_end_date',
            'races_number' => 'races_number',
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
            '(getPercent)place_1st_number,races_number' => 'win_percent',
        ];
    }
}
