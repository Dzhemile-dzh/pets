<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/27/2016
 * Time: 3:36 PM
 */

namespace Tests\Stubs\Models\Bo\Bloodstock\StallionStatistics;

use Api\Input\Request\Horses\Bloodstock\Statistics as Request;

class Horses extends \Models\Bo\Bloodstock\StallionStatistics\Horses
{
    use \Tests\Stubs\Models\StubDataGetter;

    private $key;

    /**
     * @return mixed
     */
    protected function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    protected function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param Request\TopStallions $request
     *
     * @return mixed
     */
    public function createStallionsTmpTable(Request\TopStallions $request)
    {
        $key = self::getRequestKey($request);
        $this->setKey($key);

        return true;
    }

    public function dropStallionsTmpTables()
    {
        return true;
    }

    /**
     * @param Request\TopStallions $request
     *
     * @return mixed
     */
    public function getTopStallions(Request\TopStallions $request)
    {
        $data = [
            '2012_Worldwide G1_FR_3' => array(
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'style_name' => 'Deep Impact',
                        'country_origin_code' => 'JPN',
                        'horse_uid' => 636099,
                        'no_of_wins' => 6,
                        'no_of_runs' => 52,
                        'no_of_2nds' => 7,
                        'no_of_3rds' => 5,
                        'no_of_4ths' => 2,
                        'win_prize_money' => 6684607.0499999998,
                        'total_prize_money' => 10700495.01,
                        'no_of_winners' => 3,
                        'no_of_runners' => 29,
                    )
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'style_name' => 'Stay Gold',
                        'country_origin_code' => 'JPN',
                        'horse_uid' => 476873,
                        'no_of_wins' => 4,
                        'no_of_runs' => 22,
                        'no_of_2nds' => 5,
                        'no_of_3rds' => 1,
                        'no_of_4ths' => 1,
                        'win_prize_money' => 5174645.4199999999,
                        'total_prize_money' => 9210697.7300000004,
                        'no_of_winners' => 2,
                        'no_of_runners' => 11,
                    )
                ),
            ),
            '2016_First Crop_GB_IRE_1' => array(
                0 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'style_name' => 'Sir Prancealot',
                            'country_origin_code' => 'IRE',
                            'horse_uid' => 800166,
                            'no_of_wins' => 42,
                            'no_of_runs' => 346,
                            'no_of_2nds' => 37,
                            'no_of_3rds' => 42,
                            'no_of_4ths' => 38,
                            'win_prize_money' => 367371.34000000003,
                            'total_prize_money' => 532221.83999999997,
                            'no_of_winners' => 28,
                            'no_of_runners' => 70,
                        )
                    ),
                1 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'style_name' => 'Frankel',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 763453,
                            'no_of_wins' => 22,
                            'no_of_runs' => 66,
                            'no_of_2nds' => 5,
                            'no_of_3rds' => 8,
                            'no_of_4ths' => 9,
                            'win_prize_money' => 255960.23999999999,
                            'total_prize_money' => 364586.67999999999,
                            'no_of_winners' => 15,
                            'no_of_runners' => 29,
                        )
                    ),
                2 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'style_name' => 'Mayson',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 756946,
                            'no_of_wins' => 22,
                            'no_of_runs' => 173,
                            'no_of_2nds' => 34,
                            'no_of_3rds' => 24,
                            'no_of_4ths' => 12,
                            'win_prize_money' => 140137.92999999999,
                            'total_prize_money' => 357090.71000000002,
                            'no_of_winners' => 15,
                            'no_of_runners' => 44,
                        )
                    ),
            ),
        ];

        return $data[$this->getKey()];
    }

    public function getYearlings(Request\Yearlings $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 1991,
                    'sire_name' => 'ASCOT KNIGHT',
                    'style_name' => 'Ascot Knight',
                    'country_origin_code' => 'CAN',
                    'horse_uid' => 14363,
                    'horse_sex' => 'C',
                    'buyer_detail' => 'Shadwell Estate Co Ltd',
                    'price' => 100000,
                    'exchange_rate_euro' => 1,
                    'exchange_rate' => 1.9299999999999999,
                    'currency_code' => 'USD',
                    'cur_code' => 'USD',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sale_year' => 1991,
                    'sire_name' => 'BET TWICE',
                    'style_name' => 'Bet Twice',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 22751,
                    'horse_sex' => 'C',
                    'buyer_detail' => 'Jerome J Meyers',
                    'price' => 30000,
                    'exchange_rate_euro' => 1,
                    'exchange_rate' => 1.9299999999999999,
                    'currency_code' => 'USD',
                    'cur_code' => 'USD',
                ]
            ),
        ];
    }

    public function getTopSires(Request\TopSires $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 848713,
                    'style_name' => 'Fly First',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 22027,
                    'sire_name' => 'Big Shuffle',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 101,
                    'race_datetime' => 'Aug  7 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 870314,
                    'style_name' => 'Spirit Doll',
                    'country_origin_code' => 'HOL',
                    'sire_uid' => 41798,
                    'sire_name' => 'Alkalde',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 73,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 862582,
                    'style_name' => 'Sirius',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 49191,
                    'sire_name' => 'Dashing Blade',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 110,
                    'race_datetime' => 'Jul  3 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 787631,
                    'style_name' => 'Ever Strong',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 68106,
                    'sire_name' => 'Lomitas',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 89,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 771430,
                    'style_name' => 'Well\'s Wonder',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 73058,
                    'sire_name' => 'Kornado',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => null,
                    'race_datetime' => 'Feb  6 2016  5:55PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 824413,
                    'style_name' => 'Protectionist',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 84824,
                    'sire_name' => 'Monsun',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 118,
                    'race_datetime' => 'Aug 14 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 875409,
                    'style_name' => 'Topography',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 84824,
                    'sire_name' => 'Monsun',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jun 12 2016  1:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 890402,
                    'style_name' => 'Arles',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 84824,
                    'sire_name' => 'Monsun',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 102,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006726,
                    'style_name' => 'Anna Mia',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 84824,
                    'sire_name' => 'Monsun',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Jul 12 2016  3:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1026600,
                    'style_name' => 'Wind Chill',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 84824,
                    'sire_name' => 'Monsun',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Mar 20 2016  1:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033730,
                    'style_name' => 'Lopera',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 84824,
                    'sire_name' => 'Monsun',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1053024,
                    'style_name' => 'Starlite Express',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 84824,
                    'sire_name' => 'Monsun',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jun 11 2016  2:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 892867,
                    'style_name' => 'Koffi Prince',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 85578,
                    'sire_name' => 'Lando',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Apr 24 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 999045,
                    'style_name' => 'Molly King',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 85578,
                    'sire_name' => 'Lando',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 89,
                    'race_datetime' => 'May 16 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1021899,
                    'style_name' => 'Danlia',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 85578,
                    'sire_name' => 'Lando',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 84,
                    'race_datetime' => 'Jul 12 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1021902,
                    'style_name' => 'Lysanda',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 85578,
                    'sire_name' => 'Lando',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 83,
                    'race_datetime' => 'May 28 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1022846,
                    'style_name' => 'Noble House',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 85578,
                    'sire_name' => 'Lando',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Aug 21 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1039220,
                    'style_name' => 'Intendantin',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 85578,
                    'sire_name' => 'Lando',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 82,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048763,
                    'style_name' => 'La Duma',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 85578,
                    'sire_name' => 'Lando',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 75,
                    'race_datetime' => 'Jul 17 2016  4:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 836762,
                    'style_name' => 'Empoli',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 96463,
                    'sire_name' => 'Halling',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Jul  6 2016  7:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 987794,
                    'style_name' => 'Licinius',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 96463,
                    'sire_name' => 'Halling',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 90,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 892421,
                    'style_name' => 'Konigsadler',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 103164,
                    'sire_name' => 'Kalatos',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Mar 20 2016  1:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 853142,
                    'style_name' => 'Phoibe',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 103416,
                    'sire_name' => 'Royal Applause',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 87,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 815744,
                    'style_name' => 'Star System',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 104011,
                    'sire_name' => 'Danehill Dancer',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 89,
                    'race_datetime' => 'May  8 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 845315,
                    'style_name' => 'Watchable',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 107700,
                    'sire_name' => 'Pivotal',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 109,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 846067,
                    'style_name' => 'Porthilly',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 107700,
                    'sire_name' => 'Pivotal',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Aug 14 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131289,
                    'style_name' => 'Finch Hatton',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 107700,
                    'sire_name' => 'Pivotal',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 81,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 838763,
                    'style_name' => 'Easy Road',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 447676,
                    'sire_name' => 'Compton Place',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 90,
                    'race_datetime' => 'Jul  5 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 843584,
                    'style_name' => 'Donnerschlag',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 448003,
                    'sire_name' => 'Bahamian Bounty',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 109,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 819083,
                    'style_name' => 'Dabadiyan',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 450077,
                    'sire_name' => 'Zamindar',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Mar 10 2016  6:55PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 907143,
                    'style_name' => 'Our Last Summer',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 450077,
                    'sire_name' => 'Zamindar',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 91,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 890646,
                    'style_name' => 'Guignol',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 450464,
                    'sire_name' => 'Cape Cross',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 107,
                    'race_datetime' => 'Aug 14 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1100723,
                    'style_name' => 'Modraszek',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 465239,
                    'sire_name' => 'Dr Fong',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 72,
                    'race_datetime' => 'Aug 14 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 818345,
                    'style_name' => 'Lili Moon',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 467030,
                    'sire_name' => 'Desert Prince',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 88,
                    'race_datetime' => 'May 26 2016  2:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 848588,
                    'style_name' => 'Eric',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Jul  3 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 861222,
                    'style_name' => 'Guiliani',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 115,
                    'race_datetime' => 'Apr 10 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 876815,
                    'style_name' => 'Fair Trade',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  1 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 890345,
                    'style_name' => 'Ice Man Star',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => null,
                    'race_datetime' => 'Apr 17 2016  5:15PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898023,
                    'style_name' => 'Guizot',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 87,
                    'race_datetime' => 'Jun 26 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 904115,
                    'style_name' => 'Gauguin',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 85,
                    'race_datetime' => 'Aug 13 2016 12:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 905093,
                    'style_name' => 'Olala',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 96,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 987807,
                    'style_name' => 'All Of The Lights',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 50,
                    'race_datetime' => 'Jul 24 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1004685,
                    'style_name' => 'Izzo',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 91,
                    'race_datetime' => 'May  1 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1004687,
                    'style_name' => 'Nacar',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1039225,
                    'style_name' => 'Russian Flamenco',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 55,
                    'race_datetime' => 'Jun 26 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1113179,
                    'style_name' => 'Classic Rock',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => null,
                    'race_datetime' => 'May 21 2016  1:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1122655,
                    'style_name' => 'Magellan',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 472194,
                    'sire_name' => 'Tertullian',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 44,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 840014,
                    'style_name' => 'Master Of Gold',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 472998,
                    'sire_name' => 'Gold Away',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 84,
                    'race_datetime' => 'May  1 2016  2:15PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 888154,
                    'style_name' => 'Fair Mountain',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 488238,
                    'sire_name' => 'Tiger Hill',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Aug  7 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 896274,
                    'style_name' => 'Whole Lotta Rosie',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 488238,
                    'sire_name' => 'Tiger Hill',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902485,
                    'style_name' => 'Saxone',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 488238,
                    'sire_name' => 'Tiger Hill',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  1 2016 12:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902983,
                    'style_name' => 'La Merced',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 488238,
                    'sire_name' => 'Tiger Hill',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Aug 14 2016  4:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 999006,
                    'style_name' => 'Rosenhill',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 488238,
                    'sire_name' => 'Tiger Hill',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 69,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1026990,
                    'style_name' => 'Lady Emerald',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 488238,
                    'sire_name' => 'Tiger Hill',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 69,
                    'race_datetime' => 'May  8 2016  1:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 817222,
                    'style_name' => 'Vetriano',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 499503,
                    'sire_name' => 'Namid',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => null,
                    'race_datetime' => 'Apr 17 2016  5:15PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006724,
                    'style_name' => 'Prince Orpen',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 499986,
                    'sire_name' => 'Orpen',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 97,
                    'race_datetime' => 'May 29 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 786545,
                    'style_name' => 'Birthday Prince',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 80,
                    'race_datetime' => 'Jul  5 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 842690,
                    'style_name' => 'Beau Reve',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  1 2016  6:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 865666,
                    'style_name' => 'Palace Prince',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 87,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 872105,
                    'style_name' => 'Antalya',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 889921,
                    'style_name' => 'Iraklion',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 891926,
                    'style_name' => 'Devastar',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 894603,
                    'style_name' => 'Incantator',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 108,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 896844,
                    'style_name' => 'Shy Witch',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Sep  1 2016  5:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 899977,
                    'style_name' => 'Articus',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 109,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 900446,
                    'style_name' => 'Walun',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901624,
                    'style_name' => 'Wonnemond',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug  7 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902428,
                    'style_name' => 'Dhaba',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1001231,
                    'style_name' => 'Amareion',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jun 11 2016  2:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1004688,
                    'style_name' => 'Weltmeister',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 84,
                    'race_datetime' => 'May 21 2016  1:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006722,
                    'style_name' => 'Kambria',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 75,
                    'race_datetime' => 'Jul 24 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1022919,
                    'style_name' => 'Halli Galli',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 82,
                    'race_datetime' => 'Aug 21 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1035997,
                    'style_name' => 'Salve Venezia',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 69,
                    'race_datetime' => 'Jun 19 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1100727,
                    'style_name' => 'Amalie',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Aug 14 2016  4:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1125123,
                    'style_name' => 'San Diego',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug  1 2016  5:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131292,
                    'style_name' => 'Sugar Daddy',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 500508,
                    'sire_name' => 'Areion',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Sep 11 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 767474,
                    'style_name' => 'Meandre',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 501775,
                    'sire_name' => 'Slickly',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 96,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 871275,
                    'style_name' => 'Mata Utu',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 501775,
                    'sire_name' => 'Slickly',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 86,
                    'race_datetime' => 'Aug 13 2016 12:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 870908,
                    'style_name' => 'Walzertakt',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 503034,
                    'sire_name' => 'Montjeu',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 102,
                    'race_datetime' => 'May 15 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 870986,
                    'style_name' => 'Brisanto',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 503875,
                    'sire_name' => 'Dansili',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 107,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 893885,
                    'style_name' => 'Salve Estelle',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 503875,
                    'sire_name' => 'Dansili',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Jun 19 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1039221,
                    'style_name' => 'Sarandia',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 503875,
                    'sire_name' => 'Dansili',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 105,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 872250,
                    'style_name' => 'Guavia',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 506927,
                    'sire_name' => 'Invincible Spirit',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 89,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 870883,
                    'style_name' => 'Not So Sleepy',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 516606,
                    'sire_name' => 'Beat Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 105,
                    'race_datetime' => 'Jul 12 2016  3:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 792102,
                    'style_name' => 'Mighty Mouse',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 516624,
                    'sire_name' => 'King\'s Best',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Aug  7 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 868179,
                    'style_name' => 'Rogue Runner',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 516624,
                    'sire_name' => 'King\'s Best',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 903502,
                    'style_name' => 'Tassilo',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 516624,
                    'sire_name' => 'King\'s Best',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 85,
                    'race_datetime' => 'May 16 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1010785,
                    'style_name' => 'Dynastie',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 517440,
                    'sire_name' => 'Sinndar',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'Apr 17 2016  4:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 886302,
                    'style_name' => 'Sacrifice My Soul',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 522845,
                    'sire_name' => 'Nayef',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 64,
                    'race_datetime' => 'Jun 19 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 899337,
                    'style_name' => 'Adelaide Rose',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 522845,
                    'sire_name' => 'Nayef',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 73,
                    'race_datetime' => 'Jul 12 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 865660,
                    'style_name' => 'Banana Split',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 527373,
                    'sire_name' => 'Kyllachy',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => null,
                    'race_datetime' => 'Apr 17 2016  5:15PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 792647,
                    'style_name' => 'Subtle Knife',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 527388,
                    'sire_name' => 'Needwood Blade',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Aug 21 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 845648,
                    'style_name' => 'Divisional',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 528206,
                    'sire_name' => 'Medicean',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug  7 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 848471,
                    'style_name' => 'Nordico',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528206,
                    'sire_name' => 'Medicean',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Sep 11 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 879203,
                    'style_name' => 'Nine Ou Four',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 528206,
                    'sire_name' => 'Medicean',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 78,
                    'race_datetime' => 'Aug 14 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1004684,
                    'style_name' => 'Berghain',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 528206,
                    'sire_name' => 'Medicean',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013863,
                    'style_name' => 'Saloonmedicus',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528206,
                    'sire_name' => 'Medicean',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => null,
                    'race_datetime' => 'Apr 24 2016 12:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 891619,
                    'style_name' => 'Novano',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528581,
                    'sire_name' => 'Samum',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 893722,
                    'style_name' => 'Paradise',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528581,
                    'sire_name' => 'Samum',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Mar 10 2016  6:55PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901640,
                    'style_name' => 'Donna Doria',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528581,
                    'sire_name' => 'Samum',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 85,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1000639,
                    'style_name' => 'Zirconic Star',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528581,
                    'sire_name' => 'Samum',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Apr 10 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1039226,
                    'style_name' => 'Sir Scott',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528581,
                    'sire_name' => 'Samum',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 37,
                    'race_datetime' => 'Jun 26 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048174,
                    'style_name' => 'Kashmar',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528581,
                    'sire_name' => 'Samum',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 0,
                    'race_datetime' => 'Jul  9 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131296,
                    'style_name' => 'Kazzun',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528581,
                    'sire_name' => 'Samum',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 0,
                    'race_datetime' => 'Sep 11 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 810924,
                    'style_name' => 'Si Luna',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528998,
                    'sire_name' => 'Kallisto',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 107,
                    'race_datetime' => 'Mar 27 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1000641,
                    'style_name' => 'Antares',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 528998,
                    'sire_name' => 'Kallisto',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 79,
                    'race_datetime' => 'May 16 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 999043,
                    'style_name' => 'Capitano',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 531264,
                    'sire_name' => 'Paolini',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Aug 21 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 851274,
                    'style_name' => 'Tamarind Cove',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 531769,
                    'sire_name' => 'Galileo',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 82,
                    'race_datetime' => 'Aug 13 2016 12:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 862762,
                    'style_name' => 'Botany Bay',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 531769,
                    'sire_name' => 'Galileo',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 896718,
                    'style_name' => 'Apple Betty',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 531769,
                    'sire_name' => 'Galileo',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 102,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901828,
                    'style_name' => 'Heavenly Scent',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 531769,
                    'sire_name' => 'Galileo',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Aug 14 2016  4:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 956912,
                    'style_name' => 'Anneli',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 531769,
                    'sire_name' => 'Galileo',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 71,
                    'race_datetime' => 'Jul 12 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 817093,
                    'style_name' => 'Manisa',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 533421,
                    'sire_name' => 'Okawango',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 60,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901931,
                    'style_name' => 'Pop By',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 534987,
                    'sire_name' => 'City Zip',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 885770,
                    'style_name' => 'Ross',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 541314,
                    'sire_name' => 'Acclamation',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Sep  1 2016  5:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 838898,
                    'style_name' => 'Rock Of Romance',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 544976,
                    'sire_name' => 'Rock Of Gibraltar',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Jul  6 2016  7:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013861,
                    'style_name' => 'Bora Rock',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 544976,
                    'sire_name' => 'Rock Of Gibraltar',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1016749,
                    'style_name' => 'Miss Infinity',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 544976,
                    'sire_name' => 'Rock Of Gibraltar',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 848468,
                    'style_name' => 'Lucky Lion',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 546212,
                    'sire_name' => 'High Chaparral',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 102,
                    'race_datetime' => 'Jun 26 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 882068,
                    'style_name' => 'Taniya',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 546212,
                    'sire_name' => 'High Chaparral',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 86,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 888711,
                    'style_name' => 'Landofhopeandglory',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 546212,
                    'sire_name' => 'High Chaparral',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 27,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901638,
                    'style_name' => 'Nimrod',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 546212,
                    'sire_name' => 'High Chaparral',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1050835,
                    'style_name' => 'Nazbanou',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 546212,
                    'sire_name' => 'High Chaparral',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 77,
                    'race_datetime' => 'Jul 12 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 866227,
                    'style_name' => 'Daring Match',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 547348,
                    'sire_name' => 'Call Me Big',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 109,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 838039,
                    'style_name' => 'Night Wish',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 548469,
                    'sire_name' => 'Sholokhov',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 95,
                    'race_datetime' => 'May  8 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901623,
                    'style_name' => 'Pagino',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 548469,
                    'sire_name' => 'Sholokhov',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Jun 26 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1083531,
                    'style_name' => 'Silver Sea',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 548469,
                    'sire_name' => 'Sholokhov',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'Apr 24 2016 12:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1016781,
                    'style_name' => 'Le Colonel',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 548659,
                    'sire_name' => 'Sabiango',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 102,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 862577,
                    'style_name' => 'Early Morning',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 550234,
                    'sire_name' => 'Mamool',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 101,
                    'race_datetime' => 'May 29 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 889920,
                    'style_name' => 'Eastsite One',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 550234,
                    'sire_name' => 'Mamool',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 77,
                    'race_datetime' => 'Apr 26 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006721,
                    'style_name' => 'Lips Planet',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 550234,
                    'sire_name' => 'Mamool',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013864,
                    'style_name' => 'Plein Ciel',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 550234,
                    'sire_name' => 'Mamool',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 79,
                    'race_datetime' => 'Apr 17 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1022916,
                    'style_name' => 'Chandos Belle',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 550234,
                    'sire_name' => 'Mamool',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  1 2016  1:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1039223,
                    'style_name' => 'Buzzy',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 550234,
                    'sire_name' => 'Mamool',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 76,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1083529,
                    'style_name' => 'Erica',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 550234,
                    'sire_name' => 'Mamool',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jul 10 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 770859,
                    'style_name' => 'Gereon',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 553074,
                    'sire_name' => 'Next Desert',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Sep 11 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 904111,
                    'style_name' => 'Baroncello',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 553403,
                    'sire_name' => 'Medecis',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 90,
                    'race_datetime' => 'May 16 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 834101,
                    'style_name' => 'Shining Emerald',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 564704,
                    'sire_name' => 'Clodovil',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 109,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 842804,
                    'style_name' => 'Sognando La Cometa',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 564704,
                    'sire_name' => 'Clodovil',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 85,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 833807,
                    'style_name' => 'Larra Chope',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 564856,
                    'sire_name' => 'Deportivo',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 71,
                    'race_datetime' => 'Mar 27 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 845421,
                    'style_name' => 'Son Cesio',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 564950,
                    'sire_name' => 'Zafeen',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 103,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 869930,
                    'style_name' => 'Lovemedo',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 564950,
                    'sire_name' => 'Zafeen',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 96,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 885841,
                    'style_name' => 'Five Fifteen',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 564950,
                    'sire_name' => 'Zafeen',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 92,
                    'race_datetime' => 'May 26 2016  2:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131299,
                    'style_name' => 'De Charlie',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 565570,
                    'sire_name' => 'Big Bad Bob',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 90,
                    'race_datetime' => 'Sep 11 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 994470,
                    'style_name' => 'Fiorella',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 565797,
                    'sire_name' => 'Oasis Dream',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 75,
                    'race_datetime' => 'Mar 27 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 841435,
                    'style_name' => 'Alex My Boy',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 567732,
                    'sire_name' => 'Dalakhani',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 105,
                    'race_datetime' => 'May 15 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 853228,
                    'style_name' => 'Yorkidding',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 567732,
                    'sire_name' => 'Dalakhani',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 824429,
                    'style_name' => 'Vif Monsieur',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569100,
                    'sire_name' => 'Doyen',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Aug  7 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 857066,
                    'style_name' => 'Wild Chief',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569100,
                    'sire_name' => 'Doyen',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 869152,
                    'style_name' => 'Molly Le Clou',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569100,
                    'sire_name' => 'Doyen',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 77,
                    'race_datetime' => 'May 26 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1010786,
                    'style_name' => 'Lipari',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569100,
                    'sire_name' => 'Doyen',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'Apr 17 2016  4:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 840747,
                    'style_name' => 'Maningrey',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 101,
                    'race_datetime' => 'Apr 24 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 871581,
                    'style_name' => 'Maha Kumari',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Jun 19 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 871582,
                    'style_name' => 'Nymeria',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Sep 11 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 888156,
                    'style_name' => 'Shadow Sadness',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 102,
                    'race_datetime' => 'May  8 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 899338,
                    'style_name' => 'Milenia',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901645,
                    'style_name' => 'Parthenius',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902425,
                    'style_name' => 'Serienholde',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902429,
                    'style_name' => 'Fosun',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902430,
                    'style_name' => 'Pagella',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902900,
                    'style_name' => 'Blumenfee',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1010798,
                    'style_name' => 'Mary Sun',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013857,
                    'style_name' => 'Dschingis Secret',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 112,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1022845,
                    'style_name' => 'Wai Key Star',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 109,
                    'race_datetime' => 'Aug 21 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1024259,
                    'style_name' => 'Son Macia',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033728,
                    'style_name' => 'Kasalla',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 103,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1053019,
                    'style_name' => 'Lamarck',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jun 11 2016  2:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131293,
                    'style_name' => 'Silver Cloud',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 89,
                    'race_datetime' => 'Sep 11 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131297,
                    'style_name' => 'Wilder Wein',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 569586,
                    'sire_name' => 'Soldier Hollow',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Sep 11 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 840169,
                    'style_name' => 'Gamgoom',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 577888,
                    'sire_name' => 'Exceed And Excel',
                    'sire_country_origin_code' => 'AUS',
                    'rp_postmark' => 65,
                    'race_datetime' => 'Aug 14 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 897054,
                    'style_name' => 'Elennga',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 577888,
                    'sire_name' => 'Exceed And Excel',
                    'sire_country_origin_code' => 'AUS',
                    'rp_postmark' => 86,
                    'race_datetime' => 'Jun 25 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898014,
                    'style_name' => 'Degas',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 577888,
                    'sire_name' => 'Exceed And Excel',
                    'sire_country_origin_code' => 'AUS',
                    'rp_postmark' => 108,
                    'race_datetime' => 'Sep  1 2016  5:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006723,
                    'style_name' => 'Signora Queen',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 577888,
                    'sire_name' => 'Exceed And Excel',
                    'sire_country_origin_code' => 'AUS',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1119222,
                    'style_name' => 'Sugar Free',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 577888,
                    'sire_name' => 'Exceed And Excel',
                    'sire_country_origin_code' => 'AUS',
                    'rp_postmark' => 74,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013860,
                    'style_name' => 'Monaco Show',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 579845,
                    'sire_name' => 'Kheleyf',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 842691,
                    'style_name' => 'Mikesh',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 579854,
                    'sire_name' => 'Majestic Missile',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Aug 14 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 893900,
                    'style_name' => 'Summershine',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 580208,
                    'sire_name' => 'Three Valleys',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 91,
                    'race_datetime' => 'Aug 20 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898027,
                    'style_name' => 'Irish Valley',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 580208,
                    'sire_name' => 'Three Valleys',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 75,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 978250,
                    'style_name' => 'Eliza',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 581979,
                    'sire_name' => 'Dai Jin',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => null,
                    'race_datetime' => 'Feb  6 2016  5:55PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 900852,
                    'style_name' => 'Tiberian',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 582216,
                    'sire_name' => 'Tiberius Caesar',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 882488,
                    'style_name' => 'Rebel Surge',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 582877,
                    'sire_name' => 'Kodiac',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Jun  5 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 885813,
                    'style_name' => 'Gittan',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 582877,
                    'sire_name' => 'Kodiac',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 68,
                    'race_datetime' => 'Jun  5 2016  1:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 888348,
                    'style_name' => 'Schutzenpost',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 583589,
                    'sire_name' => 'American Post',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Aug 21 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1093612,
                    'style_name' => 'Caccini',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 583589,
                    'sire_name' => 'American Post',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 103,
                    'race_datetime' => 'Aug 14 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 994521,
                    'style_name' => 'Tickle Me Blue',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 584449,
                    'sire_name' => 'Iffraaj',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Sep 11 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 850890,
                    'style_name' => 'Amour De Nuit',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 584911,
                    'sire_name' => 'Azamour',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Jul  6 2016  7:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 872248,
                    'style_name' => 'Damour',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 584911,
                    'sire_name' => 'Azamour',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 86,
                    'race_datetime' => 'Jul  6 2016  7:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 891288,
                    'style_name' => 'Hawksmoor',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 584911,
                    'sire_name' => 'Azamour',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 102,
                    'race_datetime' => 'Jun  5 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131291,
                    'style_name' => 'Danny Boy',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 589092,
                    'sire_name' => 'Caradak',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Sep 11 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 895854,
                    'style_name' => 'Powder Snow',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 589690,
                    'sire_name' => 'Dubawi',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898279,
                    'style_name' => 'Amazona',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 589690,
                    'sire_name' => 'Dubawi',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Mar 28 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 900895,
                    'style_name' => 'Quidura',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 589690,
                    'sire_name' => 'Dubawi',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 0,
                    'race_datetime' => 'Apr 17 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1021893,
                    'style_name' => 'Pabouche',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 589690,
                    'sire_name' => 'Dubawi',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 83,
                    'race_datetime' => 'Aug 21 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 819966,
                    'style_name' => 'Empire Hurricane',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 589733,
                    'sire_name' => 'Hurricane Run',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug 20 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 820417,
                    'style_name' => 'Felician',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 590219,
                    'sire_name' => 'Motivator',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 851266,
                    'style_name' => 'The Twisler',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 590219,
                    'sire_name' => 'Motivator',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 100,
                    'race_datetime' => 'May 15 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006725,
                    'style_name' => 'Wild Motion',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 590219,
                    'sire_name' => 'Motivator',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 47,
                    'race_datetime' => 'May  1 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1041628,
                    'style_name' => 'Hargeisa',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 600609,
                    'sire_name' => 'Speightstown',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => null,
                    'race_datetime' => 'May 25 2016  5:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 885539,
                    'style_name' => 'Show Day',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 602045,
                    'sire_name' => 'Shamardal',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 891617,
                    'style_name' => 'Moscatello',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 602045,
                    'sire_name' => 'Shamardal',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  1 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 894748,
                    'style_name' => 'Wildpark',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 602045,
                    'sire_name' => 'Shamardal',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 103,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 897027,
                    'style_name' => 'Gouache',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 602045,
                    'sire_name' => 'Shamardal',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Aug 14 2016  4:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 904772,
                    'style_name' => 'Royal Solitaire',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 602045,
                    'sire_name' => 'Shamardal',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 110,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 828026,
                    'style_name' => 'Ambiance',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 602298,
                    'sire_name' => 'Camacho',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Aug 14 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 850899,
                    'style_name' => 'Celestial Path',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 602494,
                    'sire_name' => 'Footstepsinthesand',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 91,
                    'race_datetime' => 'May  8 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 863149,
                    'style_name' => 'Kaspersky',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 602494,
                    'sire_name' => 'Footstepsinthesand',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 110,
                    'race_datetime' => 'Jul 17 2016  4:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 865586,
                    'style_name' => 'Waka Laura',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 602888,
                    'sire_name' => 'Windsor Knot',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 49,
                    'race_datetime' => 'Jul 24 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 809597,
                    'style_name' => 'Kolonel',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 606745,
                    'sire_name' => 'Manduro',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 16,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 890300,
                    'style_name' => 'Digitalis',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 606745,
                    'sire_name' => 'Manduro',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 90,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 891664,
                    'style_name' => 'Techno Queen',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 606745,
                    'sire_name' => 'Manduro',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 103,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048766,
                    'style_name' => 'Queen Viktoria',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 606745,
                    'sire_name' => 'Manduro',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 77,
                    'race_datetime' => 'Jul 12 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1026988,
                    'style_name' => 'Atlantik Cup',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 626393,
                    'sire_name' => 'Electric Beat',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 63,
                    'race_datetime' => 'May  1 2016  2:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 957698,
                    'style_name' => 'Jungleboogie',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 635802,
                    'sire_name' => 'Nicaron',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug 20 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 867058,
                    'style_name' => 'Haalan',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 637859,
                    'sire_name' => 'Sir Percy',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 81,
                    'race_datetime' => 'May  1 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1039224,
                    'style_name' => 'Landin',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 637859,
                    'sire_name' => 'Sir Percy',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 89,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 994471,
                    'style_name' => 'Kimberley\'s Dream',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 638137,
                    'sire_name' => 'Santiago',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Mar 27 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 871577,
                    'style_name' => 'Amona',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 639504,
                    'sire_name' => 'Aussie Rules',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1000636,
                    'style_name' => 'Quelindo',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 639504,
                    'sire_name' => 'Aussie Rules',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 96,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 872992,
                    'style_name' => 'Palang',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 639522,
                    'sire_name' => 'Hat Trick',
                    'sire_country_origin_code' => 'JPN',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Jul 12 2016  3:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 859254,
                    'style_name' => 'Dylan Mouth',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 640322,
                    'sire_name' => 'Dylan Thomas',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 860073,
                    'style_name' => 'Holy Spring',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 640322,
                    'sire_name' => 'Dylan Thomas',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 873043,
                    'style_name' => 'Nightflower',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 640322,
                    'sire_name' => 'Dylan Thomas',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 108,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033729,
                    'style_name' => 'La Dynamite',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 640322,
                    'sire_name' => 'Dylan Thomas',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 900655,
                    'style_name' => 'Bebe Cherie',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 640786,
                    'sire_name' => 'Youmzain',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 96,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901637,
                    'style_name' => 'Light Of Air',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 640786,
                    'sire_name' => 'Youmzain',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 78,
                    'race_datetime' => 'Jun 19 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 893582,
                    'style_name' => 'Fee D\'Artois',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 641338,
                    'sire_name' => 'Palace Episode',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 63,
                    'race_datetime' => 'Jun 19 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901642,
                    'style_name' => 'Zanini',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 643316,
                    'sire_name' => 'Poseidon Adventure',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 86,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013862,
                    'style_name' => 'Kenrivash',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 644917,
                    'sire_name' => 'Kendargent',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 90,
                    'race_datetime' => 'Jun  5 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1056909,
                    'style_name' => 'Farshad',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 644917,
                    'sire_name' => 'Kendargent',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 433566,
                    'style_name' => 'San Salvador',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 89,
                    'race_datetime' => 'Jun 19 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 872104,
                    'style_name' => 'Al Queena',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 75,
                    'race_datetime' => 'Aug 13 2016 12:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 886455,
                    'style_name' => 'Bravo Girl',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Jun 19 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898021,
                    'style_name' => 'Miss England',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 64,
                    'race_datetime' => 'May 28 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 901643,
                    'style_name' => 'Isfahan',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 113,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902424,
                    'style_name' => 'Dalmatian Sea',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 69,
                    'race_datetime' => 'Jun 12 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 906790,
                    'style_name' => 'Night Time',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  5 2016  4:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006719,
                    'style_name' => 'Near England',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 101,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1021376,
                    'style_name' => 'Petite Paradise',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  1 2016  6:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1022918,
                    'style_name' => 'Amiga',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'May 16 2016  1:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033725,
                    'style_name' => 'Always Hope',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 75,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048225,
                    'style_name' => 'Weisser Stern',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jun 18 2016  3:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048765,
                    'style_name' => 'Wild Horse',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jun 11 2016  4:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1056910,
                    'style_name' => 'Aliance',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 645605,
                    'sire_name' => 'Lord Of England',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'May 25 2016  5:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 895908,
                    'style_name' => 'Omar Bradley',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 649250,
                    'sire_name' => 'War Front',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 89,
                    'race_datetime' => 'May 16 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 862797,
                    'style_name' => 'Diplomat',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 649434,
                    'sire_name' => 'Teofilo',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 871105,
                    'style_name' => 'Volatile',
                    'country_origin_code' => 'SWE',
                    'sire_uid' => 650324,
                    'sire_name' => 'Strategic Prince',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 40,
                    'race_datetime' => 'Jul  5 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1026983,
                    'style_name' => 'Summer Princess',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 650324,
                    'sire_name' => 'Strategic Prince',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 43,
                    'race_datetime' => 'Apr 30 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1026987,
                    'style_name' => 'Teddilee',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 650324,
                    'sire_name' => 'Strategic Prince',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 78,
                    'race_datetime' => 'May  5 2016  1:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 865301,
                    'style_name' => 'Excilly',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 654568,
                    'sire_name' => 'Excellent Art',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 84,
                    'race_datetime' => 'Jul  2 2016  3:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 994520,
                    'style_name' => 'Dynamic Lips',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 654568,
                    'sire_name' => 'Excellent Art',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Aug 21 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 792181,
                    'style_name' => 'Simplon',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 655692,
                    'sire_name' => 'Rail Link',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 76,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 899333,
                    'style_name' => 'Alter Rail',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 655692,
                    'sire_name' => 'Rail Link',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 68,
                    'race_datetime' => 'Apr 23 2016  1:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 899996,
                    'style_name' => 'Wasir',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 655692,
                    'sire_name' => 'Rail Link',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 103,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 861221,
                    'style_name' => 'Cassilero',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 656920,
                    'sire_name' => 'Creachadoir',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Mar 10 2016  6:55PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 895110,
                    'style_name' => 'Parvaneh',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 657462,
                    'sire_name' => 'Holy Roman Emperor',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1021900,
                    'style_name' => 'Ma Petite Folie',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 657920,
                    'sire_name' => 'Cockney Rebel',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033727,
                    'style_name' => 'Cockney Blue',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 657920,
                    'sire_name' => 'Cockney Rebel',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 74,
                    'race_datetime' => 'Jun 12 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 845691,
                    'style_name' => 'Pas De Deux',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 658234,
                    'sire_name' => 'Saddex',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 117,
                    'race_datetime' => 'Sep  1 2016  5:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 896845,
                    'style_name' => 'Bastille',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 658234,
                    'sire_name' => 'Saddex',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 89,
                    'race_datetime' => 'Aug 13 2016 12:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 871520,
                    'style_name' => 'Lovato',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 658504,
                    'sire_name' => 'Lauro',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 867837,
                    'style_name' => 'Drummer',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 659996,
                    'sire_name' => 'Duke Of Marmalade',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 107,
                    'race_datetime' => 'Sep 11 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 991635,
                    'style_name' => 'Flemish Duchesse',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 659996,
                    'sire_name' => 'Duke Of Marmalade',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1000638,
                    'style_name' => 'Swinging Duke',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 659996,
                    'sire_name' => 'Duke Of Marmalade',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Apr 10 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 892866,
                    'style_name' => 'Lutania',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 660521,
                    'sire_name' => 'Archipenko',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 79,
                    'race_datetime' => 'Jul 10 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1114229,
                    'style_name' => 'Va Bank',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 660521,
                    'sire_name' => 'Archipenko',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 113,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 949360,
                    'style_name' => 'Never Compromise',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 660522,
                    'sire_name' => 'Astronomer Royal',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 67,
                    'race_datetime' => 'May 29 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 846850,
                    'style_name' => 'Strawberry Martini',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 660604,
                    'sire_name' => 'Mount Nelson',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 91,
                    'race_datetime' => 'Jul 10 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 860365,
                    'style_name' => 'Weltmacht',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 660604,
                    'sire_name' => 'Mount Nelson',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Sep  3 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013856,
                    'style_name' => 'Boscaccio',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 660604,
                    'sire_name' => 'Mount Nelson',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 105,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 906843,
                    'style_name' => 'Nessaya',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 660612,
                    'sire_name' => 'Soldier Of Fortune',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 43,
                    'race_datetime' => 'Jul 10 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1037639,
                    'style_name' => 'Cashman',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 660612,
                    'sire_name' => 'Soldier Of Fortune',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 26,
                    'race_datetime' => 'Jun 19 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 899947,
                    'style_name' => 'Calantha',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 663605,
                    'sire_name' => 'Literato',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 85,
                    'race_datetime' => 'Jul 12 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013859,
                    'style_name' => 'Larry',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 663605,
                    'sire_name' => 'Literato',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 52,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 869844,
                    'style_name' => 'Rose Rized',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 663655,
                    'sire_name' => 'Authorized',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 96,
                    'race_datetime' => 'Aug  7 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 843667,
                    'style_name' => 'Abendwind',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 665973,
                    'sire_name' => 'Wiesenpfad',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Aug 13 2016 12:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 894088,
                    'style_name' => 'Atreju',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 665973,
                    'sire_name' => 'Wiesenpfad',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug  7 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 896839,
                    'style_name' => 'Double Dream',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 668175,
                    'sire_name' => 'Lawman',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Aug 13 2016 12:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1039222,
                    'style_name' => 'Atillio',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 668175,
                    'sire_name' => 'Lawman',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 61,
                    'race_datetime' => 'Jun 26 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 813835,
                    'style_name' => 'Flashy Approach',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 670119,
                    'sire_name' => 'New Approach',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Jul  5 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 842034,
                    'style_name' => 'Elliptique',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 670119,
                    'sire_name' => 'New Approach',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 114,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 869458,
                    'style_name' => 'Potemkin',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 670119,
                    'sire_name' => 'New Approach',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 112,
                    'race_datetime' => 'Aug 27 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1013850,
                    'style_name' => 'Veneto',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 670119,
                    'sire_name' => 'New Approach',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 86,
                    'race_datetime' => 'May 16 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033726,
                    'style_name' => 'Wild Approach',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 670119,
                    'sire_name' => 'New Approach',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Jun 12 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 852623,
                    'style_name' => 'Markaz',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 671647,
                    'sire_name' => 'Dark Angel',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 110,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 853737,
                    'style_name' => 'Divine',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 671647,
                    'sire_name' => 'Dark Angel',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 105,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902463,
                    'style_name' => 'Royal Shaheen',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 671916,
                    'sire_name' => 'Myboycharlie',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Jun  5 2016  1:35PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 999046,
                    'style_name' => 'Volcancito',
                    'country_origin_code' => 'SWI',
                    'sire_uid' => 671916,
                    'sire_name' => 'Myboycharlie',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 86,
                    'race_datetime' => 'May 28 2016  3:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898004,
                    'style_name' => 'Medici',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 675528,
                    'sire_name' => 'Curlin',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 83,
                    'race_datetime' => 'Jun 26 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1025991,
                    'style_name' => 'Old Fashioned',
                    'country_origin_code' => 'CHI',
                    'sire_uid' => 677077,
                    'sire_name' => 'Neko Bay',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => 76,
                    'race_datetime' => 'Jul 24 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 867515,
                    'style_name' => 'Ito',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 118,
                    'race_datetime' => 'Jul 31 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 869453,
                    'style_name' => 'Kashya',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 61,
                    'race_datetime' => 'Jul 10 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 888157,
                    'style_name' => 'Space Cowboy',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 96,
                    'race_datetime' => 'May 15 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 890405,
                    'style_name' => 'Shivajia',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Aug 14 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 897053,
                    'style_name' => 'Iquitos',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 115,
                    'race_datetime' => 'Sep  4 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898016,
                    'style_name' => 'Moonshiner',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Jun 26 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1022915,
                    'style_name' => 'Leomar',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jul 10 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033731,
                    'style_name' => 'Meergorl',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1037638,
                    'style_name' => 'Savoir Vivre',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 113,
                    'race_datetime' => 'Jul 10 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048224,
                    'style_name' => 'Eagle Eyes',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 680190,
                    'sire_name' => 'Adlerflug',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jun 19 2016  1:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1125124,
                    'style_name' => 'Oriental Eagle',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 685571,
                    'sire_name' => 'Campanologist',
                    'sire_country_origin_code' => 'USA',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug  7 2016  1:15PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 861141,
                    'style_name' => 'Making Trouble',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 685655,
                    'sire_name' => 'Paco Boy',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 904645,
                    'style_name' => 'Quenby',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 686146,
                    'sire_name' => 'Ambassador',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 97,
                    'race_datetime' => 'May 26 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 994472,
                    'style_name' => 'Vanbijou',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 687521,
                    'sire_name' => 'Pomellato',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 71,
                    'race_datetime' => 'Mar 27 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1011753,
                    'style_name' => 'Schang',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 689411,
                    'sire_name' => 'Contat',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 112,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898015,
                    'style_name' => 'Millowitsch',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 689831,
                    'sire_name' => 'Sehrezad',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 103,
                    'race_datetime' => 'May 16 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1131294,
                    'style_name' => 'Viva La Flora',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 690748,
                    'sire_name' => 'Liang Kay',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 76,
                    'race_datetime' => 'Sep 11 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 893923,
                    'style_name' => 'Wizardess',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 692355,
                    'sire_name' => 'Equiano',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 75,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 847366,
                    'style_name' => 'Bondi',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 692670,
                    'sire_name' => 'It\'s Gino',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 85,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 862502,
                    'style_name' => 'Rosebay',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 692670,
                    'sire_name' => 'It\'s Gino',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Sep  1 2016  5:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 867728,
                    'style_name' => 'Forgino',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 692670,
                    'sire_name' => 'It\'s Gino',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 110,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048179,
                    'style_name' => 'She\'s Gina',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 692670,
                    'sire_name' => 'It\'s Gino',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 889922,
                    'style_name' => 'Quasillo',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 695547,
                    'sire_name' => 'Sea The Stars',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 106,
                    'race_datetime' => 'Jul 12 2016  3:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1033732,
                    'style_name' => 'Night Music',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 695547,
                    'sire_name' => 'Sea The Stars',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 95,
                    'race_datetime' => 'Sep  3 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 855466,
                    'style_name' => 'Father Frost',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 695691,
                    'sire_name' => 'Rip Van Winkle',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 94,
                    'race_datetime' => 'Aug 14 2016  2:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 900444,
                    'style_name' => 'Laurette',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 695691,
                    'sire_name' => 'Rip Van Winkle',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jul 10 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 903066,
                    'style_name' => 'Matara',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 695691,
                    'sire_name' => 'Rip Van Winkle',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 40,
                    'race_datetime' => 'Aug 21 2016  4:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1046113,
                    'style_name' => 'Real Value',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 695691,
                    'sire_name' => 'Rip Van Winkle',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 874957,
                    'style_name' => 'Icecapada',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 695767,
                    'sire_name' => 'Mastercraftsman',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 93,
                    'race_datetime' => 'May  1 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1000640,
                    'style_name' => 'A Raving Beauty',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 695767,
                    'sire_name' => 'Mastercraftsman',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 87,
                    'race_datetime' => 'Apr 10 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1026982,
                    'style_name' => 'Zasada',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 695767,
                    'sire_name' => 'Mastercraftsman',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 60,
                    'race_datetime' => 'Apr 30 2016  2:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1077212,
                    'style_name' => 'Bay Of Biscaine',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 695767,
                    'sire_name' => 'Mastercraftsman',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 50,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1125122,
                    'style_name' => 'Ashiana',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 695767,
                    'sire_name' => 'Mastercraftsman',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => null,
                    'race_datetime' => 'Aug  1 2016  5:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 849569,
                    'style_name' => 'Red Hot Calypso',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 697881,
                    'sire_name' => 'Art Connoisseur',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 93,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1021903,
                    'style_name' => 'Peppy Music',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 706399,
                    'sire_name' => 'Kamsin',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 24,
                    'race_datetime' => 'May 28 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048767,
                    'style_name' => 'Lacrimosa',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 706399,
                    'sire_name' => 'Kamsin',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jul  2 2016 11:35AM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048769,
                    'style_name' => 'Draconis',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 706399,
                    'sire_name' => 'Kamsin',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jul 10 2016  3:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 875830,
                    'style_name' => 'Mc Queen',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 707855,
                    'sire_name' => 'Silver Frost',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 99,
                    'race_datetime' => 'Aug 28 2016  3:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 894438,
                    'style_name' => 'Meliora',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 726295,
                    'sire_name' => 'Starspangledbanner',
                    'sire_country_origin_code' => 'AUS',
                    'rp_postmark' => 87,
                    'race_datetime' => 'Jul 10 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 905299,
                    'style_name' => 'Princess Asta',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 732354,
                    'sire_name' => 'Canford Cliffs',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 96,
                    'race_datetime' => 'Sep 11 2016  3:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 871578,
                    'style_name' => 'Bourree',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 733304,
                    'sire_name' => 'Siyouni',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => 100,
                    'race_datetime' => 'Mar 28 2016  4:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 987797,
                    'style_name' => 'Avicenna',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 733304,
                    'sire_name' => 'Siyouni',
                    'sire_country_origin_code' => 'FR',
                    'rp_postmark' => null,
                    'race_datetime' => 'May 15 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1004686,
                    'style_name' => 'Karajol',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 736402,
                    'sire_name' => 'Wiener Walzer',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 96,
                    'race_datetime' => 'May  1 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1022914,
                    'style_name' => 'Nordwienerin',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 736402,
                    'sire_name' => 'Wiener Walzer',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 90,
                    'race_datetime' => 'Aug  7 2016  2:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048768,
                    'style_name' => 'Pretty Woman',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 736402,
                    'sire_name' => 'Wiener Walzer',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'Jul  2 2016 11:35AM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1093631,
                    'style_name' => 'African Beat',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 737028,
                    'sire_name' => 'Sordino',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => null,
                    'race_datetime' => 'May  5 2016  4:50PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 904114,
                    'style_name' => 'El Loco',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 104,
                    'race_datetime' => 'Sep 11 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 999044,
                    'style_name' => 'Jarahi',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 89,
                    'race_datetime' => 'Apr 24 2016  3:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1006720,
                    'style_name' => 'Redenca',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 92,
                    'race_datetime' => 'Aug 31 2016  5:20PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1026989,
                    'style_name' => 'Aigrette Coquette',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 53,
                    'race_datetime' => 'May  1 2016  2:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1122656,
                    'style_name' => 'Navarra King',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 98,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1122654,
                    'style_name' => 'Fulminato',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 749313,
                    'sire_name' => 'Excelebration',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 83,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 899336,
                    'style_name' => 'Noor Al Hawa',
                    'country_origin_code' => 'FR',
                    'sire_uid' => 752305,
                    'sire_name' => 'Makfi',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 107,
                    'race_datetime' => 'Sep 11 2016  4:25PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 902707,
                    'style_name' => 'Toinette',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 752305,
                    'sire_name' => 'Makfi',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Sep  4 2016  1:30PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 903851,
                    'style_name' => 'Bartavelle',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 752305,
                    'sire_name' => 'Makfi',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 88,
                    'race_datetime' => 'Jun 19 2016  2:40PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1048223,
                    'style_name' => 'Wacaria',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 752305,
                    'sire_name' => 'Makfi',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 76,
                    'race_datetime' => 'Jul 12 2016  6:00PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 894553,
                    'style_name' => 'Architecture',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 756093,
                    'sire_name' => 'Zoffany',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 102,
                    'race_datetime' => 'Aug  7 2016  3:45PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 898227,
                    'style_name' => 'Knife Edge',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 756093,
                    'sire_name' => 'Zoffany',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 108,
                    'race_datetime' => 'May 16 2016  4:05PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 1122657,
                    'style_name' => 'Zaffinah',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 760422,
                    'sire_name' => 'Casamento',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 83,
                    'race_datetime' => 'Sep  4 2016  2:10PM',
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 894147,
                    'style_name' => 'Apoleon',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 904647,
                    'sire_name' => 'Ogatonango',
                    'sire_country_origin_code' => 'GER',
                    'rp_postmark' => 97,
                    'race_datetime' => 'Aug  6 2016  1:50PM',
                ]
            ),
        ];
    }


    /**
     * @param int $progenyPerformersLimit
     *
     * @return array
     */
    public function getStallionProgenyPerformers($progenyPerformersLimit)
    {
        $progenyPerformersLimit = $progenyPerformersLimit * 2;

        $data = [
            '2012_Worldwide G1_FR_3' =>
                array(
                    476873 =>
                        array(
                            0 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'sire_uid' => 476873,
                                        'horse_uid' => 794994,
                                        'horse_style_name' => 'Gold Ship',
                                        'horse_country_origin_code' => 'JPN',
                                        'dam_sire_uid' => 72543,
                                        'dam_sire_style_name' => 'Mejiro McQueen',
                                        'dam_sire_country_origin_code' => 'JPN',
                                        'rpr' => 128,
                                    )
                                ),
                            1 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'sire_uid' => 476873,
                                        'horse_uid' => 771325,
                                        'horse_style_name' => 'Orfevre',
                                        'horse_country_origin_code' => 'JPN',
                                        'dam_sire_uid' => 72543,
                                        'dam_sire_style_name' => 'Mejiro McQueen',
                                        'dam_sire_country_origin_code' => 'JPN',
                                        'rpr' => 127,
                                    )
                                ),
                        ),
                    636099 =>
                        array(
                            0 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'sire_uid' => 636099,
                                        'horse_uid' => 801866,
                                        'horse_style_name' => 'Gentildonna',
                                        'horse_country_origin_code' => 'JPN',
                                        'dam_sire_uid' => 488572,
                                        'dam_sire_style_name' => 'Bertolini',
                                        'dam_sire_country_origin_code' => 'USA',
                                        'rpr' => 126,
                                    )
                                ),
                            1 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'sire_uid' => 636099,
                                        'horse_uid' => 798828,
                                        'horse_style_name' => 'Deep Brillante',
                                        'horse_country_origin_code' => 'JPN',
                                        'dam_sire_uid' => 109183,
                                        'dam_sire_style_name' => 'Loup Sauvage',
                                        'dam_sire_country_origin_code' => 'USA',
                                        'rpr' => 118,
                                    )
                                ),
                            2 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'sire_uid' => 636099,
                                        'horse_uid' => 793132,
                                        'horse_style_name' => 'Beauty Parlour',
                                        'horse_country_origin_code' => 'GB',
                                        'dam_sire_uid' => 513047,
                                        'dam_sire_style_name' => 'Giant\'s Causeway',
                                        'dam_sire_country_origin_code' => 'USA',
                                        'rpr' => 115,
                                    )
                                ),
                        ),
                ),
            '2016_First Crop_GB_IRE_1' =>
                array(
                    756946 =>
                        array(
                            0 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'sire_uid' => 756946,
                                        'horse_uid' => 964674,
                                        'horse_style_name' => 'Global Applause',
                                        'horse_country_origin_code' => 'GB',
                                        'dam_sire_uid' => 103416,
                                        'dam_sire_style_name' => 'Royal Applause',
                                        'dam_sire_country_origin_code' => 'GB',
                                        'rpr' => 103,
                                    )
                                ),
                            1 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    array(
                                        'sire_uid' => 756946,
                                        'horse_uid' => 1002606,
                                        'horse_style_name' => 'Private Matter',
                                        'horse_country_origin_code' => 'GB',
                                        'dam_sire_uid' => 584911,
                                        'dam_sire_style_name' => 'Azamour',
                                        'dam_sire_country_origin_code' => 'IRE',
                                        'rpr' => 100,
                                    )
                                ),
                        ),
                    763453 =>
                        array(
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 763453,
                                    'horse_uid' => 1018555,
                                    'horse_style_name' => 'Queen Kindly',
                                    'horse_country_origin_code' => 'GB',
                                    'dam_sire_uid' => 13903,
                                    'dam_sire_style_name' => 'Rahy',
                                    'dam_sire_country_origin_code' => 'USA',
                                    'rpr' => 112,
                                )
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 763453,
                                    'horse_uid' => 1259865,
                                    'horse_style_name' => 'Soul Stirring',
                                    'horse_country_origin_code' => 'JPN',
                                    'dam_sire_uid' => 84824,
                                    'dam_sire_style_name' => 'Monsun',
                                    'dam_sire_country_origin_code' => 'GER',
                                    'rpr' => 112,
                                )
                            ),
                        ),
                    800166 =>
                        array(
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 800166,
                                    'horse_uid' => 1043709,
                                    'horse_style_name' => 'Sir Dancealot',
                                    'horse_country_origin_code' => 'IRE',
                                    'dam_sire_uid' => 104011,
                                    'dam_sire_style_name' => 'Danehill Dancer',
                                    'dam_sire_country_origin_code' => 'IRE',
                                    'rpr' => 107,
                                )
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 800166,
                                    'horse_uid' => 1004057,
                                    'horse_style_name' => 'Madam Dancealot',
                                    'horse_country_origin_code' => 'IRE',
                                    'dam_sire_uid' => 42373,
                                    'dam_sire_style_name' => 'Danehill',
                                    'dam_sire_country_origin_code' => 'USA',
                                    'rpr' => 100,
                                )
                            ),
                        ),
                ),
        ];

        $sires = $data[$this->getKey()];
        foreach ($sires as $id => $progeny) {
            $sires[$id] = array_slice($progeny, 0, $progenyPerformersLimit);
        }

        return $sires;
    }
}
