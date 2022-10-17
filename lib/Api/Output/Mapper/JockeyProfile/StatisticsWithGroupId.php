<?php

namespace Api\Output\Mapper\JockeyProfile;

/**
 * Class StatisticsWithGroupId
 *
 * @package Api\Output\Mapper\JockeyProfile
 */
class StatisticsWithGroupId extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'category' => 'category',
            'group_id' => 'group_id',
            'group_name' => 'group_name',
            'rides' => 'rides',
            'wins' => 'wins',
            'place_2nd_number' => 'place_2nd_number',
            'place_3rd_number' => 'place_3rd_number',
            'place_4th_number' => 'place_4th_number',
            'placed' => 'race_placed',
            '(getPercent)wins,rides' => 'percent',
            '(getStake)' => 'stakes',
            '(roundNullable)total_prize,2' => 'total_prize',
        ];
    }
}
