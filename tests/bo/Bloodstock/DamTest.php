<?php

namespace Tests\Bo\Bloodstock;

class DamTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyEntries $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetProgenyEntries
     */
    public function testGetProgenyEntries(
        \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyEntries $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Bloodstock\Dam($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getProgenyEntries())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyEntries()
    {
        return[
            [
                new \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyEntries([], ['damId' => 585723]),
                [
                    [
                        "race_instance_uid" => 614446,
                        "race_datetime" => "Jun  4 2016  4:00PM",
                        "distance_yard" => 2650,
                        "race_instance_title" => "Investec Derby (Group 1) (Entire Colts & Fillies)",
                        "race_status_code" => "C",
                        "prize_sterling" => 751407,
                        "course_name" => "EPSOM",
                        "course_style_name" => "Epsom",
                        "course_uid" => 17,
                        "rp_going_type_desc" => null,
                        "no_of_runners" => 475,
                        "style_name" => "00ouija Board",
                        "horse_uid" => 875278
                    ]
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResults $request
     * @param array $expectedResult
     *
     *  @dataProvider providerTestGetProgenyResults
     */
    public function testGetProgenyResults(
        \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResults $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Bloodstock\Dam($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getProgenyResults($request))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyResults()
    {
        return[
            [
                new \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResults([], ['damId' => 585723]),
                [
                    'FLAT' => [
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 826492,
                            'style_name' => 'Australia',
                            'country_origin_code' => 'GB',
                            'h_yob' => 2011,
                            'horse_sex_code' => 'C',
                            'runs' => 8,
                            'wins' => 5,
                            'places' => 3,
                            'total_prize_money' => 2090502.8781,
                            'stakes_winner' => 6,
                            'sire_uid' => 82642,
                            'sire_style_name' => 'Galileo',
                            'sire_country_origin_code' => 'IRE',
                            'rp_postmark' => 129,
                            'avg_flat_win_dist_of_progeny' => 11.2,
                            'distance_yard' => 1223,
                            'place_1st_number' => 5,
                            'races_number' => 8,
                            'trainer_uid' => 7978,
                            'trainer_name' => 'A P O\'Brien'
                        ],
                        [
                            'main_type' => 'FLAT',
                            'horse_uid' => 826493,
                            'style_name' => 'Australia',
                            'country_origin_code' => 'GB',
                            'h_yob' => 2011,
                            'horse_sex_code' => 'C',
                            'runs' => 8,
                            'wins' => 5,
                            'places' => 3,
                            'total_prize_money' => 2090502.8781,
                            'stakes_winner' => 6,
                            'sire_uid' => 82642,
                            'sire_style_name' => 'Galileo',
                            'sire_country_origin_code' => 'IRE',
                            'rp_postmark' => 129,
                            'avg_flat_win_dist_of_progeny' => null,
                            'distance_yard' => 1223,
                            'place_1st_number' => 4,
                            'races_number' => 27,
                            'trainer_uid' => 13495,
                            'trainer_name' => 'Chris Waller'
                        ],
                    ],
                    'JUMPS' => [
                        \Api\Row\Ads\WinnerAndRaceInfo::createFromArray([
                            'main_type' => 'JUMPS',
                            'horse_uid' => 826494,
                            'style_name' => 'Australia',
                            'country_origin_code' => 'GB',
                            'h_yob' => 2011,
                            'horse_sex_code' => 'C',
                            'runs' => 8,
                            'wins' => 5,
                            'places' => 3,
                            'total_prize_money' => 2090502.8781,
                            'stakes_winner' => 6,
                            'sire_uid' => 82642,
                            'sire_style_name' => 'Galileo',
                            'sire_country_origin_code' => 'IRE',
                            'rp_postmark' => 129,
                            'avg_flat_win_dist_of_progeny' => null,
                            'distance_yard' => 1223,
                            'place_1st_number' => 4,
                            'races_number' => 27,
                            'trainer_uid' => 13495,
                            'trainer_name' => 'Chris Waller'
                        ]),
                    ],
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSalesDefault $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetProgenyResultsSalesDefault
     */
    public function testGetProgenyResultsSalesDefault(
        \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSalesDefault $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Bloodstock\Dam($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getProgenyResultsSalesDefault($request))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyResultsSalesDefault()
    {
        return[
            [
                new \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSalesDefault([], ['damId' => 585723]),
                [
                    [
                        'main_type' => 'FLAT',
                        'horse_uid' => 826492,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => 11.2,
                        'distance_yard' => 1223,
                        'place_1st_number' => 5,
                        'races_number' => 8,
                        'trainer_uid' => 7978,
                        'trainer_name' => 'A P O\'Brien'
                    ],
                    [
                        'main_type' => 'FLAT',
                        'horse_uid' => 826493,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => null,
                        'distance_yard' => 1223,
                        'place_1st_number' => 4,
                        'races_number' => 27,
                        'trainer_uid' => 13495,
                        'trainer_name' => 'Chris Waller'
                    ],
                ]
            ],
            [
                new \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSalesDefault([], ['damId' => 585725]),
                [
                    [
                        'main_type' => 'JUMPS',
                        'horse_uid' => 826492,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => 11.2,
                        'distance_yard' => 1223,
                        'place_1st_number' => 5,
                        'races_number' => 8,
                        'trainer_uid' => 7978,
                        'trainer_name' => 'A P O\'Brien'
                    ],
                    [
                        'main_type' => 'JUMPS',
                        'horse_uid' => 826493,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => null,
                        'distance_yard' => 1223,
                        'place_1st_number' => 4,
                        'races_number' => 27,
                        'trainer_uid' => 13495,
                        'trainer_name' => 'Chris Waller'
                    ],
                ]
            ],
            [
                new \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSalesDefault([], ['damId' => 585726]),
                [
                    [
                        'main_type' => 'FLAT',
                        'horse_uid' => 826492,
                        'style_name' => 'Australia',
                        'country_origin_code' => 'GB',
                        'h_yob' => 2011,
                        'horse_sex_code' => 'C',
                        'runs' => 8,
                        'wins' => 5,
                        'places' => 3,
                        'total_prize_money' => 2090502.8781,
                        'stakes_winner' => 6,
                        'sire_uid' => 82642,
                        'sire_style_name' => 'Galileo',
                        'sire_country_origin_code' => 'IRE',
                        'rp_postmark' => 129,
                        'avg_flat_win_dist_of_progeny' => 11.2,
                        'distance_yard' => 1223,
                        'place_1st_number' => 5,
                        'races_number' => 8,
                        'trainer_uid' => 7978,
                        'trainer_name' => 'A P O\'Brien'
                    ],
                ]
            ]
        ];
    }


    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenySales $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetProgenySales
     */
    public function testGetProgenySales(
        \Api\Input\Request\Horses\Bloodstock\Dam\ProgenySales $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Bloodstock\Dam($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getProgenySales())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenySales()
    {
        return[
            [
                new \Api\Input\Request\Horses\Bloodstock\Dam\ProgenySales(
                    ['2000-01-01', '2015-01-01'],
                    ['damId' => 412046]
                ),
                [
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
                    ],
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
                    ],
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
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSeasons $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetProgenyResultsSeasons
     */
    public function testGetProgenyResultsSeasons(
        \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSeasons $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Bloodstock\Dam($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getProgenyResultsSeasons())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyResultsSeasons()
    {
        return[
            [
                new \Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsSeasons([], ['damId' => 585723]),
                [
                    'FLAT' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'season_type' => 'FLAT',
                            'season_start_date' => '2011-01-01T00:00:00+00:00',
                            'season_end_date' => '2011-12-31T23:59:00+00:00',
                            'season_desc' => 'Flat 2011',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'season_type' => 'FLAT',
                            'season_start_date' => '2012-01-01T00:00:00+00:00',
                            'season_end_date' => '2012-12-31T23:59:00+00:00',
                            'season_desc' => 'Flat 2012',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'season_type' => 'FLAT',
                            'season_start_date' => '2013-01-01T00:00:00+00:00',
                            'season_end_date' => '2013-12-31T23:59:00+00:00',
                            'season_desc' => 'Flat 2013',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'season_type' => 'FLAT',
                            'season_start_date' => '2014-01-01T00:00:00+00:00',
                            'season_end_date' => '2014-12-31T23:59:00+00:00',
                            'season_desc' => 'Flat 2014',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'season_type' => 'FLAT',
                            'season_start_date' => '2015-01-01T00:00:00+00:00',
                            'season_end_date' => '2015-12-31T23:59:00+00:00',
                            'season_desc' => 'Flat 2015',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'season_type' => 'FLAT',
                            'season_start_date' => '2016-01-01T00:00:00+00:00',
                            'season_end_date' => '2016-12-31T23:59:00+00:00',
                            'season_desc' => 'Flat 2016',
                        ]),
                    ]
                ]
            ]
        ];
    }
}
