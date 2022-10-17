<?php

namespace Tests\Stubs\Models\Bo\Bloodstock\Dam;

class BloodstockSale extends \Phalcon\Mvc\Model
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenySales $request
     *
     * @return array
     */
    public function getProgenySales(
        \Api\Input\Request\Horses\Bloodstock\Dam\ProgenySales $request
    ) {
        $data = [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_date' => 'Nov 25 2001 12:00AM',
                    'lot_no' => 1272,
                    'horse_name' => 'Campestral',
                    'horse_sale_name' => 'CAMPESTRAL',
                    'horse_uid' => 63457,
                    'horse_age' => 13,
                    'seller_name' => 'From Seskin Stud',
                    'horse_yob' => 1988,
                    'horse_first_colour_code' => 'B',
                    'horse_second_colour_code' => null,
                    'horse_sex' => 'M',
                    'horse_country_origin_code' => 'USA',
                    'sire_uid' => 300048,
                    'sire_name' => 'Alleged',
                    'sire_country_origin_code' => 'USA',
                    'dam_uid' => 412046,
                    'dam_name' => 'Field Dancer',
                    'dam_country_origin_code' => 'GB',
                    'sire_of_dam_uid' => 301717,
                    'sire_of_dam_name' => 'Northfields',
                    'sire_of_dam_country_code' => 'USA',
                    'buyer_detail' => 'Maurice Burns',
                    'price' => 41000,
                    'price_gbp' => 34717,
                    'venue_desc' => 'GOFFS',
                    'venue_uid' => 3,
                    'currency' => 'IRG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_date' => 'Nov 26 2000 12:00AM',
                    'lot_no' => 1176,
                    'horse_name' => 'Arctic Splendour',
                    'horse_sale_name' => 'ARCTIC SPLENDOUR',
                    'horse_uid' => 71498,
                    'horse_age' => 11,
                    'seller_name' => 'From Broadfield Stud',
                    'horse_yob' => 1989,
                    'horse_first_colour_code' => 'B',
                    'horse_second_colour_code' => null,
                    'horse_sex' => 'M',
                    'horse_country_origin_code' => 'USA',
                    'sire_uid' => 300101,
                    'sire_name' => 'Arctic Tern',
                    'sire_country_origin_code' => 'USA',
                    'dam_uid' => 412046,
                    'dam_name' => 'Field Dancer',
                    'dam_country_origin_code' => 'GB',
                    'sire_of_dam_uid' => 301717,
                    'sire_of_dam_name' => 'Northfields',
                    'sire_of_dam_country_code' => 'USA',
                    'buyer_detail' => 'Newlands House Stud',
                    'price' => 16000,
                    'price_gbp' => 12800,
                    'venue_desc' => 'GOFFS',
                    'venue_uid' => 3,
                    'currency' => 'IRP',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_date' => 'Aug 21 2000 12:00AM',
                    'lot_no' => 235,
                    'horse_name' => 'Jazzie',
                    'horse_sale_name' => 'JAZZIE',
                    'horse_uid' => 569932,
                    'horse_age' => 1,
                    'seller_name' => 'From Haras de la Perrigne',
                    'horse_yob' => 1999,
                    'horse_first_colour_code' => 'CH',
                    'horse_second_colour_code' => null,
                    'horse_sex' => 'F',
                    'horse_country_origin_code' => 'FR',
                    'sire_uid' => 47214,
                    'sire_name' => 'Zilzal',
                    'sire_country_origin_code' => 'USA',
                    'dam_uid' => 412046,
                    'dam_name' => 'Field Dancer',
                    'dam_country_origin_code' => 'GB',
                    'sire_of_dam_uid' => 301717,
                    'sire_of_dam_name' => 'Northfields',
                    'sire_of_dam_country_code' => 'USA',
                    'buyer_detail' => 'Frederic Sauque',
                    'price' => 450000,
                    'price_gbp' => 43227,
                    'venue_desc' => 'DEAUVILLE',
                    'venue_uid' => 9,
                    'currency' => 'FFR',
                ]
            ),
        ];

        return $data;
    }
}
