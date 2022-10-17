<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 5/3/2017
 * Time: 1:45 PM
 */

namespace Api\Output\Mapper\GoingToSuit\RaceFlags;

class Horses extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            '(boolval)wins_flag' => 'wins_flag',
            '(boolval)rpr_flat_flag' => 'rpr_flat_flag',
            '(boolval)rpr_jumps_flag' => 'rpr_jumps_flag',
            '(boolval)topspeed_flag' => 'topspeed_flag',
            '(boolval)sire_flag' => 'sire_flag',
        ];
    }
}
