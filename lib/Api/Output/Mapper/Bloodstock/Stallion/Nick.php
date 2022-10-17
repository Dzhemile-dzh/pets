<?php

namespace Api\Output\Mapper\Bloodstock\Stallion;

/**
 * Class Nick
 *
 * @package Api\Output\Mapper\Bloodstock\Stallion
 */
class Nick extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'ancestor_uid' => 'horse_uid',
            '(fixAroHorseName)ancestor_name,ancestor_country_origin_code' => 'style_name',
            'runs' => 'runs',
            'wins' => 'wins',
            '(getPercent)wins,runs' => 'wins_percent',
            'runners' => 'runners',
            'winners' => 'winners',
            '(getPercent)winners,runners' => 'winners_percent',
            '(roundNullable)total_money,2' => 'total_money',
            '(roundNullable)win_prize_money,2' => 'win_prize_money',
            'descendants' => 'descendants',
        ];
    }
}
