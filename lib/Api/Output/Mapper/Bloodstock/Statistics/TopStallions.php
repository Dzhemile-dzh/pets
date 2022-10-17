<?php

namespace Api\Output\Mapper\Bloodstock\Statistics;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class TopStallions
 *
 * @package Api\Output\Mapper\Bloodstock\Statistics
 */
class TopStallions extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            'no_of_wins' => 'wins',
            'no_of_runs' => 'runs',
            'no_of_2nds' => 'place_2nd_number',
            'no_of_3rds' => 'place_3rd_number',
            'no_of_4ths' => 'place_4th_number',
            '(roundNullable)win_prize_money,2' => 'win_prize_money',
            '(roundNullable)total_prize_money,2' => 'total_prize_money',
            'no_of_winners' => 'winners',
            'no_of_runners' => 'runners',
            'progeny_performers' => 'progeny_performers',
        ];
    }
}
