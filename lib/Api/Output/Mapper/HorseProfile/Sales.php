<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 7/16/2015
 * Time: 3:13 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class Sales extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            "buyer_detail" => "buyer_detail",
            "price" => "price",
            "(dateISO8601)sale_date" => "sale_date",
            "venue_desc" => "venue_desc",
            "venue_uid" => "venue_uid",
            "lot_no" => "lot_no",
            "(trim)lot_letter" => "lot_letter",
            "seller_name" => "seller_name",
            "cur_code" => "cur_code",
            "sale_name" => "sale_name",
            "abbrev_name" => "abbrev_name",
            'sale_type' => 'sale_type'
        ];
    }
}
