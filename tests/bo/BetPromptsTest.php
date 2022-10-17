<?php

namespace Tests\Bo;

use Api\Input\Request\Horses\BetPrompts\Index;
use Phalcon\Mvc\Model\Row\General;
use Tests\Stubs\Bo\BetPrompts;

class BetPromptsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Index $request
     * @param array $expectedResult
     *
     * @group        debug
     *
     * @dataProvider providerTestGetBetPrompts
     */
    public function testGetBetPrompts(Index $request, $expectedResult)
    {
        $bo = new BetPrompts($request);
        $actual = $bo->getBetPrompts();
        $this->assertEquals($expectedResult, $actual);
    }

    /**
     * @return array
     */
    public function providerTestGetBetPrompts()
    {
        return [
            [
                new Index([3], ['raceId' => 671692]),
                General::createFromArray(
                    array(
                        'course_style_name' => 'Ayr',
                        'race_datetime' => 'Apr 21 2017  3:50PM',
                        'race_type_code' => 'C',
                        'course_uid' => 3,
                        'country_code' => 'GB',
                        'race_group_code' => 'H',
                        'race_status_code' => 'O',
                        'declared_runners' => 29,
                        'no_of_runners' => 29,
                        'going_type_desc' => 'Good To Soft',
                        'rp_tv_text' => 'RUK',
                        'distance_yard' => 4510,
                        'most_tipped' => null,
                        'most_napped' => null,
                        'post_data_selection' => null,
                        'rpr_selection' => null,
                        'hot_trainers' => null,
                        'hot_jockeys' => [
                            86032 => General::createFromArray(
                                [
                                    'jockey_uid' => 86032,
                                    'jockey_name' => 'Aidan Coleman',
                                    'wins_14' => 11,
                                    'runs_14' => 38,
                                    'percentage' => 29,
                                    'entries' => [
                                        0 => \Api\Row\Signposts::createFromArray(
                                            [
                                                'race_datetime' => 'Apr 21 2017  3:50PM',
                                                'race_instance_uid' => 671692,
                                                'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                'declared_runners' => 8,
                                                'race_group_desc' => 'Listed Handicap',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1243709,
                                                'horse_name' => 'Calipto',
                                                'horse_uid' => 845090,
                                                'horse_country_origin_code' => 'FR',
                                                'course_name' => 'Ayr',
                                                'course_uid' => 3,
                                                'country_code' => 'GB ',
                                                'owner_uid' => 181256,
                                                'rp_owner_choice' => 'a',
                                                'saddle_cloth_no' => 5,
                                                'non_runner' => null,
                                            ]
                                        ),
                                    ],
                                    'bet_prompt_rating' => 9,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 9.0,
                                ]
                            ),
                            77030 => General::createFromArray(
                                array(
                                    'jockey_uid' => 77030,
                                    'jockey_name' => 'Davy Russell',
                                    'wins_14' => 7,
                                    'runs_14' => 20,
                                    'percentage' => 35,
                                    'entries' =>
                                        array(
                                            0 =>
                                                \Api\Row\Signposts::createFromArray(
                                                    array(
                                                        'race_datetime' => 'Apr 21 2017  3:50PM',
                                                        'race_instance_uid' => 671692,
                                                        'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                        'declared_runners' => 8,
                                                        'race_group_desc' => 'Listed Handicap',
                                                        'perform_race_uid_atr' => null,
                                                        'perform_race_uid_ruk' => 1243709,
                                                        'horse_name' => 'Two Taffs',
                                                        'horse_uid' => 873424,
                                                        'horse_country_origin_code' => 'IRE',
                                                        'course_name' => 'Ayr',
                                                        'course_uid' => 3,
                                                        'country_code' => 'GB ',
                                                        'owner_uid' => 198474,
                                                        'rp_owner_choice' => 'a',
                                                        'saddle_cloth_no' => 3,
                                                        'non_runner' => null,
                                                    )
                                                ),
                                        ),
                                    'bet_prompt_rating' => 9,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 9,
                                )
                            ),

                        ],
                        'course_jockeys' => null,
                        'course_trainers' => null,
                        'trainers_jockeys' => null,
                        'horses_for_courses' => null,
                        'ahead_of_handicapper' => null,
                        'seven_day_winners' => null,
                        'travellers_check' => [
                            873424 =>
                                \Api\Row\Signposts::createFromArray(
                                    [
                                        'race_datetime' => 'Apr 21 2017  3:50PM',
                                        'country_code' => 'GB',
                                        'course_name' => 'Ayr',
                                        'horse_name' => 'Two Taffs',
                                        'horse_country_origin_code' => 'IRE',
                                        'dist_out' => '298',
                                        'trav_out' => null,
                                        'all_out' => '; all 18%',
                                        'trainer_name' => 'Dan Skelton',
                                        'trav_wins' => 18,
                                        'trav_runs' => 74,
                                        'trav_perc' => 24,
                                        'course_uid' => 3,
                                        'horse_uid' => 873424,
                                        'saddle_cloth_no' => 3,
                                        'trainer_uid' => 16270,
                                        'rp_owner_choice' => 'a',
                                        'owner_uid' => 198474,
                                        'non_runner' => null,
                                        'race_instance_uid' => 671692,
                                        'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                        'declared_runners' => 8,
                                        'race_group_desc' => 'Listed Handicap',
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => 1243709,
                                        'bet_prompt_rating' => 9,
                                        'bet_prompt_weighting' => 100,
                                        'bet_prompt_score' => 9.0,
                                    ]
                                ),
                            848199 =>
                                \Api\Row\Signposts::createFromArray(
                                    [
                                        'race_datetime' => 'Apr 21 2017  3:50PM',
                                        'country_code' => 'GB',
                                        'course_name' => 'Ayr',
                                        'horse_name' => 'Warriors Tale',
                                        'horse_country_origin_code' => 'GB',
                                        'dist_out' => '370',
                                        'trav_out' => null,
                                        'all_out' => '; all 23%',
                                        'trainer_name' => 'Paul Nicholls',
                                        'trav_wins' => 56,
                                        'trav_runs' => 197,
                                        'trav_perc' => 28,
                                        'course_uid' => 3,
                                        'horse_uid' => 848199,
                                        'saddle_cloth_no' => 2,
                                        'trainer_uid' => 5767,
                                        'rp_owner_choice' => 'a',
                                        'owner_uid' => 198532,
                                        'non_runner' => null,
                                        'race_instance_uid' => 671692,
                                        'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                        'declared_runners' => 8,
                                        'race_group_desc' => 'Listed Handicap',
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => 1243709,
                                        'bet_prompt_rating' => 10,
                                        'bet_prompt_weighting' => 100,
                                        'bet_prompt_score' => 10.0,
                                    ]
                                ),
                        ],
                    )
                )
            ],
            [
                new Index([], ['raceId' => 671692]),
                General::createFromArray(
                    array(
                        'course_style_name' => 'Ayr',
                        'race_datetime' => 'Apr 21 2017  3:50PM',
                        'race_type_code' => 'C',
                        'course_uid' => 3,
                        'country_code' => 'GB',
                        'race_group_code' => 'H',
                        'race_status_code' => 'O',
                        'declared_runners' => 29,
                        'no_of_runners' => 29,
                        'going_type_desc' => 'Good To Soft',
                        'rp_tv_text' => 'RUK',
                        'distance_yard' => 4510,
                        'most_tipped' => null,
                        'most_napped' => [
                            845090 => \Api\Row\BetPrompts\BetPrompts::createFromArray(
                                array(
                                    'horse_uid' => 845090,
                                    'horse_name' => 'Calipto',
                                    'saddle_cloth_no' => 5,
                                    'owner_uid' => 181256,
                                    'naps' =>
                                        array(
                                            0 =>
                                                \Api\Row\BetPrompts\BetPrompts::createFromArray(array(
                                                    'newspaper_uid' => 1,
                                                    'newspaper_name' => 'SPOTLIGHT',
                                                )),
                                            1 =>
                                                \Api\Row\BetPrompts\BetPrompts::createFromArray(array(
                                                    'newspaper_uid' => 12,
                                                    'newspaper_name' => 'Daily Mail',
                                                )),
                                        ),
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null,
                                    'nap_count' => 2,
                                    'most_napped_today' => 3,
                                    'country_origin_code' => 'FR',
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_rating' => 2,
                                    'bet_prompt_score' => 2,
                                )
                            ),
                        ],
                        'post_data_selection' => \Api\Row\BetPrompts\BetPrompts::createFromArray(array(
                            'horse_uid' => 832408,
                            'horse_name' => 'Theinval',
                            'saddle_cloth_no' => 1,
                            'owner_uid' => 130080,
                            'rp_owner_choice' => 'a',
                            'non_runner' => null,
                            'country_origin_code' => 'FR',
                            'post_data_total' => 8,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_rating' => 5,
                            'bet_prompt_score' => 5,
                            'trainer_form_output' => 2,
                            'going_output' => 1,
                            'distance_output' => 1,
                            'course_output' => 0,
                            'draw_output' => 0,
                            'ability_output' => 2,
                            'recent_form_output' => 2,
                        )),
                        'rpr_selection' => \Api\Row\BetPrompts\BetPrompts::createFromArray(array(
                            'horse_uid' => 845090,
                            'horse_name' => 'Calipto',
                            'saddle_cloth_no' => 5,
                            'owner_uid' => 181256,
                            'rp_owner_choice' => 'a',
                            'non_runner' => null,
                            'rp_postmark' => 158,
                            'rpr_nap' => 0,
                            'country_origin_code' => 'FR',
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_rating' => 5,
                            'bet_prompt_score' => 5,
                        )),
                        'hot_trainers' => [
                            311 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                'trainer_uid' => 311,
                                'trainer_name' => 'Nicky Henderson',
                                'wins_14' => 12,
                                'runs_14' => 39,
                                'percentage' => 31,
                                'entries' =>
                                    array(
                                        0 =>
                                            \Api\Row\Signposts::createFromArray(array(
                                                'race_datetime' => 'Apr 21 2017  3:50PM',
                                                'race_instance_uid' => 671692,
                                                'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                'declared_runners' => 8,
                                                'race_group_desc' => 'Listed Handicap',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1243709,
                                                'horse_name' => 'Theinval',
                                                'horse_uid' => 832408,
                                                'horse_country_origin_code' => 'FR',
                                                'course_name' => 'Ayr',
                                                'course_uid' => 3,
                                                'country_code' => 'GB ',
                                                'owner_uid' => 130080,
                                                'rp_owner_choice' => 'a',
                                                'saddle_cloth_no' => 1,
                                                'non_runner' => null,
                                            )),
                                    ),
                                'bet_prompt_rating' => 7,
                                'bet_prompt_weighting' => 100,
                                'bet_prompt_score' => 7.00000000000000088817841970012523233890533447265625,
                            )),
                            5767 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'trainer_uid' => 5767,
                                    'trainer_name' => 'Paul Nicholls',
                                    'wins_14' => 14,
                                    'runs_14' => 48,
                                    'percentage' => 29,
                                    'entries' =>
                                        array(
                                            0 =>
                                                \Api\Row\Signposts::createFromArray(array(
                                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                                    'race_instance_uid' => 671692,
                                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                    'declared_runners' => 8,
                                                    'race_group_desc' => 'Listed Handicap',
                                                    'perform_race_uid_atr' => null,
                                                    'perform_race_uid_ruk' => 1243709,
                                                    'horse_name' => 'Warriors Tale',
                                                    'horse_uid' => 848199,
                                                    'horse_country_origin_code' => 'GB',
                                                    'course_name' => 'Ayr',
                                                    'course_uid' => 3,
                                                    'country_code' => 'GB ',
                                                    'owner_uid' => 198532,
                                                    'rp_owner_choice' => 'a',
                                                    'saddle_cloth_no' => 2,
                                                    'non_runner' => null,
                                                )),
                                        ),
                                    'bet_prompt_rating' => 6,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 6.0,
                                )),
                        ],
                        'hot_jockeys' => [
                            77030 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'jockey_uid' => 77030,
                                    'jockey_name' => 'Davy Russell',
                                    'wins_14' => 7,
                                    'runs_14' => 20,
                                    'percentage' => 35,
                                    'entries' =>
                                        array(
                                            0 =>
                                                \Api\Row\Signposts::createFromArray(array(
                                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                                    'race_instance_uid' => 671692,
                                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                    'declared_runners' => 8,
                                                    'race_group_desc' => 'Listed Handicap',
                                                    'perform_race_uid_atr' => null,
                                                    'perform_race_uid_ruk' => 1243709,
                                                    'horse_name' => 'Two Taffs',
                                                    'horse_uid' => 873424,
                                                    'horse_country_origin_code' => 'IRE',
                                                    'course_name' => 'Ayr',
                                                    'course_uid' => 3,
                                                    'country_code' => 'GB ',
                                                    'owner_uid' => 198474,
                                                    'rp_owner_choice' => 'a',
                                                    'saddle_cloth_no' => 3,
                                                    'non_runner' => null,
                                                )),
                                        ),
                                    'bet_prompt_rating' => 9,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 9,
                                )),
                            86032 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'jockey_uid' => 86032,
                                    'jockey_name' => 'Aidan Coleman',
                                    'wins_14' => 11,
                                    'runs_14' => 38,
                                    'percentage' => 29,
                                    'entries' =>
                                        array(
                                            0 =>
                                                \Api\Row\Signposts::createFromArray(array(
                                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                                    'race_instance_uid' => 671692,
                                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                    'declared_runners' => 8,
                                                    'race_group_desc' => 'Listed Handicap',
                                                    'perform_race_uid_atr' => null,
                                                    'perform_race_uid_ruk' => 1243709,
                                                    'horse_name' => 'Calipto',
                                                    'horse_uid' => 845090,
                                                    'horse_country_origin_code' => 'FR',
                                                    'course_name' => 'Ayr',
                                                    'course_uid' => 3,
                                                    'country_code' => 'GB ',
                                                    'owner_uid' => 181256,
                                                    'rp_owner_choice' => 'a',
                                                    'saddle_cloth_no' => 5,
                                                    'non_runner' => null,
                                                )),
                                        ),
                                    'bet_prompt_rating' => 9,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 9,
                                )),
                            89791 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'jockey_uid' => 89791,
                                    'jockey_name' => 'Jeremiah McGrath',
                                    'wins_14' => 5,
                                    'runs_14' => 13,
                                    'percentage' => 38,
                                    'entries' =>
                                        array(
                                            0 =>
                                                \Api\Row\Signposts::createFromArray(array(
                                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                                    'race_instance_uid' => 671692,
                                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                    'declared_runners' => 8,
                                                    'race_group_desc' => 'Listed Handicap',
                                                    'perform_race_uid_atr' => null,
                                                    'perform_race_uid_ruk' => 1243709,
                                                    'horse_name' => 'Theinval',
                                                    'horse_uid' => 832408,
                                                    'horse_country_origin_code' => 'FR',
                                                    'course_name' => 'Ayr',
                                                    'course_uid' => 3,
                                                    'country_code' => 'GB ',
                                                    'owner_uid' => 130080,
                                                    'rp_owner_choice' => 'a',
                                                    'saddle_cloth_no' => 1,
                                                    'non_runner' => null,
                                                )),
                                        ),
                                    'bet_prompt_rating' => 8,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 8,
                                )),
                        ],
                        'course_jockeys' => [
                            3 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'course_uid' => 3,
                                    'course_name' => 'Ayr',
                                    'country_code' => 'GB ',
                                    'jockeys' =>
                                        array(
                                            93186 =>
                                                \Api\Row\Signposts::createFromArray(array(
                                                    'jockey_uid' => 93186,
                                                    'jockey_name' => 'Sean Bowen',
                                                    'd7_wins' => 3,
                                                    'd7_runs' => 12,
                                                    'd7_perc' => 25,
                                                    'entries' =>
                                                        array(
                                                            0 =>
                                                                \Api\Row\Horse::createFromArray(array(
                                                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                                                    'race_instance_uid' => 671692,
                                                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                                    'declared_runners' => 8,
                                                                    'race_group_desc' => 'Listed Handicap',
                                                                    'perform_race_uid_atr' => null,
                                                                    'perform_race_uid_ruk' => 1243709,
                                                                    'horse_name' => 'Warriors Tale',
                                                                    'horse_uid' => 848199,
                                                                    'horse_country_origin_code' => 'GB',
                                                                    'course_name' => 'Ayr',
                                                                    'course_uid' => 3,
                                                                    'country_code' => 'GB ',
                                                                    'owner_uid' => 198532,
                                                                    'rp_owner_choice' => 'a',
                                                                    'saddle_cloth_no' => 2,
                                                                    'non_runner' => null,
                                                                )),
                                                        ),
                                                    'bet_prompt_rating' => 5,
                                                    'bet_prompt_weighting' => 100,
                                                    'bet_prompt_score' => 5.0,
                                                )),
                                        ),
                                )),
                        ],
                        'course_trainers' => [
                            3 =>
                                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                                    'course_uid' => 3,
                                    'course_name' => 'Ayr',
                                    'country_code' => 'GB ',
                                    'trainers' =>
                                        array(
                                            5767 =>
                                                \Api\Row\Signposts::createFromArray(array(
                                                    'trainer_uid' => 5767,
                                                    'trainer_name' => 'Paul Nicholls',
                                                    'd7_wins' => 8,
                                                    'd7_runs' => 28,
                                                    'd7_perc' => 29,
                                                    'entries' =>
                                                        array(
                                                            0 =>
                                                                \Api\Row\Horse::createFromArray(array(
                                                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                                                    'race_instance_uid' => 671692,
                                                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                                    'declared_runners' => 8,
                                                                    'race_group_desc' => 'Listed Handicap',
                                                                    'perform_race_uid_atr' => null,
                                                                    'perform_race_uid_ruk' => 1243709,
                                                                    'horse_name' => 'Warriors Tale',
                                                                    'horse_uid' => 848199,
                                                                    'horse_country_origin_code' => 'GB',
                                                                    'course_name' => 'Ayr',
                                                                    'course_uid' => 3,
                                                                    'country_code' => 'GB ',
                                                                    'owner_uid' => 198532,
                                                                    'rp_owner_choice' => 'a',
                                                                    'saddle_cloth_no' => 2,
                                                                    'non_runner' => null,
                                                                )),
                                                        ),
                                                    'bet_prompt_rating' => 7,
                                                    'bet_prompt_weighting' => 100,
                                                    'bet_prompt_score' => 7.00000000000000088817841970012523233890533447265625,
                                                )),
                                            16270 =>
                                                \Api\Row\Signposts::createFromArray(array(
                                                    'trainer_uid' => 16270,
                                                    'trainer_name' => 'Dan Skelton',
                                                    'd7_wins' => 7,
                                                    'd7_runs' => 24,
                                                    'd7_perc' => 29,
                                                    'entries' =>
                                                        array(
                                                            0 =>
                                                                \Api\Row\Horse::createFromArray(array(
                                                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                                                    'race_instance_uid' => 671692,
                                                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                                                    'declared_runners' => 8,
                                                                    'race_group_desc' => 'Listed Handicap',
                                                                    'perform_race_uid_atr' => null,
                                                                    'perform_race_uid_ruk' => 1243709,
                                                                    'horse_name' => 'Two Taffs',
                                                                    'horse_uid' => 873424,
                                                                    'horse_country_origin_code' => 'IRE',
                                                                    'course_name' => 'Ayr',
                                                                    'course_uid' => 3,
                                                                    'country_code' => 'GB ',
                                                                    'owner_uid' => 198474,
                                                                    'rp_owner_choice' => 'a',
                                                                    'saddle_cloth_no' => 3,
                                                                    'non_runner' => null,
                                                                )),
                                                        ),
                                                    'bet_prompt_rating' => 7,
                                                    'bet_prompt_weighting' => 100,
                                                    'bet_prompt_score' => 7.00000000000000088817841970012523233890533447265625,
                                                )),
                                        ),
                                )),
                        ],
                        'trainers_jockeys' => null,
                        'horses_for_courses' => null,
                        'ahead_of_handicapper' => null,
                        'seven_day_winners' => null,
                        'travellers_check' => [
                            845090 => \Api\Row\Signposts::createFromArray(
                                array(
                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                    'country_code' => 'GB',
                                    'course_name' => 'Ayr',
                                    'horse_name' => 'Calipto',
                                    'horse_country_origin_code' => 'FR',
                                    'dist_out' => '303',
                                    'trav_out' => null,
                                    'all_out' => '; all 14%',
                                    'trainer_name' => 'Venetia Williams',
                                    'trav_wins' => 20,
                                    'trav_runs' => 138,
                                    'trav_perc' => 14,
                                    'course_uid' => 3,
                                    'horse_uid' => 845090,
                                    'saddle_cloth_no' => 5,
                                    'trainer_uid' => 9746,
                                    'rp_owner_choice' => 'a',
                                    'owner_uid' => 181256,
                                    'non_runner' => null,
                                    'race_instance_uid' => 671692,
                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                    'declared_runners' => 8,
                                    'race_group_desc' => 'Listed Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1243709,
                                    'bet_prompt_rating' => 1,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 1.0,
                                )
                            ),
                            832408 => \Api\Row\Signposts::createFromArray(
                                array(
                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                    'country_code' => 'GB',
                                    'course_name' => 'Ayr',
                                    'horse_name' => 'Theinval',
                                    'horse_country_origin_code' => 'FR',
                                    'dist_out' => '355',
                                    'trav_out' => null,
                                    'all_out' => '; all 24%',
                                    'trainer_name' => 'Nicky Henderson',
                                    'trav_wins' => 56,
                                    'trav_runs' => 247,
                                    'trav_perc' => 23,
                                    'course_uid' => 3,
                                    'horse_uid' => 832408,
                                    'saddle_cloth_no' => 1,
                                    'trainer_uid' => 311,
                                    'rp_owner_choice' => 'a',
                                    'owner_uid' => 130080,
                                    'non_runner' => null,
                                    'race_instance_uid' => 671692,
                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                    'declared_runners' => 8,
                                    'race_group_desc' => 'Listed Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1243709,
                                    'bet_prompt_rating' => 8,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 8.0,
                                )
                            ),
                            873424 => \Api\Row\Signposts::createFromArray(
                                array(
                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                    'country_code' => 'GB',
                                    'course_name' => 'Ayr',
                                    'horse_name' => 'Two Taffs',
                                    'horse_country_origin_code' => 'IRE',
                                    'dist_out' => '298',
                                    'trav_out' => null,
                                    'all_out' => '; all 18%',
                                    'trainer_name' => 'Dan Skelton',
                                    'trav_wins' => 18,
                                    'trav_runs' => 74,
                                    'trav_perc' => 24,
                                    'course_uid' => 3,
                                    'horse_uid' => 873424,
                                    'saddle_cloth_no' => 3,
                                    'trainer_uid' => 16270,
                                    'rp_owner_choice' => 'a',
                                    'owner_uid' => 198474,
                                    'non_runner' => null,
                                    'race_instance_uid' => 671692,
                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                    'declared_runners' => 8,
                                    'race_group_desc' => 'Listed Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1243709,
                                    'bet_prompt_rating' => 9,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 9.0,
                                )
                            ),
                            833171 => \Api\Row\Signposts::createFromArray(
                                array(
                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                    'country_code' => 'GB',
                                    'course_name' => 'Ayr',
                                    'horse_name' => 'The Grey Taylor',
                                    'horse_country_origin_code' => 'IRE',
                                    'dist_out' => '214',
                                    'trav_out' => null,
                                    'all_out' => '; all 13%',
                                    'trainer_name' => 'Brian Ellison',
                                    'trav_wins' => 117,
                                    'trav_runs' => 1092,
                                    'trav_perc' => 11,
                                    'course_uid' => 3,
                                    'horse_uid' => 833171,
                                    'saddle_cloth_no' => 8,
                                    'trainer_uid' => 4431,
                                    'rp_owner_choice' => 'b',
                                    'owner_uid' => 153965,
                                    'non_runner' => null,
                                    'race_instance_uid' => 671692,
                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                    'declared_runners' => 8,
                                    'race_group_desc' => 'Listed Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1243709,
                                    'bet_prompt_rating' => 1,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 1.0,
                                )
                            ),
                            848199 => \Api\Row\Signposts::createFromArray(
                                array(
                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                    'country_code' => 'GB',
                                    'course_name' => 'Ayr',
                                    'horse_name' => 'Warriors Tale',
                                    'horse_country_origin_code' => 'GB',
                                    'dist_out' => '370',
                                    'trav_out' => null,
                                    'all_out' => '; all 23%',
                                    'trainer_name' => 'Paul Nicholls',
                                    'trav_wins' => 56,
                                    'trav_runs' => 197,
                                    'trav_perc' => 28,
                                    'course_uid' => 3,
                                    'horse_uid' => 848199,
                                    'saddle_cloth_no' => 2,
                                    'trainer_uid' => 5767,
                                    'rp_owner_choice' => 'a',
                                    'owner_uid' => 198532,
                                    'non_runner' => null,
                                    'race_instance_uid' => 671692,
                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                    'declared_runners' => 8,
                                    'race_group_desc' => 'Listed Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1243709,
                                    'bet_prompt_rating' => 10,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 10.0,
                                )
                            ),
                            874547 => \Api\Row\Signposts::createFromArray(
                                array(
                                    'race_datetime' => 'Apr 21 2017  3:50PM',
                                    'country_code' => 'GB',
                                    'course_name' => 'Ayr',
                                    'horse_name' => 'Drumlee Sunset',
                                    'horse_country_origin_code' => 'IRE',
                                    'dist_out' => '358',
                                    'trav_out' => null,
                                    'all_out' => '; all 17%',
                                    'trainer_name' => 'Philip Hobbs',
                                    'trav_wins' => 27,
                                    'trav_runs' => 149,
                                    'trav_perc' => 18,
                                    'course_uid' => 3,
                                    'horse_uid' => 874547,
                                    'saddle_cloth_no' => 6,
                                    'trainer_uid' => 135,
                                    'rp_owner_choice' => 'g',
                                    'owner_uid' => 11234,
                                    'non_runner' => null,
                                    'race_instance_uid' => 671692,
                                    'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                                    'declared_runners' => 8,
                                    'race_group_desc' => 'Listed Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1243709,
                                    'bet_prompt_rating' => 1,
                                    'bet_prompt_weighting' => 100,
                                    'bet_prompt_score' => 1,
                                )
                            ),
                        ],
                    )
                )
            ]
        ];
    }
}
