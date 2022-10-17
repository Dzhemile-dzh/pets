<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 6/29/2017
 * Time: 5:42 PM
 */

namespace Api\Output\Mapper\Results;

class NextRunHeader extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'first_three' => 'first_three',
            'other' => 'also_rans',
            '(boolval)hot_race' => 'hot_race',
            '(boolval)cold_race' => 'cold_race',
            '(boolval)average_race' => 'average_race',
        ];
    }
}
