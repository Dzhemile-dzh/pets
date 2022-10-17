<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards;

class Comments extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'horse_id' => 'horse_id',
            'spotlight' => 'spotlight',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'alt_silk_code' => 'alt_silk_code',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'diomed' => 'diomed'
        ];
    }
}
