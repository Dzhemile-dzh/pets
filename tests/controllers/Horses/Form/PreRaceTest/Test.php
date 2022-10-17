<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Form\PreRaceTest;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * This tests retrieving form data and the A/C in:
 * https://racingpost.atlassian.net/browse/AD-1526
 * https://racingpost.atlassian.net/browse/AD-1528
 * https://racingpost.atlassian.net/browse/AD-1550
 * https://racingpost.atlassian.net/browse/AD-1586
 *
 * @package Tests\Controllers\Horses\Form\PreRaceTest
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
                    'race_status_code' => 'C',
                    'race_datetime' => '2100-07-23 19:40:00',
                ]
            ],
            '962765cf8636a987403a272880dc4d2e' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '5f260f5396cf8de1d3c55f04f9cf43f3' => [
            ],
            //Models\RaceInstance:2564 ->createHorsesIdTmpTableByRace()
            'fb2ae2f636af1274765521a68d19d90f' => [
            ],
            //Models\RaceInstance:2646 ->createHorsePtpGbIdTmpTable()
            '025178cdda95b5b5c5c67a53a9ba220b' => [
            ],

            ////Models\3769:2646 ->getRunnersIds
            'e9a37a4f3e02a8bc457c98cd0a34e3e2' => [
                [
                    'horse_uid' => 1234567
                ]
            ],
            //Models\RaceInstance:2491 ->getPtpGbHorses()
            'f89ec997de033f8016cce3b54e1dad74' => [
            ],
            //Models\RaceInstance:1968 ->getFormOrWinsOrMyRatings()
            'f8f0c485627c6075a1f997e4e1f9313f' => [
                [
                    // Scenario: 1 - happy path + dead heat horse
                    'race_instance_uid' => 123456789,
                    'race_group_uid' => 0,
                    'race_datetime' => '2100-01-23 19:40:00',
                    'hours_difference' => 5,
                    'race_instance_title' => 'bet365 Handicap',
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
                    'race_outcome_uid' => 2,
                    'final_race_outcome_uid' => 72,
                    'race_outcome_position' => 2,
                    'orig_race_outcome_position' => 2,
                    'final_race_outcome_position' => 2,
                    'race_outcome_code' => '2',
                    'no_of_runners' => 9,
                    'going_type_code' => 'VG',
                    'going_type_desc' => 'Very Good',
                    // We change this in relation to no_of_runners to check what is used in the end result.
                    'no_of_runners_calculated' => 13,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'odds_desc' => '100/30',
                    'favourite_flag' => null,
                    'odds_value' => 3.333,
                    'horse_uid' => 1234567,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => -1,
                    'rp_postmark' => 80,
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'other_horse' => null,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 1,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => null,
                    'dth_distance_value' => null,
                    'non_runner' => 'N',
                ],
                [
                    // Scenario: 2 - happy path
                    'race_instance_uid' => 987654321,
                    'race_group_uid' => 0,
                    'race_datetime' => '2100-02-23 19:40:00',
                    'hours_difference' => 5,
                    'race_instance_title' => 'Ladbrokes Handicap',
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
                    // We change this in relation to no_of_runners to check what is used in the end result.
                    'no_of_runners_calculated' => 13,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'odds_desc' => '100/30',
                    'favourite_flag' => null,
                    'odds_value' => 3.333,
                    'horse_uid' => 1234567,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => -1,
                    'rp_postmark' => 80,
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'other_horse' => null,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 1,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => null,
                    'dth_distance_value' => null,
                    'non_runner' => 'N',
                ]
            ],
            //Models\RaceInstance:2155 ->joinDistanceWinnersDataToForm()
            '06612e48fd12c223b237cf7efcfe2124' => [
                [
                    'race_instance_uid' => 123456789,
                    'horse_uid' => 1234567,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 1,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
                    'dth_distance_value' => 13.6,
                ]
            ],
            //Models\RaceInstance:2025 ->joinOtherHorseDataToForm()
            '1d9f43325c8b3298d6fa7a1a2dd8f326' => [
                [
                    'style_name' => 'Rambo',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 54321,
                    'weight_carried_lbs' => 1,
                    'race_instance_uid' => 123456789,
                    'race_outcome_position' => 1,
                ],
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            'a25a53f882b3d4c4646b510023d3c355' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '585f330d3f92b71f3471cf966d4919af' => [
            ],
            //Models\RaceInstance:2270 ->prepareNextRunTmpTables()
            '67bcd0fb1e2794a38bdd9fc04aa11f09' => [
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
            '846b3c56004978e255be942937d7ee63' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() Main statement
            '10beaaaa61612758c43257e79f9dda01' => [
                            ],
            //Api\DataProvider\Bo\RaceCards:832 ->getRaceAttributes()
            '45885907304a8e954c8cd005690f61bc' => [
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
