<?php

namespace Tests\Stubs\DataProvider\Bo\LookupTable;

use Phalcon\Mvc\Model\Row\General;

/**
 * @package Tests\Stubs\DataProvider\Bo\HorseProfile
 */
class SalesVenues extends \Api\DataProvider\Bo\LookupTable\SalesVenues
{
    /**
     * @return array
     */
    public function getData()
    {
        return [
            General::createFromArray(
                [
                    "venue_uid" => 1,
                    "venue_desc" => "DBS (GNS)",
                    "currency_code" => "GBG",
                    "country_flag" => "E"
                ]
            ),
            General::createFromArray(
                [
                    "venue_uid" => 2,
                    "venue_desc" => "BRIGHTWELLS",
                    "currency_code" => "GBP",
                    "country_flag" => "E"
                ]
            ),
            General::createFromArray(
                [
                    "venue_uid" => 4,
                    "venue_desc" => "TATTERSALLS IRELAND",
                    "currency_code" => "EUR",
                    "country_flag" => "I"
                ]
            ),
        ];
    }
}
