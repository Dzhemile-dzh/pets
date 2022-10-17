<?php

namespace Api\Output\Mapper\Bloodstock\Stallion;

class ProgenyStatistics extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'category' => 'category',
            'no_of_runs' => 'runs',
            'no_of_wins' => 'wins',
            '(getPercent)no_of_wins,no_of_runs' => 'percent_wins_runs',
            'no_of_2nds' => 'place_2nd_number',
            'no_of_3rds' => 'place_3rd_number',
            'no_of_winners' => 'winners',
            'no_of_runners' => 'runners',
            '(getPercent)no_of_winners,no_of_runners' => 'percent_winners_runners',
            '(roundNullable)win_prize_money,2' => 'win_prize_money',
            '(roundNullable)total_prize_money,2' => 'total_prize_money',
            'broodmare_category' => 'broodmare_category'
        ];
    }
}
