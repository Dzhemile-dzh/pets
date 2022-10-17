<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/11/2016
 * Time: 12:10 PM
 */

namespace Api\Output\Mapper\Bloodstock\SalesStatistics;

class VendorsEntities extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'lot_no' => 'lot_no',
            'lot_letter' => 'lot_letter',
            'horse_uid' => 'horse_uid',
            'horse_style_name' => 'horse_style_name',
            'horse_first_colour_code' => 'horse_first_colour_code',
            'horse_sex' => 'horse_sex',
            'horse_age' => 'horse_age',
            'sire_uid' => 'sire_uid',
            'sire_style_name' => 'sire_style_name',
            'dam_uid' => 'dam_uid',
            'dam_style_name' => 'dam_style_name',
            'sire_of_dam_uid' => 'sire_of_dam_uid',
            'sire_of_dam_style_name' => 'sire_of_dam_style_name',
            'price_max' => 'price',
        ];
    }
}
