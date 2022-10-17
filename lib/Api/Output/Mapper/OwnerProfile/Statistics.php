<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/10/2015
 * Time: 4:25 PM
 */

namespace Api\Output\Mapper\OwnerProfile;

class Statistics extends \Api\Output\Mapper\HorsesMapper
{

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
            'total_prize' => 'total_prize',
        ];
    }
}
