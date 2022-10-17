<?php
namespace Api\Output\Mapper\Bloodstock\Dam;

class ProgenySales extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)sale_date' => 'sale_date',
            'lot_no' => 'lot_no',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,horse_country_origin_code' => 'horse_name',
            '(fixAroHorseName)horse_sale_name,horse_country_origin_code' => 'horse_sale_name',
            'horse_age' => 'horse_age',
            'horse_yob' => 'horse_yob',
            'horse_first_colour_code' => 'horse_first_colour_code',
            'horse_second_colour_code' => 'horse_second_colour_code',
            'horse_sex' => 'horse_sex',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'sire_uid' => 'sire_uid',
            '(fixAroHorseName)sire_name,sire_country_origin_code' => 'sire_name',
            'sire_country_origin_code' => 'sire_country_origin_code',
            'dam_uid' => 'dam_uid',
            '(fixAroHorseName)dam_name,dam_country_origin_code' => 'dam_name',
            'dam_country_origin_code' => 'dam_country_origin_code',
            'sire_of_dam_uid' => 'sire_of_dam_uid',
            '(fixAroHorseName)sire_of_dam_name,sire_of_dam_country_code' => 'sire_of_dam_name',
            'sire_of_dam_country_code' => 'sire_of_dam_country_origin_code',
            'buyer_detail' => 'buyer_detail',
            'price' => 'price',
            'price_gbp' => 'price_gbp',
            'venue_desc' => 'venue_desc',
            'venue_uid' => 'venue_uid',
            'currency' => 'cur_code',
            'seller_name' => 'vendor'
        ];
    }
}
