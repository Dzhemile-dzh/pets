<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/5/2016
 * Time: 11:04 AM
 */

namespace Tests\Stubs\DataProvider\Bo\Bloodstock\SalesStatistics;

use Api\Input\Request\Horses\Bloodstock\SalesStatistics\Sires as RequestSires;

class Sires extends \Api\DataProvider\Bo\Bloodstock\SalesStatistics\Sires
{
    public function getSires(RequestSires $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ACCLAMATION',
                    'sire_uid' => 541314,
                    'sire_style_name' => 'Acclamation',
                    'sire_country_origin_code' => 'GB',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Withdrawn',
                    'price' => null,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ACCLAMATION',
                    'sire_uid' => 541314,
                    'sire_style_name' => 'Acclamation',
                    'sire_country_origin_code' => 'GB',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Withdrawn',
                    'price' => null,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ACCLAMATION',
                    'sire_uid' => 541314,
                    'sire_style_name' => 'Acclamation',
                    'sire_country_origin_code' => 'GB',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Isabell Kreger',
                    'price' => 2500,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ALFRED NOBEL',
                    'sire_uid' => 731600,
                    'sire_style_name' => 'Alfred Nobel',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Karl Burke',
                    'price' => 21000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ALFRED NOBEL',
                    'sire_uid' => 731600,
                    'sire_style_name' => 'Alfred Nobel',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Nicholas Caullery',
                    'price' => 9000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ALHAARTH',
                    'sire_uid' => 99826,
                    'sire_style_name' => 'Alhaarth',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'F',
                    'buyer_detail' => 'Kenneth Slack',
                    'price' => 4000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'APPROVE',
                    'sire_uid' => 758138,
                    'sire_style_name' => 'Approve',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Withdrawn',
                    'price' => null,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ARCANO',
                    'sire_uid' => 733706,
                    'sire_style_name' => 'Arcano',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'F',
                    'buyer_detail' => 'Hazzaa Alzamay',
                    'price' => 1500,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ARCANO',
                    'sire_uid' => 733706,
                    'sire_style_name' => 'Arcano',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Withdrawn',
                    'price' => null,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ARCHIPENKO',
                    'sire_uid' => 660521,
                    'sire_style_name' => 'Archipenko',
                    'sire_country_origin_code' => 'USA',
                    'horse_sex_flag' => 'F',
                    'buyer_detail' => 'Michael Blanshard Racing',
                    'price' => 8000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'ARCHIPENKO',
                    'sire_uid' => 660521,
                    'sire_style_name' => 'Archipenko',
                    'sire_country_origin_code' => 'USA',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Withdrawn',
                    'price' => null,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'AZAMOUR',
                    'sire_uid' => 584911,
                    'sire_style_name' => 'Azamour',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'F',
                    'buyer_detail' => 'Oliver St Lawrence Bloodstock',
                    'price' => 6000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'AZAMOUR',
                    'sire_uid' => 584911,
                    'sire_style_name' => 'Azamour',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'F',
                    'buyer_detail' => 'BBA Ireland',
                    'price' => 9000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'AZAMOUR',
                    'sire_uid' => 584911,
                    'sire_style_name' => 'Azamour',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Charlie Mann',
                    'price' => 8000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'AZAMOUR',
                    'sire_uid' => 584911,
                    'sire_style_name' => 'Azamour',
                    'sire_country_origin_code' => 'IRE',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Derek Shaw Racing',
                    'price' => 22000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'BAHAMIAN BOUNTY',
                    'sire_uid' => 448003,
                    'sire_style_name' => 'Bahamian Bounty',
                    'sire_country_origin_code' => 'GB',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Kaloni OE',
                    'price' => 1000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'BAHAMIAN BOUNTY',
                    'sire_uid' => 448003,
                    'sire_style_name' => 'Bahamian Bounty',
                    'sire_country_origin_code' => 'GB',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Jim Culloty',
                    'price' => 4000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'BAHAMIAN BOUNTY',
                    'sire_uid' => 448003,
                    'sire_style_name' => 'Bahamian Bounty',
                    'sire_country_origin_code' => 'GB',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Mark Johnston Racing',
                    'price' => 14000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'BATED BREATH',
                    'sire_uid' => 739856,
                    'sire_style_name' => 'Bated Breath',
                    'sire_country_origin_code' => 'GB',
                    'horse_sex_flag' => 'F',
                    'buyer_detail' => 'Tim Lane',
                    'price' => 65000,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 2016,
                    'sire_name' => 'BERNSTEIN',
                    'sire_uid' => 511841,
                    'sire_style_name' => 'Bernstein',
                    'sire_country_origin_code' => 'USA',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'Colm Sharkey,Agent',
                    'price' => 6500,
                    'exchange_rate' => 0.95238,
                    'currency_code' => 'GNS',
                    'cur_code' => 'GBG',
                ]
            ),
        ];
    }
}
