<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\DrawAnalyser;

class Runner extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'horse_uid' => 'id',
            '(fixAroHorseName)horse_name,country_origin_code' => 'name',
            'sequence' => 'runner_number',
            'draw' => 'stall',
            'y_norm_length' => 'advantage_length',
            'y_norm_pound' => 'advantage_lbs',
            'y_norm_going' => 'advantage_going',
        ];
    }
}
