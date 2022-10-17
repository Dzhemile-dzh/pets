<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceMeetings\Statistics;

class Owner extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'owner_uid' => 'owner_uid',
            'style_name' => 'style_name',
            'wins' => 'wins',
            'runs' => 'runs',
            '(getStake)' => 'stake'
        ];
    }
}
