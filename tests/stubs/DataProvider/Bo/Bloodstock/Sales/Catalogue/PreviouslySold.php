<?php
namespace Tests\Stubs\DataProvider\Bo\Bloodstock\Sales\Catalogue;

use Api\Input\Request\Horses\Bloodstock\Sales\CataloguePreviouslySold;

class PreviouslySold extends \Api\DataProvider\Bo\Bloodstock\Sales\Catalogue\PreviouslySold
{
    public function getPreviouslySold(CataloguePreviouslySold $request)
    {
        return [
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'current_lot_number' => 6,
                    'current_lot_letter' => "A",
                    'previous_lot_number' => 519,
                    'previous_lot_letter' => "A",
                    'horse_name' => 'Durango Dan',
                    'horse_country_origin_code' => 'USA',
                    'horse_year_of_born' => 2014,
                    'colour' => null,
                    'horse_sex' => 'C',
                    'sire_uid' => 513047,
                    'sire_style_name' => 'Giant\'s Causeway',
                    'dam_uid' => 680506,
                    'dam_style_name' => 'Ballado\'s Thunder',
                    'price' => null,
                    'price_gbp' => null,
                    'sale_name' => 'Ocala Breeders\' Sales Company 2016 Spring Sale of',
                    'current_seller_name' => 'De Meric Sales',
                    'previous_seller_name' => 'De Meric Sales',
                    'buyer_detail' => 'Withdrawn',
                    'venue_uid' => '5',
                    'sale_date' => '2017-05-05T00:00:00+01:00',
                    'currency' => 'USD',
                ]
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'current_lot_number' => 8,
                    'current_lot_letter' => "A",
                    'previous_lot_number' => 521,
                    'previous_lot_letter' => "A",
                    'horse_name' => null,
                    'horse_country_origin_code' => 'USA',
                    'horse_year_of_born' => 2014,
                    'colour' => null,
                    'horse_sex' => 'C',
                    'sire_uid' => 600985,
                    'sire_style_name' => 'Malibu Moon',
                    'dam_uid' => 770316,
                    'dam_style_name' => 'Banker\'s Buy',
                    'price' => null,
                    'price_gbp' => null,
                    'sale_name' => 'Ocala Breeders\' Sales Company 2016 Spring Sale of',
                    'current_seller_name' => 'Scanlon Training & Sales',
                    'previous_seller_name' => 'Scanlon Training & Sales',
                    'buyer_detail' => 'Withdrawn',
                    'venue_uid' => '5',
                    'sale_date' => '2017-05-05T00:00:00+01:00',
                    'currency' => 'USD',
                ]
            ),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'current_lot_number' => 19,
                    'current_lot_letter' => "A",
                    'previous_lot_number' => 529,
                    'previous_lot_letter' => "A",
                    'horse_name' => 'Cotton Up',
                    'horse_country_origin_code' => 'USA',
                    'horse_year_of_born' => 2014,
                    'colour' => null,
                    'horse_sex' => 'C',
                    'sire_uid' => 645164,
                    'sire_style_name' => 'High Cotton',
                    'dam_uid' => 762661,
                    'dam_style_name' => 'Because I Like It',
                    'price' => 20000,
                    'price_gbp' => '13605.442176870748299',
                    'sale_name' => 'Ocala Breeders\' Sales Company 2016 Spring Sale of',
                    'current_seller_name' => 'Coastal Equine',
                    'previous_seller_name' => 'Coastal Equine',
                    'buyer_detail' => 'Not Sold',
                    'venue_uid' => '5',
                    'sale_date' => '2017-05-05T00:00:00+01:00',
                    'currency' => 'USD',
                ]
            ),
            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'current_lot_number' => 21,
                    'current_lot_letter' => "A",
                    'previous_lot_number' => 530,
                    'previous_lot_letter' => "A",
                    'horse_name' => null,
                    'horse_country_origin_code' => 'USA',
                    'horse_year_of_born' => 2014,
                    'colour' => null,
                    'horse_sex' => 'F',
                    'sire_uid' => 542711,
                    'sire_style_name' => 'Broken Vow',
                    'dam_uid' => 893061,
                    'dam_style_name' => 'Bekagi',
                    'price' => 57000,
                    'price_gbp' => '38775.510204081632653',
                    'sale_name' => 'Ocala Breeders\' Sales Company 2016 Spring Sale of',
                    'current_seller_name' => 'Woodford Thoroughbreds',
                    'previous_seller_name' => 'Shooshie Stables',
                    'buyer_detail' => 'Not Sold',
                    'venue_uid' => '5',
                    'sale_date' => '2017-05-05T00:00:00+01:00',
                    'currency' => 'USD',
                ]
            ),
        ];
    }
}
