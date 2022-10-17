<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/7/2016
 * Time: 12:00 PM
 */

namespace Api\Output\Mapper\HorseTracker;

class Entry extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'horse_style_name' => 'horse_style_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'horse_age' => 'horse_age',
            'sire_uid' => 'sire_uid',
            'sire_horse_name' => 'sire_horse_name',
            'sire_style_name' => 'sire_style_name',
            'dam_uid' => 'dam_uid',
            'dam_horse_name' => 'dam_horse_name',
            'dam_style_name' => 'dam_style_name',
            'races' => 'races',
        ];
    }
}
