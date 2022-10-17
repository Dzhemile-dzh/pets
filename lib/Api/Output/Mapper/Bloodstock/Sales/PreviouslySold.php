<?php
namespace Api\Output\Mapper\Bloodstock\Sales;

use Api\Output\Mapper\HorsesMapper;

class PreviouslySold extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'venue_uid' => 'venue_uid',
            '(dateISO8601)sale_date' => 'sale_date',
            'current_lot_number' => 'current_lot_number',
            'current_lot_letter' => 'current_lot_letter',
            'previous_lot_number' => 'previous_lot_number',
            'previous_lot_letter' => 'previous_lot_letter',
            'horse_name' => 'horse_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'horse_year_of_born' => 'horse_year_of_born',
            'colour' => 'colour',
            'horse_sex' => 'sex',
            'sire_uid' => 'sire_uid',
            'sire_style_name' => 'sire_style_name',
            'dam_uid' => 'dam_uid',
            'dam_style_name' => 'dam_style_name',
            'price' => 'price',
            '(roundNullable)price_gbp,2' => 'price_gbp',
            'currency' => 'currency',
            'sale_name' => 'sale_name',
            'current_seller_name' => 'current_vendor',
            'previous_seller_name' => 'vendor',
            'buyer_detail' => 'buyer_detail',
        ];
    }
}
