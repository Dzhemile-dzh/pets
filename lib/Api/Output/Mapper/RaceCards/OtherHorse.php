<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards;

class OtherHorse extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            'horse_uid' => 'horse_uid',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
        ];
    }
}
