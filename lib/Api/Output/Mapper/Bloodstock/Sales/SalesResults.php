<?php
namespace Api\Output\Mapper\Bloodstock\Sales;

class SalesResults extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            '(fixAroHorseName)dam_style_name,dam_country_origin_code' => 'dam_style_name',
            '(fixAroHorseName)sire_style_name,sire_country_origin_code' => 'sire_style_name',
            '(fixAroHorseName)sire_of_dam_style_name,sire_of_dam_ctry_org_code' => 'sire_of_dam_style_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'horse_first_colour_code' => 'horse_first_colour_code',
            'horse_sex' => 'horse_sex',
            'horse_age' => 'horse_age',
            'sire_uid' => 'sire_uid',
            'sire_name' => 'sire_name',
            'sire_country_origin_code' => 'sire_country_origin_code',
            'dam_uid' => 'dam_uid',
            'dam_name' => 'dam_name',
            'dam_country_origin_code' => 'dam_country_origin_code',
            '(dateISO8601)dam_date_of_birth' => 'dam_date_of_birth',
            'sire_of_dam_uid' => 'sire_of_dam_uid',
            'sire_of_dam_name' => 'sire_of_dam_name',
            'sire_of_dam_ctry_org_code' => 'sire_of_dam_ctry_org_code',
            'venue_desc' => 'venue_desc',
            'venue_uid' => 'venue_uid',
            'sale_name' => 'sale_name',
            '(dateISO8601)sale_date' => 'sale_date',
            'seller_name' => 'seller_name',
            'catalogue_pedigree_pdf_url' => 'catalogue_pedigree_pdf_url',
            '(dbYNFlagToBoolean)entered' => 'entered',
            'entered_races' => 'entered_races',
            'lot_no' => 'lot_no',
            '(nullIfStringEmpty)lot_letter' => 'lot_letter',
            'price' => 'price',
            '(stringToFloat)lot_price' => 'lot_price',
            'currency' => 'currency',
            'buyer_detail' => 'buyer_detail',
            'yob' => 'yob',
            'sirecam_video_html' => 'sirecam_video_html'
        ];
    }
}
