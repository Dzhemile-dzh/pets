<?php

namespace Tests\Stubs\DataProvider\Bo\Bloodstock\SalesStatistics;

use \Phalcon\Mvc\Model\Row\General;
use Api\Input\Request\Horses\Bloodstock\SalesStatistics as Request;

/**
 * Class Sales
 *
 * @package Tests\Stubs\DataProvider\Bo\Bloodstock\SalesStatistics
 */
class Sales extends \Api\DataProvider\Bo\Bloodstock\SalesStatistics\Sales
{
    /**
     * @param Request\Sales $request
     *
     * @return array
     */
    public function getSales(Request\Sales $request)
    {
        return [
            0 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Francis Flood',
                'price' => 46000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            1 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Aiden Murphy (C Poste)',
                'price' => 46000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            2 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Joey Logan Bloodstock',
                'price' => 42000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            3 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Youngstars',
                'price' => 38000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            4 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Milestone Bloodstock',
                'price' => 38000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            5 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Ian Ferguson',
                'price' => 37000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'F',
                'horse_sex_flag' => 'F',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            6 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Kilronan',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            7 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Kilronan',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            8 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Warren Ewing',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            9 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'James O\'Rourke',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
        ];
    }
}
