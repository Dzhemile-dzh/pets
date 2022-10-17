<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\TrainerProfile;

class StatisticsWithoutGroupId extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'category' => 'category',
            '(getNull)' => 'group_id',
            'group_name' => 'group_name',
            'rides' => 'rides',
            'wins' => 'wins',
            '(getPercent)wins,rides' => 'percent',
            '(getStake)' => 'stakes',
            'total_prize' => 'total_prize',
            'place_2nd_number' => 'place_2nd_number',
            'place_3rd_number' => 'place_3rd_number',
            'place_4th_number' => 'place_4th_number',
            'placed' => 'race_placed'
        ];
    }
}
