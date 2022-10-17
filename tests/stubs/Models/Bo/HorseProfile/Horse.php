<?php

namespace Tests\Stubs\Models\Bo\HorseProfile;

use Phalcon\Mvc\Model\Exception as Exception;
use Phalcon\Mvc\Model as Model;

/**
 * Class Horse
 *
 * @package Tests\Stubs\Models\Bo\HorseProfile
 */
class Horse extends \Tests\Stubs\Models\Horse
{
    /**
     * @param int $horseUid
     *
     * @return Model\Row
     */
    public function getHorseDataForProfileInIndex($horseUid)
    {
        $results = [
            867979 => \Api\Row\Horse::createFromArray(
                [
                    'horse_date_of_birth' => 'Feb 29 2012 12:00AM',
                    'horse_date_of_death' => null,
                    'country_origin_code' => 'GB',
                    'style_name' => 'Ali Bin Nayef',
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'G',
                    'date_gelded' => 'Aug 31 2014 12:00AM',
                    'owner_name' => 'Colin Stirling',
                    'owner_uid' => 230530,
                    'trainer_name' => 'Michael Wigham',
                    'trainer_uid' => 14013,
                    'breeder_name' => 'Sheikh Hamdan Bin Maktoum Al Maktoum'
                ]
            ),
        ];

        return isset($results[$horseUid]) ? $results[$horseUid] : null;
    }

    /**
     * @param $horseUid
     * @return mixed|null
     */
    public function getHorseDataForProfile($horseUid)
    {
        $results = [
            867979 => \Api\Row\Horse::createFromArray(
                [
                    'horse_date_of_birth' => 'Feb 29 2012 12:00AM',
                    'horse_date_of_death' => null,
                    'country_origin_code' => 'GB',
                    'sire_uid' => 522845,
                    'dam_uid' => 686929,
                    'style_name' => 'Ali Bin Nayef',
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'G',
                    'date_gelded' => 'Aug 31 2014 12:00AM',
                    'sire_horse_name' => 'Nayef',
                    'sire_country_origin_code' => 'USA',
                    'avg_flat_win_dist' => null,
                    'sire_avg_flat_win_dist' => 10.4,
                    'dam_horse_name' => 'Maimoona',
                    'dam_country_origin_code' => 'IRE',
                    'dam_sire_horse_name' => 'Pivotal',
                    'dam_sire_avg_flat_win_dist' => 7.9000000000000004,
                    'owner_name' => 'Colin Stirling',
                    'owner_search_name' => 'COLINSTIRLING',
                    'owner_uid' => 230530,
                    'owner_ptp_type_code' => 'N',
                    'trainer_name' => 'Michael Wigham',
                    'trainer_uid' => 14013,
                    'trainer_ptp_type_code' => 'N',
                    'trainer_search_name' => 'WIGHAM',
                    'trainer_location' => 'Newmarket, Suffolk',
                    'breeder_name' => 'Sheikh Hamdan Bin Maktoum Al Maktoum',
                    'horse_uid' => 867979,
                    'dam_sire_country_origin_code' => 'GB',
                    'dam_status' => 0,
                    'dam_sire_uid' => 107700,
                    'sire_status' => 0,
                    'horse_sex' => 'gelding',
                    'horse_colour' => 'b',
                    'sire_comment' => null,
                    'avg_win_distance' => null,
                    'sire_avg_win_distance' => '11.064730639730641',
                    'dam_sire_avg_win_distance' => '7.7338433843384333',
                    'avg_earnings_index' => null,
                    'weatherbys_uid' => null,
                ]
            ),
        ];

        return isset($results[$horseUid]) ? $results[$horseUid] : null;
    }

    /**
     * @param $horseUid
     *
     * @return null
     */
    public function getToFollow($horseUid)
    {
        $results = [
            867979 => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'to_follow_uid' => 13,
                        'to_follow_desc' => 'HIT Sale a',
                        "to_follow_code" => "g",
                    ]
                )
            ]
        ];
        return isset($results[$horseUid]) ? $results[$horseUid] : null;
    }

    /**
     * @param $stallionId
     *
     * @return array
     */
    public function getStudFee($stallionId)
    {
        return array(
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'private',
                    'nomination_year' => 2016,
                    'stud_name' => 'Coolmore Stud',
                    'country_code' => 'IRE',
                    'cur_code' => 'EUR',
                    'exchange_rate' => 1.3600000000000001,
                    'is_poa' => 'Y',
                    'gbp' => null,
                )
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'nomination_fee' => 0,
                    'stud_fee_condition' => 'Private',
                    'nomination_year' => 2015,
                    'stud_name' => 'Coolmore Stud',
                    'country_code' => 'IRE',
                    'cur_code' => 'EUR',
                    'exchange_rate' => 1.29,
                    'is_poa' => 'Y',
                    'gbp' => null,
                )
            )
        );
    }

    /**
     * @param array $horseUidArray
     *
     * @return Model\Row
     */
    public function getHorseDataForPedigree(array $horseUidArray)
    {
        $sireStub = new \Tests\Stubs\Models\Sire();
        $result = [];

        foreach ($horseUidArray as $horseUid) {
            $horse = $this->getHorseByUid($horseUid);

            if ($horse) {
                $horse = \Api\Row\Horse::createFromArray(
                    [
                        'horse_uid' => $horse->horse_uid,
                        'style_name' => $horse->style_name,
                        'country_origin_code' => $horse->country_origin_code,
                        'horse_date_of_birth' => $horse->horse_date_of_birth,
                        'sire_uid' => $horse->sire_uid,
                        'dam_uid' => $horse->dam_uid,
                    ]
                );

                $sire = $sireStub->getBySireUid($horseUid);
                $horse->avg_flat_win_dist_of_progeny = $sire ? $sire->avg_flat_win_dist_of_progeny : null;

                $result[$horseUid] = $horse;
            }
        }

        return $result;
    }

    /**
     * @param $horseId
     *
     * @return array|void
     */
    public function getRelatives($horseId)
    {
        $relatives = [
            1119176 => [
                'FLAT' => [
                    0 => \Api\Row\HorseProfile\Relative::createFromArray(
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 732341,
                            'style_name' => 'Reggane',
                            'country_origin_code' => 'GB',
                            'h_yob' => 2006,
                            'horse_sex_code' => 'M',
                            'sire_uid' => 305033,
                            'sire_style_name' => 'Red Ransom',
                            'sire_ctry_orig' => 'USA',
                            'avg_flat_win_dist_of_progeny' => 8.8000000000000007,
                            'runs' => 13,
                            'wins' => 3,
                            'places' => 5,
                            'total_prize_money' => 519024.08000000002,
                            "euro_total_prize_money" => 0,
                            'stakes_winner' => 7,
                            'rp_postmark' => 115,
                            'distance_yard' => 1760,
                            'trainer_uid' => 1172,
                            'trainer_name' => 'A De Royer-Dupre',
                        ]
                    ),
                    1 => \Api\Row\HorseProfile\Relative::createFromArray(
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 836388,
                            'style_name' => 'Relizane',
                            'country_origin_code' => 'GB',
                            'h_yob' => 2009,
                            'horse_sex_code' => 'M',
                            'sire_uid' => 450077,
                            'sire_style_name' => 'Zamindar',
                            'sire_ctry_orig' => 'USA',
                            'avg_flat_win_dist_of_progeny' => 8.9000000000000004,
                            'runs' => 6,
                            'wins' => 0,
                            'places' => 3,
                            'total_prize_money' => 14146.34,
                            "euro_total_prize_money" => 0,
                            'stakes_winner' => 0,
                            'rp_postmark' => 91,
                            'distance_yard' => 2200,
                            'trainer_uid' => 1172,
                            'trainer_name' => 'A De Royer-Dupre',
                        ]
                    ),
                    2 => \Api\Row\HorseProfile\Relative::createFromArray(
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 841908,
                            'style_name' => 'Flying Cape',
                            'country_origin_code' => 'IRE',
                            'h_yob' => 2011,
                            'horse_sex_code' => 'G',
                            'sire_uid' => 450464,
                            'sire_style_name' => 'Cape Cross',
                            'sire_ctry_orig' => 'IRE',
                            'avg_flat_win_dist_of_progeny' => 9.1999999999999993,
                            'runs' => 29,
                            'wins' => 1,
                            'places' => 8,
                            'total_prize_money' => 29493.580000000002,
                            "euro_total_prize_money" => 0,
                            'stakes_winner' => 0,
                            'rp_postmark' => 84,
                            'distance_yard' => 2200,
                            'trainer_uid' => 28134,
                            'trainer_name' => 'Andrew Hollinshead',
                        ]
                    ),
                    3 => \Api\Row\HorseProfile\Relative::createFromArray(
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 781692,
                            'style_name' => 'Rotti',
                            'country_origin_code' => 'GB',
                            'h_yob' => 2008,
                            'horse_sex_code' => 'M',
                            'sire_uid' => 567732,
                            'sire_style_name' => 'Dalakhani',
                            'sire_ctry_orig' => 'IRE',
                            'avg_flat_win_dist_of_progeny' => 11.300000000000001,
                            'runs' => 4,
                            'wins' => 0,
                            'places' => 1,
                            'total_prize_money' => 4353.4499999999998,
                            "euro_total_prize_money" => 0,
                            'stakes_winner' => 0,
                            'rp_postmark' => 82,
                            'distance_yard' => 2640,
                            'trainer_uid' => 1172,
                            'trainer_name' => 'A De Royer-Dupre',
                        ]
                    ),
                    4 => \Api\Row\HorseProfile\Relative::createFromArray(
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 755833,
                            'style_name' => 'Zaoking',
                            'country_origin_code' => 'IRE',
                            'h_yob' => 2007,
                            'horse_sex_code' => 'H',
                            'sire_uid' => 107700,
                            'sire_style_name' => 'Pivotal',
                            'sire_ctry_orig' => 'GB',
                            'avg_flat_win_dist_of_progeny' => 7.9000000000000004,
                            'runs' => 11,
                            'wins' => 0,
                            'places' => 0,
                            'total_prize_money' => 1034.48,
                            "euro_total_prize_money" => 0,
                            'stakes_winner' => 0,
                            'rp_postmark' => 82,
                            'distance_yard' => 1760,
                            'trainer_uid' => 13511,
                            'trainer_name' => 'Rod Collet',
                        ]
                    ),
                    5 => \Api\Row\HorseProfile\Relative::createFromArray(
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 800422,
                            'style_name' => 'My History',
                            'country_origin_code' => 'IRE',
                            'h_yob' => 2010,
                            'horse_sex_code' => 'H',
                            'sire_uid' => 589690,
                            'sire_style_name' => 'Dubawi',
                            'sire_ctry_orig' => 'IRE',
                            'avg_flat_win_dist_of_progeny' => 9.5999999999999996,
                            'runs' => 8,
                            'wins' => 1,
                            'places' => 1,
                            'total_prize_money' => 4065.8499999999999,
                            "euro_total_prize_money" => 0,
                            'stakes_winner' => 0,
                            'rp_postmark' => 79,
                            'distance_yard' => 2189,
                            'trainer_uid' => 3378,
                            'trainer_name' => 'Mark Johnston',
                        ]
                    ),
                    6 => \Api\Row\HorseProfile\Relative::createFromArray(
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 682844,
                            'style_name' => 'Ramita',
                            'country_origin_code' => 'GB',
                            'h_yob' => 2005,
                            'horse_sex_code' => 'M',
                            'sire_uid' => 511443,
                            'sire_style_name' => 'Fasliyev',
                            'sire_ctry_orig' => 'USA',
                            'avg_flat_win_dist_of_progeny' => 7.2999999999999998,
                            'runs' => 4,
                            'wins' => 0,
                            'places' => 1,
                            'total_prize_money' => 4729.8900000000003,
                            "euro_total_prize_money" => 0,
                            'stakes_winner' => 0,
                            'rp_postmark' => 77,
                            'distance_yard' => 1320,
                            'trainer_uid' => 1093,
                            'trainer_name' => 'A Fabre',
                        ]
                    ),
                ],
            ]
        ];
        return isset($relatives[$horseId]) ? $relatives[$horseId] : null;
    }

    /**
     * @param int $horseId
     *
     * @return array
     * @throws \Api\Exception\NotFound
     */
    public function getSales($horseId)
    {
        $data = [
            787575 => [
                        "horse_uid" => 787575,
                        "sales" => [
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'buyer_detail' => 'Withdrawn',
                                    'price' => null,
                                    'sale_date' => 'Oct 18 2013 12:00AM',
                                    'venue_desc' => 'BADEN-BADEN',
                                    'venue_uid' => 25,
                                    'lot_no' => 32,
                                    'lot_letter' => ' ',
                                    'seller_name' => 'From Gestut Directa',
                                    'cur_code' => 'EUR',
                                    'sale_name' => 'BBAG October Mixed Sale 2013',
                                    'abbrev_name' => 'BBAG October',
                                    'sale_type' => 'Y'

                                ]
                            ),
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'buyer_detail' => 'Not Sold',
                                    'price' => 26000,
                                    'sale_date' => 'Jun  4 2010 12:00AM',
                                    'venue_desc' => 'BADEN-BADEN',
                                    'venue_uid' => 25,
                                    'lot_no' => 59,
                                    'lot_letter' => ' ',
                                    'seller_name' => 'From Gestut Directa',
                                    'cur_code' => 'EUR',
                                    'sale_name' => 'Baden-Baden Spring Horses in Training Sale 2010',
                                    'abbrev_name' => 'BBAG Spring HIT',
                                    'sale_type' => 'Y'
                                ]
                            ),
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'buyer_detail' => 'Vendor',
                                    'price' => 58000,
                                    'sale_date' => 'Sep  5 2009 12:00AM',
                                    'venue_desc' => 'BADEN-BADEN',
                                    'venue_uid' => 25,
                                    'lot_no' => 132,
                                    'lot_letter' => ' ',
                                    'seller_name' => 'From Gestut Directa',
                                    'cur_code' => 'EUR',
                                    'sale_name' => 'BBAG Yearling Sale',
                                    'abbrev_name' => 'BBAG September',
                                    'sale_type' => 'Y'
                                ]
                            ),
                        ]
            ]
        ];

        return $data;
    }
}
