<?php

namespace Tests;

use Phalcon\Exception;
use \Api\Row\HorseRace as RowHR;
use \Api\Row\RaceInstance as RiRow;
use Phalcon\Mvc\Model\Row\General as GeneralRow;
use Api\Constants\Horses as Constants;

class HorseProfileTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerTestWrongHorseId
     * @expectedException \Exception
     */
    public function testWrongHorseId($horseId)
    {

        new \Bo\Profile\Horse($horseId);
    }

    /**
     * @return array
     */
    public function providerTestWrongHorseId()
    {

        return [
            ['fds'],
            [0],
            [-1],
        ];
    }

    /**
     * @expectedException \Api\Exception\NotFound
     */
    public function testGetProfileForIndexNotFound()
    {
        $horseProfileObject = new Stubs\Bo\HorseProfile(1);
        $horseProfileObject->getProfileForIndex();
    }


    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetProfileForIndex
     */
    public function testGetProfileForIndex($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getProfileForIndex())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProfileForIndex()
    {
        return [
            [
                867979,
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
            ]
        ];
    }

    /**
     * @expectedException \Api\Exception\NotFound
     */
    public function testGetPedigreeNotFound()
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile(3);

        $horseProfileObject->getPedigree();
    }


    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetPedigree
     */
    public function testGetPedigree($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getPedigree())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetPedigree()
    {
        return [
            [
                867979,
                (Object)[
                    'horse_uid' => 867979,
                    'style_name' => 'Ali Bin Nayef',
                    'country_origin_code' => 'GB',
                    'avg_flat_win_dist_of_progeny' => null,
                    'horse_date_of_birth' => '2012-02-29 00:00',
                    'sire_uid' => 522845,
                    'dam_uid' => 686929,
                    'dam' => (Object)[
                        "horse_uid" => 686929,
                        'style_name' => 'Maimoona',
                        'country_origin_code' => 'IRE',
                        'avg_flat_win_dist_of_progeny' => null,
                        'horse_date_of_birth' => '2005-04-08 00:00',
                        'sire_uid' => 107700,
                        'dam_uid' => 517136,
                        'dam' => (Object)[
                            "horse_uid" => 517136,
                            'style_name' => 'Shuruk',
                            'country_origin_code' => 'GB',
                            'avg_flat_win_dist_of_progeny' => null,
                            'horse_date_of_birth' => '1997-03-09 00:00',
                            'sire_uid' => 9363,
                            'dam_uid' => 21410,
                        ],
                        'sire' => (Object)[
                            "horse_uid" => 107700,
                            'style_name' => 'Pivotal',
                            'country_origin_code' => 'GB',
                            'avg_flat_win_dist_of_progeny' => 7.9,
                            'horse_date_of_birth' => '1993-01-19 00:00',
                            'sire_uid' => 58836,
                            'dam_uid' => 52825
                        ],
                    ],
                    'sire' => (Object)[
                        "horse_uid" => 522845,
                        'style_name' => 'Nayef',
                        'country_origin_code' => 'USA',
                        'avg_flat_win_dist_of_progeny' => 10.4,
                        'horse_date_of_birth' => '2012-02-29 00:00',
                        'sire_uid' => 304579,
                        'dam_uid' => 415950,
                        'dam' => (Object)[
                            "horse_uid" => 415950,
                            'style_name' => 'Height Of Fashion',
                            'country_origin_code' => 'FR',
                            'avg_flat_win_dist_of_progeny' => null,
                            'horse_date_of_birth' => '1979-01-01 00:00',
                            'sire_uid' => 300363,
                            'dam_uid' => 416241
                        ],
                        'sire' => (Object)[
                            "horse_uid" => 304579,
                            'style_name' => 'Gulch',
                            'country_origin_code' => 'USA',
                            'avg_flat_win_dist_of_progeny' => 9.1,
                            'horse_date_of_birth' => '1984-01-01 00:00',
                            'sire_uid' => 301599,
                            'dam_uid' => 417700,
                        ],
                    ],
                ]
            ]
        ];
    }


    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetForm
     */
    public function testGetForm($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);

        $actual = $horseProfileObject->getForm();
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($actual)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetForm()
    {
        return [
            [
                867979,
                [
                    659318 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 659318,
                            'race_group_uid' => 6,
                            'race_datetime' => 'Oct 11 2016  9:15PM',
                            'course_uid' => 513,
                            'course_name' => 'WOLVERHAMPTON (A.W)',
                            'course_style_name' => 'Wolverhampton (A.W)',
                            'country_code' => 'GB ',
                            'course_type_code' => 'X',
                            'race_instance_title' => 'NTM Russia Handicap',
                            'race_type_code' => 'X',
                            'course_code' => 'WOLW',
                            'course_rp_abbrev_3' => 'WOL',
                            'course_rp_abbrev_4' => 'Wolv',
                            'course_code1' => 'WOLW',
                            'weight_allowance_lbs' => 0,
                            'course_comments' => 'left-handed 7 1/2f oval.',
                            'going_type_services_desc' => 'St',
                            'prize_sterling' => 2264.1500000000001,
                            'prize_euro' => 0,
                            'distance_yard' => 2691,
                            'actual_race_class' => '7',
                            'rp_ages_allowed_desc' => '3yo+',
                            'race_group_code' => 'H',
                            'race_group_desc' => 'Handicap',
                            'weight_carried_lbs' => 132,
                            'race_outcome_desc' => '1st',
                            'race_outcome_form_char' => '1',
                            'race_output_order' => 1,
                            'race_outcome_position' => 1,
                            'race_outcome_code' => '1',
                            'orig_race_output_order' => 1,
                            'no_of_runners' => null,
                            'going_type_code' => 'SD',
                            'no_of_runners_calculated' => 11,
                            'rp_close_up_comment' => 'held up in touch in midfield, effort 2f out, headway under pressure to challenge just inside final furlong, led 75yds out, ridden out',
                            'rp_horse_head_gear_code' => null,
                            'first_time_yn' => null,
                            'odds_desc' => '7/2',
                            'odds_value' => 3.5,
                            'horse_uid' => 867979,
                            'jockey_style_name' => 'Silvestre De Sousa',
                            'aka_style_name' => 'S De Sousa',
                            'jockey_jockey_uid' => 83746,
                            'jockey_ptp_type_code' => 'N',
                            'official_rating_ran_off' => 49,
                            'rp_topspeed' => 35,
                            'rp_postmark' => 56,
                            'video_id' => 151586,
                            'dtw_rp_distance_desc' => null,
                            'dtw_sum_distance_value' => 1,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 13.75,
                            'rp_betting_movements' => 'op 9/2',
                            'disqualification_uid' => null,
                            'disqualification_desc' => null,
                            'rp_straight_round_jubilee_desc' => null,
                            'other_horse' =>
                                RiRow::createFromArray(array(
                                    'style_name' => 'Mrs Burbidge',
                                    'country_origin_code' => 'GB',
                                    'horse_uid' => 853947,
                                    'weight_carried_lbs' => 132,
                                    'race_instance_uid' => 659318,
                                    'race_outcome_position' => 2,
                                )),
                            'race_tactics' =>
                                (Object)array(
                                    'actual' =>
                                        array(
                                            'runner_attrib_type' => 'Early',
                                            'runner_attrib_description' => 'Hold-Up',
                                        ),
                                    'predicted' =>
                                        array(
                                            'runner_attrib_type' => null,
                                            'runner_attrib_description' => null,
                                        ),
                                ),
                            'next_run' =>
                                RiRow::createFromArray(array(
                                    'form_race_instance_uid' => 659318,
                                    'first_3_wins' => 0,
                                    'first_3_placed' => 1,
                                    'first_3_unplaced' => 2,
                                    'other_wins' => 0,
                                    'other_placed' => 0,
                                    'other_unplaced' => 5,
                                    'hot_race' => 0,
                                    'cold_race' => 1,
                                    'first_three' =>
                                        (Object)array(
                                            'wins' => 0,
                                            'placed' => 1,
                                            'unplaced' => 2,
                                        ),
                                    'other' =>
                                        (Object)array(
                                            'wins' => 0,
                                            'placed' => 0,
                                            'unplaced' => 5,
                                        ),
                                    'average_race' => 0,
                                )),
                            'draw' => 5,
                            'non_runner' => 'N',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::CreateFromArray(array(
                                            'race_instance_uid' => 659318,
                                            'ptv_video_id' => 151586,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 151586,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 151586,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                ],
            ]
        ];
    }

    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetWins
     */
    public function testGetWins($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getWins())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetWins()
    {
        return [
            [
                867979,
                array(
                    659318 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 659318,
                            'race_group_uid' => 6,
                            'race_datetime' => 'Oct 11 2016  9:15PM',
                            'course_uid' => 513,
                            'course_name' => 'WOLVERHAMPTON (A.W)',
                            'course_style_name' => 'Wolverhampton (A.W)',
                            'country_code' => 'GB ',
                            'course_type_code' => 'X',
                            'race_instance_title' => 'NTM Russia Handicap',
                            'race_type_code' => 'X',
                            'course_code' => 'WOLW',
                            'course_rp_abbrev_3' => 'WOL',
                            'course_rp_abbrev_4' => 'Wolv',
                            'course_code1' => 'WOLW',
                            'weight_allowance_lbs' => 0,
                            'course_comments' => 'left-handed 7 1/2f oval.',
                            'going_type_services_desc' => 'St',
                            'prize_sterling' => 2264.1500000000001,
                            'prize_euro' => 0,
                            'distance_yard' => 2691,
                            'actual_race_class' => '7',
                            'rp_ages_allowed_desc' => '3yo+',
                            'race_group_code' => 'H',
                            'race_group_desc' => 'Handicap',
                            'weight_carried_lbs' => 132,
                            'race_outcome_desc' => '1st',
                            'race_outcome_form_char' => '1',
                            'race_output_order' => 1,
                            'race_outcome_position' => 1,
                            'race_outcome_code' => '1',
                            'orig_race_output_order' => 1,
                            'no_of_runners' => null,
                            'going_type_code' => 'SD',
                            'no_of_runners_calculated' => 11,
                            'rp_close_up_comment' => 'held up in touch in midfield, effort 2f out, headway under pressure to challenge just inside final furlong, led 75yds out, ridden out',
                            'rp_horse_head_gear_code' => null,
                            'first_time_yn' => null,
                            'odds_desc' => '7/2',
                            'odds_value' => 3.5,
                            'horse_uid' => 867979,
                            'jockey_style_name' => 'Silvestre De Sousa',
                            'aka_style_name' => 'S De Sousa',
                            'jockey_jockey_uid' => 83746,
                            'jockey_ptp_type_code' => 'N',
                            'official_rating_ran_off' => 49,
                            'rp_topspeed' => 35,
                            'rp_postmark' => 56,
                            'video_id' => 151586,
                            'dtw_rp_distance_desc' => null,
                            'dtw_sum_distance_value' => 1,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 13.75,
                            'rp_betting_movements' => 'op 9/2',
                            'disqualification_uid' => null,
                            'disqualification_desc' => null,
                            'rp_straight_round_jubilee_desc' => null,
                            'other_horse' =>
                                RiRow::createFromArray(array(
                                    'style_name' => 'Mrs Burbidge',
                                    'country_origin_code' => 'GB',
                                    'horse_uid' => 853947,
                                    'weight_carried_lbs' => 132,
                                    'race_instance_uid' => 659318,
                                    'race_outcome_position' => 2,
                                )),
                            'race_tactics' => null,
                            'next_run' =>
                                RiRow::createFromArray(array(
                                    'form_race_instance_uid' => 659318,
                                    'first_3_wins' => 0,
                                    'first_3_placed' => 1,
                                    'first_3_unplaced' => 2,
                                    'other_wins' => 0,
                                    'other_placed' => 0,
                                    'other_unplaced' => 5,
                                    'hot_race' => 0,
                                    'cold_race' => 1,
                                    'first_three' =>
                                        (Object)array(
                                            'wins' => 0,
                                            'placed' => 1,
                                            'unplaced' => 2,
                                        ),
                                    'other' =>
                                        (Object)array(
                                            'wins' => 0,
                                            'placed' => 0,
                                            'unplaced' => 5,
                                        ),
                                    'average_race' => 0,
                                )),
                            'draw' => 5,
                            'non_runner' => 'N',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 659318,
                                            'ptv_video_id' => 151586,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 151586,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 151586,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                )
            ]
        ];
    }


    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetMyRatings
     */
    public function testGetMyRatings($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getMyRatings())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetMyRatings()
    {
        return [
            [
                867979,
                array(
                    659318 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 659318,
                            'race_group_uid' => 6,
                            'race_datetime' => 'Oct 11 2016  9:15PM',
                            'course_uid' => 513,
                            'course_name' => 'WOLVERHAMPTON (A.W)',
                            'course_style_name' => 'Wolverhampton (A.W)',
                            'country_code' => 'GB ',
                            'course_type_code' => 'X',
                            'race_instance_title' => 'NTM Russia Handicap',
                            'race_type_code' => 'X',
                            'course_code' => 'WOLW',
                            'course_rp_abbrev_3' => 'WOL',
                            'course_rp_abbrev_4' => 'Wolv',
                            'course_code1' => 'WOLW',
                            'weight_allowance_lbs' => 0,
                            'course_comments' => 'left-handed 7 1/2f oval.',
                            'going_type_services_desc' => 'St',
                            'prize_sterling' => 2264.1500000000001,
                            'prize_euro' => 0,
                            'distance_yard' => 2691,
                            'actual_race_class' => '7',
                            'rp_ages_allowed_desc' => '3yo+',
                            'race_group_code' => 'H',
                            'race_group_desc' => 'Handicap',
                            'weight_carried_lbs' => 132,
                            'race_outcome_desc' => '1st',
                            'race_outcome_form_char' => '1',
                            'race_output_order' => 1,
                            'race_outcome_position' => 1,
                            'race_outcome_code' => '1',
                            'orig_race_output_order' => 1,
                            'no_of_runners' => null,
                            'going_type_code' => 'SD',
                            'no_of_runners_calculated' => 11,
                            'rp_close_up_comment' => 'held up in touch in midfield, effort 2f out, headway under pressure to challenge just inside final furlong, led 75yds out, ridden out',
                            'rp_horse_head_gear_code' => null,
                            'first_time_yn' => null,
                            'odds_desc' => '7/2',
                            'odds_value' => 3.5,
                            'horse_uid' => 867979,
                            'jockey_style_name' => 'Silvestre De Sousa',
                            'aka_style_name' => 'S De Sousa',
                            'jockey_jockey_uid' => 83746,
                            'jockey_ptp_type_code' => 'N',
                            'official_rating_ran_off' => 49,
                            'rp_topspeed' => 35,
                            'rp_postmark' => 56,
                            'video_id' => 151586,
                            'dtw_rp_distance_desc' => null,
                            'dtw_sum_distance_value' => 1,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 13.75,
                            'rp_betting_movements' => 'op 9/2',
                            'disqualification_uid' => null,
                            'disqualification_desc' => null,
                            'rp_straight_round_jubilee_desc' => null,
                            'other_horse' =>
                                RiRow::createFromArray(array(
                                    'style_name' => 'Mrs Burbidge',
                                    'country_origin_code' => 'GB',
                                    'horse_uid' => 853947,
                                    'weight_carried_lbs' => 132,
                                    'race_instance_uid' => 659318,
                                    'race_outcome_position' => 2,
                                )),
                            'race_tactics' => null,
                            'next_run' =>
                                RiRow::createFromArray(array(
                                    'form_race_instance_uid' => 659318,
                                    'first_3_wins' => 0,
                                    'first_3_placed' => 1,
                                    'first_3_unplaced' => 2,
                                    'other_wins' => 0,
                                    'other_placed' => 0,
                                    'other_unplaced' => 5,
                                    'hot_race' => 0,
                                    'cold_race' => 1,
                                    'first_three' =>
                                        (Object)array(
                                            'wins' => 0,
                                            'placed' => 1,
                                            'unplaced' => 2,
                                        ),
                                    'other' =>
                                        (Object)array(
                                            'wins' => 0,
                                            'placed' => 0,
                                            'unplaced' => 5,
                                        ),
                                    'average_race' => 0,
                                )),
                            'draw' => 5,
                            'non_runner' => 'N',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 659318,
                                            'ptv_video_id' => 151586,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 151586,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 151586,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                )
            ]
        ];
    }

    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetStatistics
     */
    public function testGetStatistics($horseId, $raceTypeCodes, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getStatistics($raceTypeCodes))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStatistics()
    {
        return [
            [
                865306,
                ['F', 'X'],
                [
                    'course' => [
                        array(
                            0 => GeneralRow::createFromArray(
                                array(
                                    'course_name' => 'EPSOM',
                                    'course_uid' => 17,
                                    'course_style_name' => 'Epsom',
                                    'course_type_code' => 'N',
                                    'course_comment' => 'left-handed, sharp track (very sharp up to 1m)',
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 813221.40000000002,
                                    'total_prize' => 813221.40000000002,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 116,
                                    'best_rp_postmark' => 127,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                            1 => GeneralRow::createFromArray(
                                array(
                                    'course_name' => 'NEWMARKET',
                                    'course_uid' => 38,
                                    'course_style_name' => 'Newmarket',
                                    'course_type_code' => 'N',
                                    'course_comment' => 'right-handed, galloping track',
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 20982.700000000001,
                                    'total_prize' => 20982.700000000001,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 87,
                                    'best_rp_postmark' => 111,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                        )
                    ],
                    'distance' => [
                        array(
                            0 => GeneralRow::createFromArray(
                                array(
                                    'distance_yard' => 1835,
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 6469,
                                    'total_prize' => 6469,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 74,
                                    'best_rp_postmark' => 86,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                            1 => GeneralRow::createFromArray(
                                array(
                                    'distance_yard' => 1980,
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 20982.700000000001,
                                    'total_prize' => 20982.700000000001,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 87,
                                    'best_rp_postmark' => 111,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                        )
                    ],
                    'going' => [
                        array(
                            0 => GeneralRow::createFromArray(
                                array(
                                    'going_type_desc' => 'Good',
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 90736,
                                    'total_prize' => 90736,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 110,
                                    'best_rp_postmark' => 123,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                        )
                    ],
                    'month' => [
                        array(
                            0 => GeneralRow::createFromArray(
                                array(
                                    'race_datetime_month' => 4,
                                    'month_name' => 'April',
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 20982.700000000001,
                                    'total_prize' => 20982.700000000001,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 87,
                                    'best_rp_postmark' => 111,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                            1 => GeneralRow::createFromArray(
                                array(
                                    'race_datetime_month' => 5,
                                    'month_name' => 'May',
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 90736,
                                    'total_prize' => 90736,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 110,
                                    'best_rp_postmark' => 123,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                        )
                    ],
                    'jockey' => [
                        array(
                            0 => GeneralRow::createFromArray(
                                array(
                                    'jockey_style_name' => 'Frankie Dettori',
                                    'jockey_uid' => 2277,
                                    'jockey_short_name' => 'L Dettori',
                                    'jockey_ptp_type_code' => 'N',
                                    'starts_number' => 3,
                                    'place_1st_number' => 3,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 1089399.1000000001,
                                    'total_prize' => 1089399.1000000001,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 116,
                                    'best_rp_postmark' => 132,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                            1 => GeneralRow::createFromArray(
                                array(
                                    'jockey_style_name' => 'William Buick',
                                    'jockey_uid' => 85793,
                                    'jockey_short_name' => 'W Buick',
                                    'jockey_ptp_type_code' => 'N',
                                    'starts_number' => 2,
                                    'place_1st_number' => 2,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 97205,
                                    'total_prize' => 97205,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 110,
                                    'best_rp_postmark' => 123,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                        )
                    ],
                    'class' => [
                        array(
                            0 => GeneralRow::createFromArray(
                                array(
                                    'actual_race_class' => '1',
                                    'starts_number' => 4,
                                    'place_1st_number' => 4,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 1180135.1000000001,
                                    'total_prize' => 1180135.1000000001,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 116,
                                    'best_rp_postmark' => 132,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                            1 => GeneralRow::createFromArray(
                                array(
                                    'actual_race_class' => '4',
                                    'starts_number' => 1,
                                    'place_1st_number' => 1,
                                    'place_2nd_number' => 0,
                                    'place_3rd_number' => 0,
                                    'win_prize' => 6469,
                                    'total_prize' => 6469,
                                    "euro_win_prize" => 0,
                                    "euro_total_prize" => 0,
                                    'best_rp_topspeed' => 74,
                                    'best_rp_postmark' => 86,
                                    'net_total_prize' => 100.4,
                                    'net_win_prize' => 100.4,
                                )
                            ),
                        )
                    ],
                ]
            ]
        ];
    }

    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetRelatives
     */
    public function testGetRelatives($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);
        $relatives = $horseProfileObject->getRelatives();
        $this->assertEquals($expectedResult, $relatives);
    }

    /**
     * @return array
     */
    public function providerTestGetRelatives()
    {
        return [
            [
                1119176,
                [
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
            ],
            [
                123,
                null
            ]
        ];
    }


    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetSales
     */
    public function testGetSales($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getSales())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSales()
    {
        return [
            [
                787575,
                [
                    GeneralRow::createFromArray(
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
                    GeneralRow::createFromArray(
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
                    GeneralRow::createFromArray(
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
                            'sale_type' => 'Y',
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetQuotes
     */
    public function testGetQuotes($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getNotes(Constants::NOTES_TYPE_CODE_QUOTES_STR))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetQuotes()
    {
        return [
            [
                513120,
                [
                    GeneralRow::createFromArray(
                        [
                            'horse_uid' => 513120,
                            'horse_name' => 'BEST LIGHT',
                            'horse_style_name' => 'Best Light',
                            'race_id' => 284562,
                            'race_date' => 'Aug  4 2000  3:20PM',
                            'distance_furlong' => 7,
                            'course_uid' => 6,
                            'course_name' => 'GOODWOOD',
                            'course_style_name' => 'Goodwood',
                            'course_type_code' => 'N',
                            'distance' => 1540,
                            'race_title' => 'Theo Fennell Lennox Stakes Class A (Group 3)',
                            'going_type_code' => 'G',
                            'rp_postmark' => null,
                            'notes' => 'Although the colt\'s cuts are thankfully minor ones, it wouldn\'t have been fair to run him. It\'s a shame because he had a number of options, and this was the one we fancied the most. - David Elsworth',
                        ]
                    ),
                    GeneralRow::createFromArray(
                        [
                            'horse_uid' => 513120,
                            'horse_name' => 'BEST LIGHT',
                            'horse_style_name' => 'Best Light',
                            'race_id' => 272163,
                            'race_date' => 'Oct  1 1999  3:05PM',
                            'distance_furlong' => 7,
                            'course_uid' => 6,
                            'course_name' => 'NEWMARKET (JULY)',
                            'course_style_name' => 'Newmarket (July)',
                            'course_type_code' => 'N',
                            'distance' => 1540,
                            'race_title' => 'Somerville Tattersall Stakes Class A (Listed Race)',
                            'going_type_code' => 'GS',
                            'rp_postmark' => 107,
                            'notes' => 'Well balanced and a beautiful mover - David Elsworth, who reckons he will make a middle-distance performer in due course, but has already backed him for the 2,000 Guineas, that will be on the agenda first, all being well.',
                        ]
                    ),
                    GeneralRow::createFromArray(
                        [
                            'horse_uid' => 513120,
                            'horse_name' => 'BEST LIGHT',
                            'horse_style_name' => 'Best Light',
                            'race_id' => 271686,
                            'race_date' => 'Sep 19 1999  3:45PM',
                            'distance_furlong' => 7,
                            'course_uid' => 5,
                            'course_name' => 'NEWBURY',
                            'course_style_name' => 'Newbury',
                            'course_type_code' => 'N',
                            'distance' => 1540,
                            'race_title' => 'Dubai Airport Free Zone Maiden Stakes Class D',
                            'going_type_code' => 'GS',
                            'rp_postmark' => 97,
                            'notes' => 'We\'ve always thought the world of him and I should think the colt (Port Vila) he was third behind at Kempton is very good. Our horse just didn\'t have the know how to go and win there, but he had it today - David Elsworth',
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @param array $horsesId
     * @param array $expectedRows
     * @param mixed $expectedResult
     *
     * @dataProvider providerTestGetGoingForm
     */
    public function testGetGoingForm(array $horsesId, array $expectedRows, $expectedResult)
    {
        $bo = new Stubs\Bo\HorseProfile\GoingForm($horsesId);

        $actualRows = $bo->getRows();
        $this->assertEquals($expectedRows, $actualRows);

        $actualResult = $bo->prepareRows($actualRows);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function providerTestGetGoingForm()
    {
        return [
            [
                [868993],
                [
                    0 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 61,
                            'rp_topspeed' => 51,
                            'race_type_code' => 'F',
                        ]
                    ),
                    1 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 0,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 65,
                            'rp_topspeed' => 35,
                            'race_type_code' => 'F',
                        ]
                    ),
                    2 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 1,
                            'wins' => 0,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 45,
                            'rp_topspeed' => 0,
                            'race_type_code' => 'F',
                        ]
                    ),
                    3 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 3,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 37,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'F',
                        ]
                    ),
                    4 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 0,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 35,
                            'rp_topspeed' => 3,
                            'race_type_code' => 'F',
                        ]
                    ),
                    5 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 3,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 50,
                            'rp_topspeed' => 9,
                            'race_type_code' => 'F',
                        ]
                    ),
                    6 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 27,
                            'rp_topspeed' => 6,
                            'race_type_code' => 'F',
                        ]
                    ),
                    7 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 53,
                            'rp_topspeed' => 45,
                            'race_type_code' => 'F',
                        ]
                    ),
                    8 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 57,
                            'rp_topspeed' => 29,
                            'race_type_code' => 'F',
                        ]
                    ),
                    9 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 62,
                            'rp_topspeed' => 30,
                            'race_type_code' => 'F',
                        ]
                    ),
                    10 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 3,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 10,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 8,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'F',
                        ]
                    ),
                    11 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 75,
                            'rp_topspeed' => 60,
                            'race_type_code' => 'F',
                        ]
                    ),
                    12 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 3,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 63,
                            'rp_topspeed' => 19,
                            'race_type_code' => 'F',
                        ]
                    ),
                    13 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 77,
                            'rp_topspeed' => 59,
                            'race_type_code' => 'F',
                        ]
                    ),
                    14 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 69,
                            'rp_topspeed' => 65,
                            'race_type_code' => 'F',
                        ]
                    ),
                    15 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 3,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 69,
                            'rp_topspeed' => 61,
                            'race_type_code' => 'F',
                        ]
                    ),
                    16 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 70,
                            'rp_topspeed' => 32,
                            'race_type_code' => 'F',
                        ]
                    ),
                    17 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 12,
                            'wins' => 2,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 59,
                            'rp_topspeed' => 35,
                            'race_type_code' => 'F',
                        ]
                    ),
                    18 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 868993,
                            'runs' => 3,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 61,
                            'rp_topspeed' => 49,
                            'race_type_code' => 'F',
                        ]
                    ),
                ],
                GeneralRow::createFromArray(
                    [
                        'heavy_soft' => GeneralRow::createFromArray(
                            [
                                'horse_uid' => 868993,
                                'runs' => 1,
                                'wins' => 0,
                                'going_group' => 'heavy_soft',
                                'going_form' => [
                                    0 => 5,
                                ],
                                'top_rpr_flat' => false,
                                'top_rpr_jumps' => false,
                                'topspeed_rating' => false,
                                'topspeed_flat_race' => null,
                                'topspeed_jumps_race' => null,
                                'sire_wins' => null,
                                'sire_runs' => null,
                                'sire_impact_value' => null,
                            ]
                        ),
                        'good_to_soft' => GeneralRow::createFromArray(
                            [
                                'horse_uid' => 868993,
                                'runs' => 3,
                                'wins' => 0,
                                'going_group' => 'good_to_soft',
                                'going_form' => [
                                    0 => 0,
                                    1 => 8,
                                    2 => 5,
                                ],
                                'top_rpr_flat' => false,
                                'top_rpr_jumps' => false,
                                'topspeed_rating' => false,
                                'topspeed_flat_race' => GeneralRow::createFromArray(
                                    [
                                        'horse_uid' => 868993,
                                        'runs' => 3,
                                        'wins' => 0,
                                        'going_group' => 'good_to_soft',
                                        'race_outcome_position' => 5,
                                        'race_outcome_form_char' => 'U',
                                        'rp_postmark' => 61,
                                        'rp_topspeed' => 49,
                                        'race_type_code' => 'F',
                                    ]
                                ),
                                'topspeed_jumps_race' => null,
                                'sire_wins' => null,
                                'sire_runs' => null,
                                'sire_impact_value' => null,
                            ]
                        ),
                        'good' => GeneralRow::createFromArray(
                            [
                                'horse_uid' => 868993,
                                'runs' => 3,
                                'wins' => 0,
                                'going_group' => 'good',
                                'going_form' => [
                                    0 => 8,
                                    1 => 4,
                                    2 => 5,
                                ],
                                'top_rpr_flat' => false,
                                'top_rpr_jumps' => false,
                                'topspeed_rating' => false,
                                'topspeed_flat_race' => GeneralRow::createFromArray(
                                    [
                                        'horse_uid' => 868993,
                                        'runs' => 3,
                                        'wins' => 0,
                                        'going_group' => 'good',
                                        'race_outcome_position' => 5,
                                        'race_outcome_form_char' => 'U',
                                        'rp_postmark' => 69,
                                        'rp_topspeed' => 61,
                                        'race_type_code' => 'F',
                                    ]
                                ),
                                'topspeed_jumps_race' => null,
                                'sire_wins' => null,
                                'sire_runs' => null,
                                'sire_impact_value' => null,
                            ]
                        ),
                        'good_to_firm' => GeneralRow::createFromArray(
                            [
                                'horse_uid' => 868993,
                                'runs' => 12,
                                'wins' => 2,
                                'going_group' => 'good_to_firm',
                                'going_form' => [
                                    0 => 4,
                                    1 => 'U',
                                    2 => 'U',
                                    3 => 6,
                                    4 => 6,
                                    5 => 3,
                                    6 => 1,
                                    7 => 2,
                                    8 => 1,
                                    9 => 6,
                                    10 => 4,
                                    11 => 4,
                                ],
                                'top_rpr_flat' => true,
                                'top_rpr_jumps' => false,
                                'topspeed_rating' => true,
                                'topspeed_flat_race' => GeneralRow::createFromArray(
                                    [
                                        'horse_uid' => 868993,
                                        'runs' => 12,
                                        'wins' => 2,
                                        'going_group' => 'good_to_firm',
                                        'race_outcome_position' => 6,
                                        'race_outcome_form_char' => 'U',
                                        'rp_postmark' => 69,
                                        'rp_topspeed' => 65,
                                        'race_type_code' => 'F',
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
                [856426, 823159],
                [
                    0 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 52,
                            'rp_topspeed' => 28,
                            'race_type_code' => 'F',
                        ]
                    ),
                    1 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 6,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 27,
                            'rp_topspeed' => 14,
                            'race_type_code' => 'F',
                        ]
                    ),
                    2 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 14,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 0,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'F',
                        ]
                    ),
                    3 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 52,
                            'rp_topspeed' => null,
                            'race_type_code' => 'F',
                        ]
                    ),
                    4 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 1,
                            'wins' => 0,
                            'going_group' => 'firm',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 50,
                            'rp_topspeed' => 24,
                            'race_type_code' => 'F',
                        ]
                    ),
                    5 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 49,
                            'rp_topspeed' => 34,
                            'race_type_code' => 'F',
                        ]
                    ),
                    6 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 4,
                            'wins' => 0,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 55,
                            'rp_topspeed' => 50,
                            'race_type_code' => 'F',
                        ]
                    ),
                    7 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 47,
                            'rp_topspeed' => 19,
                            'race_type_code' => 'F',
                        ]
                    ),
                    8 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 6,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 54,
                            'rp_topspeed' => 50,
                            'race_type_code' => 'F',
                        ]
                    ),
                    9 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 6,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 9,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 40,
                            'rp_topspeed' => 28,
                            'race_type_code' => 'F',
                        ]
                    ),
                    10 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 6,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 33,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'F',
                        ]
                    ),
                    11 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 59,
                            'rp_topspeed' => 54,
                            'race_type_code' => 'F',
                        ]
                    ),
                    12 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 42,
                            'rp_topspeed' => 29,
                            'race_type_code' => 'F',
                        ]
                    ),
                    13 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => 'U',
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 48,
                            'rp_topspeed' => 37,
                            'race_type_code' => 'F',
                        ]
                    ),
                    14 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 4,
                            'wins' => 0,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 54,
                            'rp_topspeed' => 40,
                            'race_type_code' => 'F',
                        ]
                    ),
                    15 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 4,
                            'wins' => 0,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 40,
                            'rp_topspeed' => 30,
                            'race_type_code' => 'F',
                        ]
                    ),
                    16 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 14,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 9,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'F',
                        ]
                    ),
                    17 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 6,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 56,
                            'rp_topspeed' => 20,
                            'race_type_code' => 'F',
                        ]
                    ),
                    18 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 46,
                            'rp_topspeed' => 9,
                            'race_type_code' => 'F',
                        ]
                    ),
                    19 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 10,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 43,
                            'rp_topspeed' => 32,
                            'race_type_code' => 'F',
                        ]
                    ),
                    20 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 37,
                            'rp_topspeed' => 15,
                            'race_type_code' => 'F',
                        ]
                    ),
                    21 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 6,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 46,
                            'rp_topspeed' => 21,
                            'race_type_code' => 'F',
                        ]
                    ),
                    22 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 4,
                            'wins' => 0,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 31,
                            'rp_topspeed' => 0,
                            'race_type_code' => 'F',
                        ]
                    ),
                    23 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good_to_firm',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 51,
                            'rp_topspeed' => 42,
                            'race_type_code' => 'F',
                        ]
                    ),
                    24 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 823159,
                            'runs' => 7,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 51,
                            'rp_topspeed' => 16,
                            'race_type_code' => 'F',
                        ]
                    ),
                    25 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 856426,
                            'runs' => 5,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 88,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                    26 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 856426,
                            'runs' => 5,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 80,
                            'rp_topspeed' => 9,
                            'race_type_code' => 'B',
                        ]
                    ),
                    27 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 856426,
                            'runs' => 5,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 68,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'B',
                        ]
                    ),
                    28 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 856426,
                            'runs' => 5,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 112,
                            'rp_topspeed' => 11,
                            'race_type_code' => 'H',
                        ]
                    ),
                    29 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 856426,
                            'runs' => 5,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 43,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'H',
                        ]
                    ),
                    30 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 856426,
                            'runs' => 2,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 115,
                            'rp_topspeed' => 41,
                            'race_type_code' => 'H',
                        ]
                    ),
                    31 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 856426,
                            'runs' => 2,
                            'wins' => 0,
                            'going_group' => 'good',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => 'U',
                            'rp_postmark' => 98,
                            'rp_topspeed' => 65,
                            'race_type_code' => 'C',
                        ]
                    ),
                ],
                [
                    823159 => GeneralRow::createFromArray(
                        [
                            'heavy_soft' => GeneralRow::createFromArray(
                                [
                                    'horse_uid' => 823159,
                                    'runs' => 4,
                                    'wins' => 0,
                                    'going_group' => 'heavy_soft',
                                    'going_form' => [
                                        0 => 5,
                                        1 => 5,
                                        2 => 5,
                                        3 => 8,
                                    ],
                                    'top_rpr_flat' => false,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => GeneralRow::createFromArray(
                                        [
                                            'horse_uid' => 823159,
                                            'runs' => 4,
                                            'wins' => 0,
                                            'going_group' => 'heavy_soft',
                                            'race_outcome_position' => 5,
                                            'race_outcome_form_char' => 'U',
                                            'rp_postmark' => 55,
                                            'rp_topspeed' => 50,
                                            'race_type_code' => 'F',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_soft' => GeneralRow::createFromArray(
                                [
                                    'horse_uid' => 823159,
                                    'runs' => 6,
                                    'wins' => 0,
                                    'going_group' => 'good_to_soft',
                                    'going_form' => [
                                        0 => 5,
                                        1 => 3,
                                        2 => 9,
                                        3 => 8,
                                        4 => 5,
                                        5 => 6,
                                    ],
                                    'top_rpr_flat' => true,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => GeneralRow::createFromArray(
                                        [
                                            'horse_uid' => 823159,
                                            'runs' => 6,
                                            'wins' => 0,
                                            'going_group' => 'good_to_soft',
                                            'race_outcome_position' => 3,
                                            'race_outcome_form_char' => 'U',
                                            'rp_postmark' => 54,
                                            'rp_topspeed' => 50,
                                            'race_type_code' => 'F',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good' => GeneralRow::createFromArray(
                                [
                                    'horse_uid' => 823159,
                                    'runs' => 7,
                                    'wins' => 0,
                                    'going_group' => 'good',
                                    'going_form' => [
                                        0 => 0,
                                        1 => 2,
                                        2 => 6,
                                        3 => 0,
                                        4 => 0,
                                        5 => 5,
                                        6 => 3,
                                    ],
                                    'top_rpr_flat' => true,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => true,
                                    'topspeed_flat_race' => GeneralRow::createFromArray(
                                        [
                                            'horse_uid' => 823159,
                                            'runs' => 7,
                                            'wins' => 0,
                                            'going_group' => 'good',
                                            'race_outcome_position' => 2,
                                            'race_outcome_form_char' => 'U',
                                            'rp_postmark' => 59,
                                            'rp_topspeed' => 54,
                                            'race_type_code' => 'F',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_firm' => GeneralRow::createFromArray(
                                [
                                    'horse_uid' => 823159,
                                    'runs' => 7,
                                    'wins' => 0,
                                    'going_group' => 'good_to_firm',
                                    'going_form' => [
                                        0 => 8,
                                        1 => 5,
                                        2 => 6,
                                        3 => 4,
                                        4 => 8,
                                        5 => 5,
                                        6 => 3,
                                    ],
                                    'top_rpr_flat' => false,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => GeneralRow::createFromArray(
                                        [
                                            'horse_uid' => 823159,
                                            'runs' => 7,
                                            'wins' => 0,
                                            'going_group' => 'good_to_firm',
                                            'race_outcome_position' => 3,
                                            'race_outcome_form_char' => 'U',
                                            'rp_postmark' => 51,
                                            'rp_topspeed' => 42,
                                            'race_type_code' => 'F',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'firm' => GeneralRow::createFromArray(
                                [
                                    'horse_uid' => 823159,
                                    'runs' => 1,
                                    'wins' => 0,
                                    'going_group' => 'firm',
                                    'going_form' => [
                                        0 => 3,
                                    ],
                                    'top_rpr_flat' => false,
                                    'top_rpr_jumps' => false,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => GeneralRow::createFromArray(
                                        [
                                            'horse_uid' => 823159,
                                            'runs' => 1,
                                            'wins' => 0,
                                            'going_group' => 'firm',
                                            'race_outcome_position' => 3,
                                            'race_outcome_form_char' => 'U',
                                            'rp_postmark' => 50,
                                            'rp_topspeed' => 24,
                                            'race_type_code' => 'F',
                                        ]
                                    ),
                                    'topspeed_jumps_race' => null,
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                        ]
                    ),
                    856426 => GeneralRow::createFromArray(
                        [
                            'heavy_soft' => GeneralRow::createFromArray(
                                [
                                    'horse_uid' => 856426,
                                    'runs' => 5,
                                    'wins' => 2,
                                    'going_group' => 'heavy_soft',
                                    'going_form' => [
                                        0 => 1,
                                        1 => 3,
                                        2 => 6,
                                        3 => 1,
                                        4 => 5,
                                    ],
                                    'top_rpr_flat' => false,
                                    'top_rpr_jumps' => true,
                                    'topspeed_rating' => false,
                                    'topspeed_flat_race' => null,
                                    'topspeed_jumps_race' => GeneralRow::createFromArray(
                                        [
                                            'horse_uid' => 856426,
                                            'runs' => 5,
                                            'wins' => 2,
                                            'going_group' => 'heavy_soft',
                                            'race_outcome_position' => 1,
                                            'race_outcome_form_char' => 'U',
                                            'rp_postmark' => 112,
                                            'rp_topspeed' => 11,
                                            'race_type_code' => 'H',
                                        ]
                                    ),
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_soft' => null,
                            'good' => GeneralRow::createFromArray(
                                [
                                    'horse_uid' => 856426,
                                    'runs' => 2,
                                    'wins' => 0,
                                    'going_group' => 'good',
                                    'going_form' => [
                                        0 => 5,
                                        1 => 6,
                                    ],
                                    'top_rpr_flat' => false,
                                    'top_rpr_jumps' => true,
                                    'topspeed_rating' => true,
                                    'topspeed_flat_race' => null,
                                    'topspeed_jumps_race' => GeneralRow::createFromArray(
                                        [
                                            'horse_uid' => 856426,
                                            'runs' => 2,
                                            'wins' => 0,
                                            'going_group' => 'good',
                                            'race_outcome_position' => 6,
                                            'race_outcome_form_char' => 'U',
                                            'rp_postmark' => 98,
                                            'rp_topspeed' => 65,
                                            'race_type_code' => 'C',
                                        ]
                                    ),
                                    'sire_wins' => null,
                                    'sire_runs' => null,
                                    'sire_impact_value' => null,
                                ]
                            ),
                            'good_to_firm' => null,
                            'firm' => null,
                        ]
                    ),
                ]
            ],
            [
                [1, 2, 3],
                [],
                null
            ]
        ];
    }

    /**
     * @param int   $horseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetStableTourQuotes
     */
    public function testGetStableTourQuotes($horseId, $expectedResult)
    {

        $horseProfileObject = new Stubs\Bo\HorseProfile($horseId);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($horseProfileObject->getStableTourQuotes())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStableTourQuotes()
    {
        $today = (new \DateTime())->format('d/m/Y');

        return [
            [
                737210,
                [
                    GeneralRow::createFromArray(
                        [
                            "horse_uid" => 737210,
                            "horse_name" => "Simenon",
                            "notes" => "Has done well for us on the Flat and over hurdles. - " . $today
                        ]
                    )
                ]
            ]
        ];
    }
}
