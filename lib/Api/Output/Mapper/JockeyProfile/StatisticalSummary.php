<?php

namespace Api\Output\Mapper\JockeyProfile;

/**
 * Class StatisticalSummary
 *
 * @package Api\Output\Mapper\JockeyProfile
 */
class StatisticalSummary extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
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
            '(roundNullable)win_prize,2' => 'win_prize',
            '(roundNullable)total_prize,2' => 'total_prize',
            '(roundNullable)euro_win_prize,2' => 'euro_win_prize',
            '(roundNullable)euro_total_prize,2' => 'euro_total_prize',
            '(roundNullable)net_win_prize_money,2' => 'net_win_prize_money',
            '(roundNullable)net_total_prize_money,2' => 'net_total_prize_money',
            '(getStake)' => 'stake',
            '(getPercent)place_1st_number,races_number' => 'win_percent',
        ];
    }
}
