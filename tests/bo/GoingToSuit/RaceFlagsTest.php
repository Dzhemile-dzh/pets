<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 5/5/2017
 * Time: 5:40 PM
 */

namespace Tests\Bo\GoingToSuit;

use Api\Input\Request\Horses\GoingToSuit as Request;
use Tests\Stubs\Bo\GoingToSuit\RaceFlags;

class RaceFlagsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request\RaceFlags $request
     * @param                   $expectedResult
     *
     * @dataProvider dataProviderTestGetRaceFlagsSuccess
     */
    public function testGetRaceFlagsSuccess(Request\RaceFlags $request, $expectedResult)
    {
        $bo = new RaceFlags($request);
        $this->assertEquals($expectedResult, $bo->getRaceFlags());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetRaceFlagsSuccess()
    {
        return [
            [
                new Request\RaceFlags(
                    [
                        1
                    ],
                    []
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'race_instance_uid' => 673422,
                        'race_datetime' => 'May  9 2017  2:00PM',
                        'race_type_code' => 'F',
                        'going_type_code' => 'GF',
                        'going_type_desc' => 'Good To Firm',
                        'horses' => [
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1355229,
                                    'horse_style_name' => 'Calypso Jo',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 448003,
                                    'sire_style_name' => 'Bahamian Bounty',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 91867,
                                    'jockey_style_name' => 'Kevin Stott',
                                    'trainer_uid' => 22525,
                                    'trainer_style_name' => 'Kevin Ryan',
                                    'owner_uid' => 213757,
                                    'owner_style_name' => 'Guy Reed Racing',
                                    'non_runner' => null,
                                    'draw' => 3,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 78,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 1,
                                    'going_form' => null,
                                ]
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998357,
                                    'horse_style_name' => 'Dalton',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 756946,
                                    'sire_style_name' => 'Mayson',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 82231,
                                    'jockey_style_name' => 'Daniel Tudhope',
                                    'trainer_uid' => 22839,
                                    'trainer_style_name' => 'David O\'Meara',
                                    'owner_uid' => 126605,
                                    'owner_style_name' => 'David W Armstrong',
                                    'non_runner' => null,
                                    'draw' => 2,
                                    'rp_topspeed' => 61,
                                    'rp_postmark' => 76,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 2,
                                    'going_form' => null,
                                ]
                            ),
                            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1096828,
                                    'horse_style_name' => 'Hee Haw',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 589184,
                                    'sire_style_name' => 'Sleeping Indian',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 2572,
                                    'jockey_style_name' => 'Joe Fanning',
                                    'trainer_uid' => 24548,
                                    'trainer_style_name' => 'Keith Dalgleish',
                                    'owner_uid' => 2015,
                                    'owner_style_name' => 'Mrs Janis Macpherson',
                                    'non_runner' => null,
                                    'draw' => 4,
                                    'rp_topspeed' => 73,
                                    'rp_postmark' => 79,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 3,
                                    'going_form' => null,
                                ]
                            ),
                            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1035092,
                                    'horse_style_name' => 'Poet\'s Reward',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 655133,
                                    'sire_style_name' => 'Hellvelyn',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 81149,
                                    'jockey_style_name' => 'Phillip Makin',
                                    'trainer_uid' => 542,
                                    'trainer_style_name' => 'David Barron',
                                    'owner_uid' => 59635,
                                    'owner_style_name' => 'Laurence O\'Kane',
                                    'non_runner' => null,
                                    'draw' => 6,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 86,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 4,
                                    'going_form' => null,
                                ]
                            ),
                            4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998410,
                                    'horse_style_name' => 'England Expects',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 660604,
                                    'sire_style_name' => 'Mount Nelson',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 93480,
                                    'jockey_style_name' => 'Clifford Lee',
                                    'trainer_uid' => 5019,
                                    'trainer_style_name' => 'K R Burke',
                                    'owner_uid' => 218616,
                                    'owner_style_name' => 'Tim Dykes & Jon Hughes',
                                    'non_runner' => null,
                                    'draw' => 1,
                                    'rp_topspeed' => 48,
                                    'rp_postmark' => 74,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 5,
                                    'going_form' => null,
                                ]
                            ),
                            5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1048757,
                                    'horse_style_name' => 'Miss Quick',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 692355,
                                    'sire_style_name' => 'Equiano',
                                    'sire_country' => 'FR',
                                    'jockey_uid' => 90103,
                                    'jockey_style_name' => 'Shane Gray',
                                    'trainer_uid' => 5372,
                                    'trainer_style_name' => 'Ann Duffield',
                                    'owner_uid' => 167464,
                                    'owner_style_name' => 'J Acheson',
                                    'non_runner' => null,
                                    'draw' => 5,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 55,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 6,
                                    'going_form' => null,
                                ]
                            ),
                        ],
                    ]
                ),
            ]
        ];
    }

    /**
     * @expectedException \Api\Exception\NotFound
     * @expectedExceptionCode 14000
     *
     * @dataProvider          dataProviderTestGetRaceFailure
     *
     * @param Request\RaceFlags $request
     */
    public function testGetRaceFailure(Request\RaceFlags $request)
    {
        $bo = new RaceFlags($request);
        $bo->getRaceFlags();
    }

    /**
     * @return array
     */
    public function dataProviderTestGetRaceFailure()
    {
        return [
            [
                new Request\RaceFlags(
                    [777],
                    []
                )
            ]
        ];
    }

    /**
     * @dataProvider dataProviderTestBuildRaceFlagsSuccess
     *
     * @param Request\RaceFlags $request
     * @param                   $row
     * @param                   $expectedResult
     * @param                   $rowsHorse
     * @param                   $additionalData
     */
    public function testBuildRaceFlagsSuccess(
        Request\RaceFlags $request,
        $row,
        $expectedResult,
        $rowsHorse,
        $additionalData
    ) {
        $bo = new RaceFlags($request);
        $reflected = new \ReflectionClass($bo);

        $rowProperty = $reflected->getParentClass()->getProperty('row');
        $rowProperty->setAccessible(true);

        $rowProperty->setValue($bo, $row);

        $bo->buildRaceFlags($rowsHorse, $additionalData);

        $this->assertEquals($expectedResult, $rowProperty->getValue($bo));
    }

    /**
     * @return array
     */
    public function dataProviderTestBuildRaceFlagsSuccess()
    {
        return [
            [
                new Request\RaceFlags([1], []),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'race_instance_uid' => 673422,
                        'race_datetime' => 'May  9 2017  2:00PM',
                        'going_type_code' => 'GF',
                        'going_type_desc' => 'Good To Firm',
                        'horses' => [
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1355229,
                                    'horse_style_name' => 'Calypso Jo',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 448003,
                                    'sire_style_name' => 'Bahamian Bounty',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 91867,
                                    'jockey_style_name' => 'Kevin Stott',
                                    'trainer_uid' => 22525,
                                    'trainer_style_name' => 'Kevin Ryan',
                                    'owner_uid' => 213757,
                                    'owner_style_name' => 'Guy Reed Racing',
                                    'non_runner' => null,
                                    'draw' => 3,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 78,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 1,
                                    'going_form' => null,
                                ]
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998357,
                                    'horse_style_name' => 'Dalton',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 756946,
                                    'sire_style_name' => 'Mayson',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 82231,
                                    'jockey_style_name' => 'Daniel Tudhope',
                                    'trainer_uid' => 22839,
                                    'trainer_style_name' => 'David O\'Meara',
                                    'owner_uid' => 126605,
                                    'owner_style_name' => 'David W Armstrong',
                                    'non_runner' => null,
                                    'draw' => 2,
                                    'rp_topspeed' => 61,
                                    'rp_postmark' => 76,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 2,
                                    'going_form' => null,
                                ]
                            ),
                            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1096828,
                                    'horse_style_name' => 'Hee Haw',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 589184,
                                    'sire_style_name' => 'Sleeping Indian',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 2572,
                                    'jockey_style_name' => 'Joe Fanning',
                                    'trainer_uid' => 24548,
                                    'trainer_style_name' => 'Keith Dalgleish',
                                    'owner_uid' => 2015,
                                    'owner_style_name' => 'Mrs Janis Macpherson',
                                    'non_runner' => null,
                                    'draw' => 4,
                                    'rp_topspeed' => 73,
                                    'rp_postmark' => 79,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 3,
                                    'going_form' => null,
                                ]
                            ),
                            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1035092,
                                    'horse_style_name' => 'Poet\'s Reward',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 655133,
                                    'sire_style_name' => 'Hellvelyn',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 81149,
                                    'jockey_style_name' => 'Phillip Makin',
                                    'trainer_uid' => 542,
                                    'trainer_style_name' => 'David Barron',
                                    'owner_uid' => 59635,
                                    'owner_style_name' => 'Laurence O\'Kane',
                                    'non_runner' => null,
                                    'draw' => 6,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 86,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 4,
                                    'going_form' => null,
                                ]
                            ),
                            4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998410,
                                    'horse_style_name' => 'England Expects',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 660604,
                                    'sire_style_name' => 'Mount Nelson',
                                    'sire_country' => 'GB',
                                    'jockey_uid' => 93480,
                                    'jockey_style_name' => 'Clifford Lee',
                                    'trainer_uid' => 5019,
                                    'trainer_style_name' => 'K R Burke',
                                    'owner_uid' => 218616,
                                    'owner_style_name' => 'Tim Dykes & Jon Hughes',
                                    'non_runner' => null,
                                    'draw' => 1,
                                    'rp_topspeed' => 48,
                                    'rp_postmark' => 74,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 5,
                                    'going_form' => null,
                                ]
                            ),
                            5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1048757,
                                    'horse_style_name' => 'Miss Quick',
                                    'horse_country_origin_code' => 'IRE',
                                    'sire_uid' => 692355,
                                    'sire_style_name' => 'Equiano',
                                    'sire_country' => 'FR',
                                    'jockey_uid' => 90103,
                                    'jockey_style_name' => 'Shane Gray',
                                    'trainer_uid' => 5372,
                                    'trainer_style_name' => 'Ann Duffield',
                                    'owner_uid' => 167464,
                                    'owner_style_name' => 'J Acheson',
                                    'non_runner' => null,
                                    'draw' => 5,
                                    'rp_topspeed' => null,
                                    'rp_postmark' => 55,
                                    'rp_owner_choice' => 'a',
                                    'start_number' => 6,
                                    'going_form' => null,
                                ]
                            ),
                        ],
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'race_instance_uid' => 673422,
                        'race_datetime' => 'May  9 2017  2:00PM',
                        'going_type_code' => 'GF',
                        'going_type_desc' => 'Good To Firm',
                        'horses' => [
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1355229,
                                    'horse_style_name' => 'Calypso Jo',
                                    'horse_country_origin_code' => 'IRE',
                                    'wins_flag' => null,
                                    'rpr_flat_flag' => null,
                                    'rpr_jumps_flag' => null,
                                    'topspeed_flag' => null,
                                    'sire_flag' => null,
                                ]
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998357,
                                    'horse_style_name' => 'Dalton',
                                    'horse_country_origin_code' => 'IRE',
                                    'wins_flag' => false,
                                    'rpr_flat_flag' => true,
                                    'rpr_jumps_flag' => false,
                                    'topspeed_flag' => false,
                                    'sire_flag' => false,
                                ]
                            ),
                            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1096828,
                                    'horse_style_name' => 'Hee Haw',
                                    'horse_country_origin_code' => 'IRE',
                                    'wins_flag' => false,
                                    'rpr_flat_flag' => true,
                                    'rpr_jumps_flag' => false,
                                    'topspeed_flag' => false,
                                    'sire_flag' => false,
                                ]
                            ),
                            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1035092,
                                    'horse_style_name' => 'Poet\'s Reward',
                                    'horse_country_origin_code' => 'IRE',
                                    'wins_flag' => null,
                                    'rpr_flat_flag' => null,
                                    'rpr_jumps_flag' => null,
                                    'topspeed_flag' => null,
                                    'sire_flag' => null,
                                ]
                            ),
                            4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998410,
                                    'horse_style_name' => 'England Expects',
                                    'horse_country_origin_code' => 'IRE',
                                    'wins_flag' => false,
                                    'rpr_flat_flag' => true,
                                    'rpr_jumps_flag' => false,
                                    'topspeed_flag' => true,
                                    'sire_flag' => false,
                                ]
                            ),
                            5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1048757,
                                    'horse_style_name' => 'Miss Quick',
                                    'horse_country_origin_code' => 'IRE',
                                    'wins_flag' => null,
                                    'rpr_flat_flag' => null,
                                    'rpr_jumps_flag' => null,
                                    'topspeed_flag' => null,
                                    'sire_flag' => null,
                                ]
                            ),
                        ],
                    ]
                ),
                [
                    998357 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'heavy_soft' => null,
                            'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998357,
                                    'runs' => 1,
                                    'wins' => 0,
                                    'going_group' => 'good_to_soft',
                                    'going_form' => [
                                        0 => 3,
                                    ],
                                    'top_rpr_flat' => true,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => true,
                                    'topspeed_flat_race' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_uid' => 998357,
                                            'going_type_code' => 'GS',
                                            'rp_topspeed' => 51,
                                            'race_instance_uid' => 649430,
                                            'race_datetime' => 'May 18 2016  1:30PM',
                                            'course_uid' => 3,
                                            'course_name' => 'Ayr',
                                            'rp_abbrev_3' => 'AYR',
                                            'distance_yard' => 1320,
                                            'race_type_code' => 'F',
                                            'weight_carried_lbs' => 128,
                                            'race_outcome_position' => 3,
                                            'no_of_runners' => 6,
                                            'going_group' => 'good_to_soft',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998357,
                                    'runs' => 1,
                                    'wins' => 0,
                                    'going_group' => 'good',
                                    'going_form' => [
                                        0 => 4,
                                    ],
                                    'top_rpr_flat' => true,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_uid' => 998357,
                                            'going_type_code' => 'G',
                                            'rp_topspeed' => 13,
                                            'race_instance_uid' => 650704,
                                            'race_datetime' => 'Jun  2 2016  2:20PM',
                                            'course_uid' => 49,
                                            'course_name' => 'Ripon',
                                            'rp_abbrev_3' => 'RIP',
                                            'distance_yard' => 1320,
                                            'race_type_code' => 'F',
                                            'weight_carried_lbs' => 128,
                                            'race_outcome_position' => 4,
                                            'no_of_runners' => 10,
                                            'going_group' => 'good',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_firm' => null,
                            'firm' => null,
                        ]
                    ),
                    998410 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'heavy_soft' => null,
                            'good_to_soft' => null,
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 998410,
                                    'runs' => 1,
                                    'wins' => 0,
                                    'going_group' => 'good',
                                    'going_form' => [
                                        0 => 6,
                                    ],
                                    'top_rpr_flat' => true,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => true,
                                    'topspeed_flat_race' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_uid' => 998410,
                                            'going_type_code' => 'G',
                                            'rp_topspeed' => 33,
                                            'race_instance_uid' => 671166,
                                            'race_datetime' => 'Apr 11 2017  4:40PM',
                                            'course_uid' => 46,
                                            'course_name' => 'Pontefract',
                                            'rp_abbrev_3' => 'PON',
                                            'distance_yard' => 1320,
                                            'race_type_code' => 'F',
                                            'weight_carried_lbs' => 126,
                                            'race_outcome_position' => 6,
                                            'no_of_runners' => 10,
                                            'going_group' => 'good',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_firm' => null,
                            'firm' => null,
                        ]
                    ),
                    1096828 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'heavy_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1096828,
                                    'runs' => 1,
                                    'wins' => 0,
                                    'going_group' => 'heavy_soft',
                                    'going_form' => [
                                        0 => 2,
                                    ],
                                    'top_rpr_flat' => true,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => true,
                                    'topspeed_flat_race' => null,
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_soft' => null,
                            'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1096828,
                                    'runs' => 1,
                                    'wins' => 0,
                                    'going_group' => 'good',
                                    'going_form' => [
                                        0 => 6,
                                    ],
                                    'top_rpr_flat' => false,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_uid' => 1096828,
                                            'going_type_code' => 'G',
                                            'rp_topspeed' => 46,
                                            'race_instance_uid' => 659197,
                                            'race_datetime' => 'Oct 11 2016  2:20PM',
                                            'course_uid' => 16,
                                            'course_name' => 'Musselburgh',
                                            'rp_abbrev_3' => 'MUS',
                                            'distance_yard' => 1100,
                                            'race_type_code' => 'F',
                                            'weight_carried_lbs' => 131,
                                            'race_outcome_position' => 6,
                                            'no_of_runners' => 7,
                                            'going_group' => 'good',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                [
                                    'horse_uid' => 1096828,
                                    'runs' => 1,
                                    'wins' => 0,
                                    'going_group' => 'good_to_firm',
                                    'going_form' => [
                                        0 => 2,
                                    ],
                                    'top_rpr_flat' => true,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_uid' => 1096828,
                                            'going_type_code' => 'GF',
                                            'rp_topspeed' => 24,
                                            'race_instance_uid' => 656030,
                                            'race_datetime' => 'Aug 18 2016  5:40PM',
                                            'course_uid' => 22,
                                            'course_name' => 'Hamilton',
                                            'rp_abbrev_3' => 'HAM',
                                            'distance_yard' => 1326,
                                            'race_type_code' => 'F',
                                            'weight_carried_lbs' => 131,
                                            'race_outcome_position' => 2,
                                            'no_of_runners' => 4,
                                            'going_group' => 'good_to_firm',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'firm' => null,
                        ]
                    ),
                ],
                [
                    692355 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'sire_uid' => 692355,
                            'going_groups' => [
                                'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good',
                                        'wins' => 51,
                                        'runs' => 419,
                                        'sire_going_runs' => 419,
                                        'sire_going_wins' => 51,
                                        'win_percentage' => 12,
                                        'impact_value' => 0.35999999999999999,
                                    ]
                                ),
                                'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'heavy',
                                        'wins' => 1,
                                        'runs' => 26,
                                        'sire_going_runs' => 26,
                                        'sire_going_wins' => 1,
                                        'win_percentage' => 4,
                                        'impact_value' => 1.9399999999999999,
                                    ]
                                ),
                                'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'soft',
                                        'wins' => 20,
                                        'runs' => 187,
                                        'sire_going_runs' => 187,
                                        'sire_going_wins' => 20,
                                        'win_percentage' => 11,
                                        'impact_value' => 0.73999999999999999,
                                    ]
                                ),
                                'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'firm',
                                        'wins' => 6,
                                        'runs' => 33,
                                        'sire_going_runs' => 33,
                                        'sire_going_wins' => 6,
                                        'win_percentage' => 18,
                                        'impact_value' => 6.8899999999999997,
                                    ]
                                ),
                                'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_soft',
                                        'wins' => 20,
                                        'runs' => 214,
                                        'sire_going_runs' => 214,
                                        'sire_going_wins' => 20,
                                        'win_percentage' => 9,
                                        'impact_value' => 0.53000000000000003,
                                    ]
                                ),
                                'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_firm',
                                        'wins' => 54,
                                        'runs' => 384,
                                        'sire_going_runs' => 384,
                                        'sire_going_wins' => 54,
                                        'win_percentage' => 14,
                                        'impact_value' => 0.46000000000000002,
                                    ]
                                ),
                            ],
                        ]
                    ),
                    448003 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'sire_uid' => 448003,
                            'going_groups' => [
                                'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_firm',
                                        'wins' => 222,
                                        'runs' => 2502,
                                        'sire_going_runs' => 2502,
                                        'sire_going_wins' => 222,
                                        'win_percentage' => 9,
                                        'impact_value' => 0.26000000000000001,
                                    ]
                                ),
                                'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'heavy',
                                        'wins' => 24,
                                        'runs' => 215,
                                        'sire_going_runs' => 215,
                                        'sire_going_wins' => 24,
                                        'win_percentage' => 11,
                                        'impact_value' => 3.6899999999999999,
                                    ]
                                ),
                                'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'firm',
                                        'wins' => 28,
                                        'runs' => 262,
                                        'sire_going_runs' => 262,
                                        'sire_going_wins' => 28,
                                        'win_percentage' => 11,
                                        'impact_value' => 3.0299999999999998,
                                    ]
                                ),
                                'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_soft',
                                        'wins' => 117,
                                        'runs' => 1087,
                                        'sire_going_runs' => 1087,
                                        'sire_going_wins' => 117,
                                        'win_percentage' => 11,
                                        'impact_value' => 0.72999999999999998,
                                    ]
                                ),
                                'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good',
                                        'wins' => 230,
                                        'runs' => 2232,
                                        'sire_going_runs' => 2232,
                                        'sire_going_wins' => 230,
                                        'win_percentage' => 10,
                                        'impact_value' => 0.32000000000000001,
                                    ]
                                ),
                                'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'soft',
                                        'wins' => 86,
                                        'runs' => 917,
                                        'sire_going_runs' => 917,
                                        'sire_going_wins' => 86,
                                        'win_percentage' => 9,
                                        'impact_value' => 0.70999999999999996,
                                    ]
                                ),
                            ],
                        ]
                    ),
                    589184 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'sire_uid' => 589184,
                            'going_groups' => [
                                'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'heavy',
                                        'wins' => 4,
                                        'runs' => 59,
                                        'sire_going_runs' => 59,
                                        'sire_going_wins' => 4,
                                        'win_percentage' => 7,
                                        'impact_value' => 2.1800000000000002,
                                    ]
                                ),
                                'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'soft',
                                        'wins' => 22,
                                        'runs' => 295,
                                        'sire_going_runs' => 295,
                                        'sire_going_wins' => 22,
                                        'win_percentage' => 7,
                                        'impact_value' => 0.44,
                                    ]
                                ),
                                'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good',
                                        'wins' => 56,
                                        'runs' => 623,
                                        'sire_going_runs' => 623,
                                        'sire_going_wins' => 56,
                                        'win_percentage' => 9,
                                        'impact_value' => 0.27000000000000002,
                                    ]
                                ),
                                'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_firm',
                                        'wins' => 55,
                                        'runs' => 524,
                                        'sire_going_runs' => 524,
                                        'sire_going_wins' => 55,
                                        'win_percentage' => 10,
                                        'impact_value' => 0.34999999999999998,
                                    ]
                                ),
                                'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'firm',
                                        'wins' => 6,
                                        'runs' => 39,
                                        'sire_going_runs' => 39,
                                        'sire_going_wins' => 6,
                                        'win_percentage' => 15,
                                        'impact_value' => 7.0599999999999996,
                                    ]
                                ),
                                'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_soft',
                                        'wins' => 21,
                                        'runs' => 296,
                                        'sire_going_runs' => 296,
                                        'sire_going_wins' => 21,
                                        'win_percentage' => 7,
                                        'impact_value' => 0.42999999999999999,
                                    ]
                                ),
                            ],
                        ]
                    ),
                    756946 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'sire_uid' => 756946,
                            'going_groups' => [
                                'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_soft',
                                        'wins' => 2,
                                        'runs' => 29,
                                        'sire_going_runs' => 29,
                                        'sire_going_wins' => 2,
                                        'win_percentage' => 7,
                                        'impact_value' => 0.35999999999999999,
                                    ]
                                ),
                                'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good',
                                        'wins' => 8,
                                        'runs' => 47,
                                        'sire_going_runs' => 47,
                                        'sire_going_wins' => 8,
                                        'win_percentage' => 17,
                                        'impact_value' => 0.54000000000000004,
                                    ]
                                ),
                                'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_firm',
                                        'wins' => 4,
                                        'runs' => 54,
                                        'sire_going_runs' => 54,
                                        'sire_going_wins' => 4,
                                        'win_percentage' => 7,
                                        'impact_value' => 0.19,
                                    ]
                                ),
                                'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'firm',
                                        'wins' => 0,
                                        'runs' => 3,
                                        'sire_going_runs' => 3,
                                        'sire_going_wins' => 0,
                                        'win_percentage' => 0,
                                        'impact_value' => 0,
                                    ]
                                ),
                                'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'heavy',
                                        'wins' => 0,
                                        'runs' => 4,
                                        'sire_going_runs' => 4,
                                        'sire_going_wins' => 0,
                                        'win_percentage' => 0,
                                        'impact_value' => 0,
                                    ]
                                ),
                                'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'soft',
                                        'wins' => 2,
                                        'runs' => 13,
                                        'sire_going_runs' => 13,
                                        'sire_going_wins' => 2,
                                        'win_percentage' => 15,
                                        'impact_value' => 1.73,
                                    ]
                                ),
                            ],
                        ]
                    ),
                    660604 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'sire_uid' => 660604,
                            'going_groups' => [
                                'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good',
                                        'wins' => 53,
                                        'runs' => 478,
                                        'sire_going_runs' => 478,
                                        'sire_going_wins' => 53,
                                        'win_percentage' => 11,
                                        'impact_value' => 0.32000000000000001,
                                    ]
                                ),
                                'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_firm',
                                        'wins' => 47,
                                        'runs' => 362,
                                        'sire_going_runs' => 362,
                                        'sire_going_wins' => 47,
                                        'win_percentage' => 13,
                                        'impact_value' => 0.48999999999999999,
                                    ]
                                ),
                                'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'heavy',
                                        'wins' => 12,
                                        'runs' => 67,
                                        'sire_going_runs' => 67,
                                        'sire_going_wins' => 12,
                                        'win_percentage' => 18,
                                        'impact_value' => 3.7000000000000002,
                                    ]
                                ),
                                'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_soft',
                                        'wins' => 29,
                                        'runs' => 224,
                                        'sire_going_runs' => 224,
                                        'sire_going_wins' => 29,
                                        'win_percentage' => 13,
                                        'impact_value' => 0.80000000000000004,
                                    ]
                                ),
                                'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'soft',
                                        'wins' => 24,
                                        'runs' => 232,
                                        'sire_going_runs' => 232,
                                        'sire_going_wins' => 24,
                                        'win_percentage' => 10,
                                        'impact_value' => 0.58999999999999997,
                                    ]
                                ),
                                'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'firm',
                                        'wins' => 2,
                                        'runs' => 14,
                                        'sire_going_runs' => 14,
                                        'sire_going_wins' => 2,
                                        'win_percentage' => 14,
                                        'impact_value' => 13.77,
                                    ]
                                ),
                            ],
                        ]
                    ),
                    655133 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'sire_uid' => 655133,
                            'going_groups' => [
                                'good' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good',
                                        'wins' => 10,
                                        'runs' => 122,
                                        'sire_going_runs' => 122,
                                        'sire_going_wins' => 10,
                                        'win_percentage' => 8,
                                        'impact_value' => 0.28000000000000003,
                                    ]
                                ),
                                'good_to_soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_soft',
                                        'wins' => 8,
                                        'runs' => 87,
                                        'sire_going_runs' => 87,
                                        'sire_going_wins' => 8,
                                        'win_percentage' => 9,
                                        'impact_value' => 0.44,
                                    ]
                                ),
                                'heavy' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'heavy',
                                        'wins' => 2,
                                        'runs' => 18,
                                        'sire_going_runs' => 18,
                                        'sire_going_wins' => 2,
                                        'win_percentage' => 11,
                                        'impact_value' => 2.6299999999999999,
                                    ]
                                ),
                                'good_to_firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'good_to_firm',
                                        'wins' => 11,
                                        'runs' => 123,
                                        'sire_going_runs' => 123,
                                        'sire_going_wins' => 11,
                                        'win_percentage' => 9,
                                        'impact_value' => 0.31,
                                    ]
                                ),
                                'firm' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'firm',
                                        'wins' => 0,
                                        'runs' => 6,
                                        'sire_going_runs' => 6,
                                        'sire_going_wins' => 0,
                                        'win_percentage' => 0,
                                        'impact_value' => 0,
                                    ]
                                ),
                                'soft' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'going_group' => 'soft',
                                        'wins' => 12,
                                        'runs' => 74,
                                        'sire_going_runs' => 74,
                                        'sire_going_wins' => 12,
                                        'win_percentage' => 16,
                                        'impact_value' => 0.93000000000000005,
                                    ]
                                ),
                            ],
                        ]
                    ),
                ]
            ]
        ];
    }
}
