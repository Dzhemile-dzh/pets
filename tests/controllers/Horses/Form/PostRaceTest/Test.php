<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Form\PostRaceTest;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * This tests retrieving form data and the A/C in:
 * https://racingpost.atlassian.net/browse/AD-1526
 * https://racingpost.atlassian.net/browse/AD-1528
 * https://racingpost.atlassian.net/browse/AD-1550
 * https://racingpost.atlassian.net/browse/AD-1586
 * https://racingpost.atlassian.net/browse/AD-1561
 *
 * @package Tests\Controllers\Horses\Form\PostRaceTest
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/form/680588';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\RacecardsResults:37->getRaceStatusCode()
            '16f8659aadd9c437061448477d8268b8' => [
                [
                    'race_status_code' => 'R',
                    'race_datetime' => '2018-07-23 19:40:00',
                ]
            ],
            '962765cf8636a987403a272880dc4d2e' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '5f260f5396cf8de1d3c55f04f9cf43f3' => [
            ],
            //Models\RaceInstance:2564 ->createHorsesIdTmpTableByRace()
            'd01f056a3c86026914f015052ffc1f36' => [
            ],
            //Models\RaceInstance:2646 ->createHorsePtpGbIdTmpTable()
            '025178cdda95b5b5c5c67a53a9ba220b' => [
            ],

            ////Models\3769:2646 ->getRunnersIds
            'e9a37a4f3e02a8bc457c98cd0a34e3e2' => [
                [
                    'horse_uid' => 1234567
                ],
                [
                    'horse_uid' => 123123
                ],
            ],
            //Models\RaceInstance:2491 ->getPtpGbHorses()
            'f89ec997de033f8016cce3b54e1dad74' => [
            ],
            //Models\RaceInstance:1968 ->getFormOrWinsOrMyRatings()
            'd87ebf40719ca03b5329f427c1fb7301' => [
                [
                    // Scenario: 1 - happy path
                    'race_instance_uid' => 123456789,
                    'race_instance_title' => 'bet365 Handicap',
                    'race_group_uid' => 0,
                    'race_datetime' => '2018-12-05 14:55:00',
                    'hours_difference' => 5,
                    'saddle_cloth_no' => 1,
                    'course_uid' => 49,
                    'course_name' => 'RIPON',
                    'course_style_name' => 'Ripon',
                    'country_code' => 'GB ',
                    'course_type_code' => 'F',
                    'race_type_code' => 'F',
                    'weight_allowance_lbs' => 0,
                    'course_comments' => 'right-handed, fairly sharp track',
                    'distance_yard' => 1210,
                    'actual_race_class' => '4',
                    'rp_ages_allowed_desc' => '2yo',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'weight_carried_lbs' => 134,
                    'race_outcome_desc' => '2nd',
                    'race_outcome_form_char' => '2',
                    'orig_race_output_order' => 3,
                    'final_race_output_order' => 2,
                    'race_outcome_uid' => 3,
                    'final_race_outcome_uid' => 2,
                    'race_outcome_position' => 2,
                    'orig_race_outcome_position' => 3,
                    'final_race_outcome_position' => 2,
                    'race_outcome_code' => '2',
                    'no_of_runners' => 9,
                    'going_type_code' => 'VG',
                    'going_type_desc' => 'Very Good',
                    'no_of_runners_calculated' => 9,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'odds_desc' => '100/30',
                    'favourite_flag' => null,
                    'odds_value' => 3.333,
                    'horse_uid' => 1234567,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => 0,
                    'rp_postmark' => 80,
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'other_horse' => null,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_count_horse_race' => null,
                    'dtw_sum_distance_value' => null,
                    'dtw_total_distance_value' => null,
                    'non_runner' => 'N',
                ],
                // Scenario: 2 - When horse has no raceHistory prior to race in question - return empty racing history
                [
                    'race_instance_uid' => 2222222,
                    'race_instance_title' => 'bet365 Handicap',
                    'race_datetime' => '2018-07-21 14:55:00',
                     'horse_uid' => 123123,
                ],
                // Scenario: 3 - Race is prior to the current race - avoid adding to racing history
                [
                    'race_instance_uid' => 9999999,
                    'race_datetime' => '2018-01-21 14:55:00',
                    'horse_uid' => 1234567,
                ],
                [
                    // Scenario: 4 - horseId 1234567 with 2 races
                    'race_instance_uid' => 963963963,
                    'race_instance_title' => 'bet365 Handicap',
                    'race_group_uid' => 0,
                    'race_datetime' => '2018-10-05 14:55:00',
                    'hours_difference' => 5,
                    'saddle_cloth_no' => 1,
                    'course_uid' => 49,
                    'course_name' => 'RIPON',
                    'course_style_name' => 'Ripon',
                    'country_code' => 'GB ',
                    'course_type_code' => 'F',
                    'race_type_code' => 'F',
                    'weight_allowance_lbs' => 0,
                    'course_comments' => 'right-handed, fairly sharp track',
                    'distance_yard' => 1210,
                    'actual_race_class' => '4',
                    'rp_ages_allowed_desc' => '2yo',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'weight_carried_lbs' => 134,
                    'race_outcome_desc' => '2nd',
                    'race_outcome_form_char' => '2',
                    'orig_race_output_order' => 2,
                    'final_race_output_order' => 2,
                    'race_outcome_uid' => 72,
                    'final_race_outcome_uid' => 72,
                    'race_outcome_position' => 2,
                    'orig_race_outcome_position' => 2,
                    'final_race_outcome_position' => 2,
                    'race_outcome_code' => '2',
                    'no_of_runners' => 9,
                    'going_type_code' => 'VG',
                    'going_type_desc' => 'Very Good',
                    'no_of_runners_calculated' => 9,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'odds_desc' => '100/30',
                    'favourite_flag' => 'Y',
                    'odds_value' => 3.333,
                    'horse_uid' => 1234567,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => 65,
                    'rp_postmark' => 80,
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'other_horse' => 2,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => null,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => null,
                    'non_runner' => 'Y',
                ],
                [
                    // Scenario: 5 - horseId 1234567 has a void race that is included in the result
                    'race_instance_uid' => 963741852,
                    'race_instance_title' => 'bet365 Handicap',
                    'race_group_uid' => 0,
                    'race_datetime' => '2019-10-05 14:55:00',
                    'hours_difference' => 5,
                    'saddle_cloth_no' => 1,
                    'course_uid' => 49,
                    'course_name' => 'RIPON',
                    'course_style_name' => 'Ripon',
                    'country_code' => 'GB ',
                    'course_type_code' => 'F',
                    'race_type_code' => 'F',
                    'weight_allowance_lbs' => 0,
                    'course_comments' => 'right-handed, fairly sharp track',
                    'distance_yard' => 1210,
                    'actual_race_class' => '4',
                    'rp_ages_allowed_desc' => '2yo',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'weight_carried_lbs' => 134,
                    'race_outcome_desc' => 'VOID',
                    'race_outcome_form_char' => '-',
                    'orig_race_output_order' => 121,
                    'final_race_output_order' => 121,
                    'race_outcome_uid' => 121,
                    'final_race_outcome_uid' => 121,
                    'final_race_outcome_joint_yn' => 'N',
                    'race_outcome_position' => 121,
                    'orig_race_outcome_position' => 0,
                    'final_race_outcome_position' => 0,
                    'race_outcome_code' => '121',
                    'no_of_runners' => 9,
                    'going_type_code' => 'VG',
                    'going_type_desc' => 'Very Good',
                    'no_of_runners_calculated' => 9,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'odds_desc' => '100/30',
                    'favourite_flag' => 'Y',
                    'odds_value' => 3.333,
                    'horse_uid' => 1234567,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => 65,
                    'rp_postmark' => 80,
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'other_horse' => 2,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => null,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => null,
                    'non_runner' => 'Y',
                ],
                [
                    // Scenario: 6 - horseId 1234567 won the race and winningDistance for other horse should be populated
                    'race_instance_uid' => 55855585,
                    'race_instance_title' => 'bet365 Handicap',
                    'race_group_uid' => 0,
                    'race_datetime' => '2019-10-05 14:55:00',
                    'hours_difference' => 5,
                    'saddle_cloth_no' => 1,
                    'course_uid' => 49,
                    'course_name' => 'RIPON',
                    'course_style_name' => 'Ripon',
                    'country_code' => 'GB ',
                    'course_type_code' => 'F',
                    'race_type_code' => 'F',
                    'weight_allowance_lbs' => 0,
                    'course_comments' => 'right-handed, fairly sharp track',
                    'distance_yard' => 1210,
                    'actual_race_class' => '4',
                    'rp_ages_allowed_desc' => '2yo',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'weight_carried_lbs' => 134,
                    'race_outcome_desc' => 'Winner Winner Chicken Dinner',
                    'race_outcome_form_char' => '-',
                    'orig_race_output_order' => 1,
                    'final_race_output_order' => 1,
                    'race_outcome_uid' => 1,
                    'final_race_outcome_uid' => 1,
                    'final_race_outcome_joint_yn' => 'N',
                    'race_outcome_position' => 1,
                    'orig_race_outcome_position' => 1,
                    'final_race_outcome_position' => 1,
                    'race_outcome_code' => '1',
                    'no_of_runners' => 9,
                    'going_type_code' => 'VG',
                    'going_type_desc' => 'Very Good',
                    'no_of_runners_calculated' => 9,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'odds_desc' => '100/30',
                    'favourite_flag' => 'Y',
                    'odds_value' => 3.333,
                    'horse_uid' => 1234567,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => 65,
                    'rp_postmark' => 80,
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'other_horse' => 2,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => null,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => null,
                    'non_runner' => 'Y',
                ],
            ],
            //Models\RaceInstance:2155 ->joinDistanceWinnersDataToForm()
            'cf171a007d56139753cb62821a76a414' => [
                [
                    'race_instance_uid' => 123456789,
                    'horse_uid' => 1234567,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 2.8,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
                    'dth_distance_value' => 13.6,
                ],
                [
                    'race_instance_uid' => 963963963,
                    'horse_uid' => 1234567,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 5,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
                    'dth_distance_value' => 13.6,
                ],
                [
                    'race_instance_uid' => 963741852,
                    'horse_uid' => 1234567,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 5,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
                    'dth_distance_value' => 13.6,
                ],
                [
                    'race_instance_uid' => 963741852,
                    'horse_uid' => 1234567,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 5,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
                    'dth_distance_value' => 13.6,
                ],
                [
                    'race_instance_uid' => 55855585,
                    'horse_uid' => 1234567,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 5,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
                    'dth_distance_value' => 13.6,
                ]
            ],
            //Models\RaceInstance:2025 ->joinOtherHorseDataToForm()
            '92eae7c64e3ef9bdc9db2f0a7551cf68' => [
                [
                    'style_name' => 'Rambo',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 54321,
                    'weight_carried_lbs' => 1,
                    'race_instance_uid' => 963963963,
                    'race_outcome_position' => 1,
                ],
                [
                    'style_name' => 'Jack',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 654321,
                    'weight_carried_lbs' => 1,
                    'race_instance_uid' => 55855585,
                    'race_outcome_position' => 1,
                ]
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            'a25a53f882b3d4c4646b510023d3c355' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '585f330d3f92b71f3471cf966d4919af' => [
            ],
            //Models\RaceInstance:2224 ->prepareNextRunTmpTables()
            '8e0cd7d6a02c9478f71c57c2f8c0b4bc' => [
            ],
            //Models\RaceInstance:2270 ->prepareNextRunTmpTables()
            'c5ca20dbf0f160a2cfb1df6a42103e0f' => [
            ],
            //Models\RaceInstance:2390 ->getNextRun()
            'd367c24e7598953ff72237bcd9b623da' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            'cd0054113fce59c32dde894b93c9af33' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() DROP TABLE #tmp_race_ids
            'fabddb1710b03508361534ea456ae438' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() SELECT INTO #tmp_race_ids
            'e292947bb2712bb9e89a6f03d23552b9' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() Main statement
            '10beaaaa61612758c43257e79f9dda01' => [
                            ],
            //Api\DataProvider\Bo\RaceCards:832 ->getRaceAttributes()
            '9c1926a64a4ea31a5ac556e0d37367a2' => [
                [
                    'race_attrib_desc' => "Category Desc",
                    'race_attrib_code' => 'Category',
                    'race_attrib_uid' => 55,
                    'race_instance_uid' => 123456789
                ],
                [
                    'race_attrib_desc' => "5",
                    'race_attrib_code' => 'Class_subset',
                    'race_attrib_uid' => 55,
                    'race_instance_uid' => 123456789
                ],
                [
                    'race_attrib_desc' => "Cheese",
                    'race_attrib_code' => 'Surface',
                    'race_attrib_uid' => 75,
                    'race_instance_uid' => 123456789
                ],
                [
                    'race_attrib_desc' => "Cheese",
                    'race_attrib_code' => 'Surface',
                    'race_attrib_uid' => 71,
                    'race_instance_uid' => 963963963
                ],
                [
                    'race_attrib_desc' => "Flat Turf",
                    'race_attrib_code' => 'Category',
                    'race_attrib_uid' => 71,
                    'race_instance_uid' => 963963963
                ]
            ],
        ];
    }
}
