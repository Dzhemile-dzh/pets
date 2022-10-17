<?php

namespace Tests\Stubs\DataProvider\Bo\Signposts;

use Api\DataProvider\Bo\Signposts\UpcomingRaces as DataProvider;
use Phalcon\Mvc\Model\Row\General as Row;
use Api\Row\Signposts as RowSignposts;
use Api\Row\Horse as RowHorse;

/**
 * Class UpcomingRaces
 *
 * @package Tests\Stubs\DataProvider\Bo\Signposts
 */
class UpcomingRaces extends DataProvider
{
    use \Tests\Stubs\Models\StubDataGetter;

    /**
     * @return array
     */
    public function getTrainers()
    {
        $data = [
            'daily_21_645366' => [
                16270 => Row::createFromArray(
                    [
                        "trainer_uid" => 16270,
                        "trainer_name" => "Dan Skelton",
                        "wins_14" => 4,
                        "runs" => 12,
                        "percentage" => 33,
                        "entries" => [
                            0 => Row::createFromArray(
                                [
                                    'race_instance_uid' => 654782,
                                    'race_instance_title' => 'Nonsuch Park Handicap',
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    "race_datetime" => "2016-02-15T14:10:00+00:00",
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157167,
                                    "horse_name" => "Yes I Did",
                                    "horse_uid" => 877583,
                                    "course_style_name" => "Catterick",
                                    "diffusion_course_name" => "Catterick",
                                    "course_uid" => 10,
                                    "course_country_code" => "GB",
                                    'owner_uid' => 8968,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null
                                ]
                            ),
                            1 => Row::createFromArray(
                                [
                                    'race_instance_uid' => 654782,
                                    'race_instance_title' => 'Nonsuch Park Handicap',
                                    "race_datetime" => "2016-02-15T14:10:00+00:00",
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157167,
                                    "horse_name" => "Yes I Did",
                                    "horse_uid" => 857307,
                                    "course_style_name" => "Catterick",
                                    "diffusion_course_name" => "Catterick",
                                    "course_uid" => 10,
                                    "course_country_code" => "GB",
                                    'owner_uid' => 8968,
                                    'rp_owner_choice' => 'b',
                                    'non_runner' => null
                                ]
                            ),
                        ]
                    ]
                ),
                10157 => Row::createFromArray(
                    [
                        "trainer_uid" => 10157,
                        "trainer_name" => "David Pipe",
                        "wins_14" => 5,
                        "runs" => 16,
                        "percentage" => 31,
                        "entries" => [
                            0 => Row::createFromArray(
                                [
                                    "race_datetime" => "2016-02-15T14:00:00+00:00",
                                    "horse_name" => "Bella",
                                    "horse_uid" => 876329,
                                    "course_style_name" => "Plumpton",
                                    "diffusion_course_name" => "Plumpton",
                                    "course_uid" => 44,
                                    "course_country_code" => "GB",
                                    'owner_uid' => 8968,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null
                                ]
                            ),
                        ]
                    ]
                )
            ],
            'daily_671692' => array(
                311 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'trainer_uid' => 311,
                            'trainer_name' => 'Nicky Henderson',
                            'wins_14' => 12,
                            'runs_14' => 39,
                            'percentage' => 31,
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
                                            )
                                        ),
                                ),
                            'bet_prompt_rating' => 7,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 7.0000000000000009,
                        )
                    ),
                5767 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'trainer_uid' => 5767,
                            'trainer_name' => 'Paul Nicholls',
                            'wins_14' => 14,
                            'runs_14' => 48,
                            'percentage' => 29,
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
                                            )
                                        ),
                                ),
                            'bet_prompt_rating' => 6,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 6,
                        )
                    ),
            ),
            'daily_684597' => array(),
            'daily_683563' => array(),
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @param string $date
     *
     * @return array
     */
    public function getSweetspots($date)
    {
        return array(
            0 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 682989,
                    'race_datetime' => 'Sep 13 2017  9:15PM',
                    'course_uid' => 1079,
                    'course_style_name' => 'Kempton (A.W)',
                    'verdict' => 'Richard Hannon operates at a 31% strike-rate with horses sporting first-time cheekpieces. Lester Kris gets the aid in the 9.15 at Kempton.',
                    'horse_uid' => 1041604,
                    'horse_name' => 'Lester Kris',
                    'start_number' => 2,
                    'non_runner' => 'N',
                    'jockey_uid' => 75506,
                    'jockey_name' => 'Pat Dobbs',
                    'owner_uid' => 218206,
                    'owner_name' => 'Middleham Park Racing XCIX',
                    'trainer_name' => 'Richard Hannon',
                    'trainer_uid' => 28787,
                )),
            1 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 682852,
                    'race_datetime' => 'Sep 13 2017  5:20PM',
                    'course_uid' => 15,
                    'course_style_name' => 'Doncaster',
                    'verdict' => 'Foxtrot Knight is running from a 5lb lower mark than for his last win. He\'s been in fair form of late and could go well in the 5.20 at Doncaster - an open looking handicap.',
                    'horse_uid' => 855882,
                    'horse_name' => 'Foxtrot Knight',
                    'start_number' => 12,
                    'non_runner' => 'N',
                    'jockey_uid' => 84541,
                    'jockey_name' => 'James Sullivan',
                    'owner_uid' => 252188,
                    'owner_name' => 'Grange Park Racing Xiii & Ruth Carr',
                    'trainer_name' => 'Ruth Carr',
                    'trainer_uid' => 20045,
                )),
            2 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                    'race_instance_uid' => 682845,
                    'race_datetime' => 'Sep 13 2017  5:10PM',
                    'course_uid' => 8,
                    'course_style_name' => 'Carlisle',
                    'verdict' => 'It\'s interesting that Graham Lee is booked to ride Little Jo in Carlisle\'s 5.10 from a weight of 8-6. The lowest he\'s got down to recently is 8-9, so a big run could be expected.',
                    'horse_uid' => 1561535,
                    'horse_name' => 'Little Jo',
                    'start_number' => 10,
                    'non_runner' => 'N',
                    'jockey_uid' => 10590,
                    'jockey_name' => 'Graham Lee',
                    'owner_uid' => 252638,
                    'owner_name' => 'Ian & Tom Pallas & The Mackem 2',
                    'trainer_name' => 'Chris Grant',
                    'trainer_uid' => 10688,
                )),
        );
    }

    /**
     * @return array
     */
    public function getJockeys()
    {
        $data = [
            'daily_21_645366' => [
                311 => Row::createFromArray(
                    [
                        "jockey_uid" => 311,
                        "jockey_name" => "Nicky Henderson",
                        "wins_14" => 4,
                        "runs" => 16,
                        "percentage" => 25,
                        "entries" => [
                            Row::createFromArray(
                                [
                                    'race_instance_uid' => 654782,
                                    'race_instance_title' => 'Nonsuch Park Handicap',
                                    "race_datetime" => "2016-02-11T16:50:00+00:00",
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157167,
                                    "horse_uid" => 853688,
                                    "horse_name" => "Bright Eyes",
                                    "course_style_name" => "Huntingdon",
                                    "diffusion_course_name" => "Huntingdon",
                                    "course_uid" => 26,
                                    "course_country_code" => "GB",
                                    'owner_uid' => 8968,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null
                                ]
                            )
                        ]
                    ]
                ),
                10157 => Row::createFromArray(
                    [
                        "jockey_uid" => 10157,
                        "jockey_name" => "David Pipe",
                        "wins_14" => 5,
                        "runs" => 16,
                        "percentage" => 31,
                        "entries" => [
                            0 => Row::createFromArray(
                                [
                                    'race_instance_uid' => 654782,
                                    'race_instance_title' => 'Nonsuch Park Handicap',
                                    "race_datetime" => "2016-02-11T16:50:00+00:00",
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157167,
                                    "horse_name" => "Bella",
                                    "horse_uid" => 876329,
                                    "course_style_name" => "Plumpton",
                                    "diffusion_course_name" => "Plumpton",
                                    "course_uid" => 44,
                                    "course_country_code" => "GB",
                                    'owner_uid' => 8968,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null
                                ]
                            ),
                        ]
                    ]
                )
            ],
            'daily_671692' => array(
                77030 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                86032 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'jockey_uid' => 86032,
                            'jockey_name' => 'Aidan Coleman',
                            'wins_14' => 11,
                            'runs_14' => 38,
                            'percentage' => 29,
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
                                            )
                                        ),
                                ),
                            'bet_prompt_rating' => 9,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 9,
                        )
                    ),
                89791 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'jockey_uid' => 89791,
                            'jockey_name' => 'Jeremiah McGrath',
                            'wins_14' => 5,
                            'runs_14' => 13,
                            'percentage' => 38,
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
                                            )
                                        ),
                                ),
                            'bet_prompt_rating' => 8,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 8,
                        )
                    ),
            ),
            'daily_684597' => array(
                92122 =>
                    Row::createFromArray(array(
                        'jockey_uid' => 92122,
                        'jockey_name' => 'Donal McInerney',
                        'wins_14' => 5,
                        'runs_14' => 20,
                        'percentage' => 25,
                        'entries' =>
                            array(
                                0 =>
                                    RowSignposts::createFromArray(array(
                                        'race_datetime' => 'Sep 21 2017  5:25PM',
                                        'race_instance_uid' => 684597,
                                        'race_instance_title' => 'Adare Manor Opportunity Handicap Chase',
                                        'declared_runners' => 7,
                                        'race_group_desc' => 'Handicap',
                                        'perform_race_uid_atr' => 239985,
                                        'perform_race_uid_ruk' => null,
                                        'horse_name' => 'Off The Charts',
                                        'horse_uid' => 832051,
                                        'horse_country_origin_code' => 'IRE',
                                        'course_name' => 'Ballinrobe',
                                        'course_uid' => 175,
                                        'country_code' => 'IRE',
                                        'owner_uid' => 20887,
                                        'rp_owner_choice' => 'u',
                                        'saddle_cloth_no' => 3,
                                        'non_runner' => null,
                                    )),
                            ),
                        'bet_prompt_rating' => 5,
                        'bet_prompt_weighting' => 100,
                        'bet_prompt_score' => 5,
                    )),
            ),
            'daily_683563' => array()
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return array
     */
    public function getHorses()
    {
        $data = [
            'daily_21_645366' => [
                825685 => Row::createFromArray(
                    [
                        'horse_uid' => 825685,
                        'country_code' => 'IRE',
                        'horse_name' => 'Have A Nice Day',
                        'course_name' => 'Curragh',
                        'race_datetime' => 'Oct 11 2015  2:25PM',
                        'course_and_distance' => 0,
                        'course_winner' => 3,
                        'course_runner' => 8,
                        'cd_win_percentage' => 0,
                        'win_percentage' => 38,
                        'entries' => Row::createFromArray(
                            [
                                'race_instance_uid' => 654782,
                                'race_instance_title' => 'Nonsuch Park Handicap',
                                'declared_runners' => 14,
                                'race_group_desc' => 'Handicap',
                                'race_datetime' => 'Jul 28 2016  8:05PM',
                                'perform_race_uid_atr' => null,
                                'perform_race_uid_ruk' => 1157167,
                                'horse_name' => 'Shabbah',
                                'horse_uid' => 825685,
                                'course_uid' => 1138,
                                'country_code' => 'IRE',
                                'course_name' => 'Dundalk (A.W)',
                                'owner_uid' => 8968,
                                'rp_owner_choice' => 'a',
                                'non_runner' => null
                            ]
                        ),
                    ]
                ),
            ],
            'daily_671692' => null
        ];

        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return array
     */
    public function getTrainersJockeys()
    {
        $data = [
            'daily_21_645366' => [
                16270 => Row::createFromArray(
                    [
                        "trainer_uid" => 16270,
                        "trainer_name" => "Dan Skelton",
                        "jockey_uid" => 16270,
                        "jockey_name" => "Deen Skelton",
                        "t_percent" => 4,
                        "j_percent" => 12,
                        "percentage" => 33,
                        "entries" => [
                            Row::createFromArray(
                                [
                                    'race_instance_uid' => 654782,
                                    'race_instance_title' => 'Nonsuch Park Handicap',
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    'race_datetime' => 'Jul 28 2016  8:05PM',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157167,
                                    "horse_uid" => 853688,
                                    "horse_name" => "Bright Eyes",
                                    "course_style_name" => "Huntingdon",
                                    "diffusion_course_name" => "Huntingdon",
                                    "course_uid" => 26,
                                    "course_country_code" => "GB",
                                    'owner_uid' => 8968,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null
                                ]
                            )
                        ]
                    ]
                ),
                10157 => Row::createFromArray(
                    [
                        "trainer_uid" => 10157,
                        "trainer_name" => "Dan Skelton",
                        "jockey_uid" => 311,
                        "jockey_name" => "Deen Skelton",
                        "t_percent" => 4,
                        "j_percent" => 12,
                        "percentage" => 33,
                        "entries" => [
                            0 => Row::createFromArray(
                                [
                                    'race_instance_uid' => 654782,
                                    'race_instance_title' => 'Nonsuch Park Handicap',
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    'race_datetime' => 'Jul 28 2016  8:05PM',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157167,
                                    "horse_name" => "Bella",
                                    "horse_uid" => 876329,
                                    "course_style_name" => "Plumpton",
                                    "diffusion_course_name" => "Plumpton",
                                    "course_uid" => 44,
                                    "course_country_code" => "GB",
                                    'owner_uid' => 8968,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null
                                ]
                            ),
                        ]
                    ]
                )
            ],
            'daily_671692' => null,
            'daily_684597' => null,
            'daily_683563' => null
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return array
     */
    public function getCourseJockeys()
    {
        $data = [
            'daily_21_645366' => [
                5 => Row::createFromArray(
                    [
                        'course_uid' => 5,
                        'course_name' => 'Bath',
                        'country_code' => 'GB ',
                        'jockeys' => [
                            619 => RowSignposts::createFromArray(
                                [
                                    'jockey_uid' => 619,
                                    'jockey_name' => 'Sir Michael Stoute',
                                    'd7_wins' => 8,
                                    'd7_runs' => 36,
                                    'd7_perc' => 22,
                                    'entries' => [
                                        0 => RowHorse::createFromArray(
                                            [
                                                'horse_uid' => 875005,
                                                'horse_name' => 'Mawaany',
                                                'horse_country_origin_code' => 'GB',
                                                'owner_uid' => 1859,
                                                'rp_owner_choice' => 'a',
                                                'race_instance_uid' => 654782,
                                                'race_instance_title' => 'Nonsuch Park Handicap',
                                                'declared_runners' => 14,
                                                'race_group_desc' => 'Handicap',
                                                'race_datetime' => 'Jul 28 2016  8:05PM',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1157167,
                                                'non_runner' => null
                                            ]
                                        ),
                                        1 => RowHorse::createFromArray(
                                            [
                                                'horse_uid' => 875032,
                                                'horse_name' => 'Shabbah',
                                                'horse_country_origin_code' => 'GB',
                                                'owner_uid' => 135158,
                                                'rp_owner_choice' => 'a',
                                                'race_instance_uid' => 654782,
                                                'race_instance_title' => 'Nonsuch Park Handicap',
                                                'declared_runners' => 14,
                                                'race_group_desc' => 'Handicap',
                                                'race_datetime' => 'Jul 28 2016  8:05PM',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1157167,
                                                'non_runner' => null
                                            ]
                                        ),
                                    ],
                                ]
                            ),
                            4635 => RowSignposts::createFromArray(
                                [
                                    'jockey_uid' => 4635,
                                    'jockey_name' => 'Roger Charlton',
                                    'd7_wins' => 3,
                                    'd7_runs' => 5,
                                    'd7_perc' => 60,
                                    'entries' => [
                                        0 => RowHorse::createFromArray(
                                            [
                                                'horse_uid' => 898833,
                                                'horse_name' => 'De Aguilar',
                                                'horse_country_origin_code' => 'GB',
                                                'owner_uid' => 232602,
                                                'rp_owner_choice' => 'a',
                                                'race_instance_uid' => 654782,
                                                'race_instance_title' => 'Nonsuch Park Handicap',
                                                'declared_runners' => 14,
                                                'race_group_desc' => 'Handicap',
                                                'race_datetime' => 'Jul 28 2016  8:05PM',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1157167,
                                                'non_runner' => null
                                            ]
                                        ),
                                    ],
                                ]
                            ),
                        ],
                    ]
                ),
            ],
            'daily_671692' => array(
                3 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'course_uid' => 3,
                            'course_name' => 'Ayr',
                            'country_code' => 'GB ',
                            'jockeys' =>
                                array(
                                    93186 =>
                                        \Api\Row\Signposts::createFromArray(
                                            array(
                                                'jockey_uid' => 93186,
                                                'jockey_name' => 'Sean Bowen',
                                                'd7_wins' => 3,
                                                'd7_runs' => 12,
                                                'd7_perc' => 25,
                                                'entries' =>
                                                    array(
                                                        0 =>
                                                            \Api\Row\Horse::createFromArray(
                                                                array(
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
                                                                )
                                                            ),
                                                    ),
                                                'bet_prompt_rating' => 5,
                                                'bet_prompt_weighting' => 100,
                                                'bet_prompt_score' => 5,
                                            )
                                        ),
                                ),
                        )
                    ),
            ),
            'daily_684597' => array(
                175 =>
                    Row::createFromArray(array(
                        'course_uid' => 175,
                        'course_name' => 'Ballinrobe',
                        'country_code' => 'IRE',
                        'jockeys' =>
                            array(
                                88288 =>
                                    RowSignposts::createFromArray(array(
                                        'jockey_uid' => 88288,
                                        'jockey_name' => 'J J Slevin',
                                        'd7_wins' => 4,
                                        'd7_runs' => 20,
                                        'd7_perc' => 20,
                                        'entries' =>
                                            array(
                                                0 =>
                                                    RowHorse::createFromArray(array(
                                                        'race_datetime' => 'Sep 21 2017  5:25PM',
                                                        'race_instance_uid' => 684597,
                                                        'race_instance_title' => 'Adare Manor Opportunity Handicap Chase',
                                                        'declared_runners' => 7,
                                                        'race_group_desc' => 'Handicap',
                                                        'perform_race_uid_atr' => 239985,
                                                        'perform_race_uid_ruk' => null,
                                                        'horse_name' => 'Aranhill Rascal',
                                                        'horse_uid' => 849567,
                                                        'horse_country_origin_code' => 'IRE',
                                                        'course_name' => 'Ballinrobe',
                                                        'course_uid' => 175,
                                                        'country_code' => 'IRE',
                                                        'owner_uid' => 22114,
                                                        'rp_owner_choice' => 'a',
                                                        'saddle_cloth_no' => 2,
                                                        'non_runner' => null,
                                                    )),
                                            ),
                                        'bet_prompt_rating' => 5,
                                        'bet_prompt_weighting' => 100,
                                        'bet_prompt_score' => 5,
                                    )),
                            ),
                    )),
            ),
            'daily_683563' => array()
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return array
     */
    public function getCourseTrainers()
    {
        $data = [
            'daily_21_645366' => [
                5 => Row::createFromArray(
                    [
                        'course_uid' => 5,
                        'course_name' => 'Bath',
                        'country_code' => 'GB ',
                        'trainers' => [
                            619 => RowSignposts::createFromArray(
                                [
                                    'trainer_uid' => 619,
                                    'trainer_name' => 'Sir Michael Stoute',
                                    'd7_wins' => 8,
                                    'd7_runs' => 36,
                                    'd7_perc' => 22,
                                    'entries' => [
                                        0 => RowHorse::createFromArray(
                                            [
                                                'horse_uid' => 875005,
                                                'horse_name' => 'Mawaany',
                                                'horse_country_origin_code' => 'GB',
                                                'owner_uid' => 1859,
                                                'rp_owner_choice' => 'a',
                                                'race_instance_uid' => 654782,
                                                'race_instance_title' => 'Nonsuch Park Handicap',
                                                'declared_runners' => 14,
                                                'race_group_desc' => 'Handicap',
                                                'race_datetime' => 'Jul 28 2016  8:05PM',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1157167,
                                                'non_runner' => null
                                            ]
                                        ),
                                        1 => RowHorse::createFromArray(
                                            [
                                                'horse_uid' => 875032,
                                                'horse_name' => 'Shabbah',
                                                'horse_country_origin_code' => 'GB',
                                                'owner_uid' => 135158,
                                                'rp_owner_choice' => 'a',
                                                'race_instance_uid' => 654782,
                                                'race_instance_title' => 'Nonsuch Park Handicap',
                                                'declared_runners' => 14,
                                                'race_group_desc' => 'Handicap',
                                                'race_datetime' => 'Jul 28 2016  8:05PM',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1157167,
                                                'non_runner' => null
                                            ]
                                        ),
                                    ],
                                ]
                            ),
                            4635 => RowSignposts::createFromArray(
                                [
                                    'trainer_uid' => 4635,
                                    'trainer_name' => 'Roger Charlton',
                                    'd7_wins' => 3,
                                    'd7_runs' => 5,
                                    'd7_perc' => 60,
                                    'entries' => [
                                        0 => RowHorse::createFromArray(
                                            [
                                                'horse_uid' => 898833,
                                                'horse_name' => 'De Aguilar',
                                                'horse_country_origin_code' => 'GB',
                                                'owner_uid' => 232602,
                                                'rp_owner_choice' => 'a',
                                                'race_instance_uid' => 654782,
                                                'race_instance_title' => 'Nonsuch Park Handicap',
                                                'declared_runners' => 14,
                                                'race_group_desc' => 'Handicap',
                                                'race_datetime' => 'Jul 28 2016  8:05PM',
                                                'perform_race_uid_atr' => null,
                                                'perform_race_uid_ruk' => 1157167,
                                                'non_runner' => null
                                            ]
                                        ),
                                    ],
                                ]
                            ),
                        ],
                    ]
                ),
            ],
            'daily_671692' => array(
                3 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'course_uid' => 3,
                            'course_name' => 'Ayr',
                            'country_code' => 'GB ',
                            'trainers' =>
                                array(
                                    5767 =>
                                        \Api\Row\Signposts::createFromArray(
                                            array(
                                                'trainer_uid' => 5767,
                                                'trainer_name' => 'Paul Nicholls',
                                                'd7_wins' => 8,
                                                'd7_runs' => 28,
                                                'd7_perc' => 29,
                                                'entries' =>
                                                    array(
                                                        0 =>
                                                            \Api\Row\Horse::createFromArray(
                                                                array(
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
                                                                )
                                                            ),
                                                    ),
                                                'bet_prompt_rating' => 7,
                                                'bet_prompt_weighting' => 100,
                                                'bet_prompt_score' => 7.0000000000000009,
                                            )
                                        ),
                                    16270 =>
                                        \Api\Row\Signposts::createFromArray(
                                            array(
                                                'trainer_uid' => 16270,
                                                'trainer_name' => 'Dan Skelton',
                                                'd7_wins' => 7,
                                                'd7_runs' => 24,
                                                'd7_perc' => 29,
                                                'entries' =>
                                                    array(
                                                        0 =>
                                                            \Api\Row\Horse::createFromArray(
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
                                                'bet_prompt_rating' => 7,
                                                'bet_prompt_weighting' => 100,
                                                'bet_prompt_score' => 7.0000000000000009,
                                            )
                                        ),
                                ),
                        )
                    ),
            ),
            'daily_684597' => array(
                175 =>
                    Row::createFromArray(array(
                        'course_uid' => 175,
                        'course_name' => 'Ballinrobe',
                        'country_code' => 'IRE',
                        'trainers' =>
                            array(
                                5354 =>
                                    RowSignposts::createFromArray(array(
                                        'trainer_uid' => 5354,
                                        'trainer_name' => 'Seamus Fahey',
                                        'd7_wins' => 3,
                                        'd7_runs' => 11,
                                        'd7_perc' => 27,
                                        'entries' =>
                                            array(
                                                0 =>
                                                    RowHorse::createFromArray(array(
                                                        'race_datetime' => 'Sep 21 2017  5:25PM',
                                                        'race_instance_uid' => 684597,
                                                        'race_instance_title' => 'Adare Manor Opportunity Handicap Chase',
                                                        'declared_runners' => 7,
                                                        'race_group_desc' => 'Handicap',
                                                        'perform_race_uid_atr' => 239985,
                                                        'perform_race_uid_ruk' => null,
                                                        'horse_name' => 'Caniwillyegiveme',
                                                        'horse_uid' => 904842,
                                                        'horse_country_origin_code' => 'IRE',
                                                        'course_name' => 'Ballinrobe',
                                                        'course_uid' => 175,
                                                        'country_code' => 'IRE',
                                                        'owner_uid' => 235704,
                                                        'rp_owner_choice' => 'a',
                                                        'saddle_cloth_no' => 1,
                                                        'non_runner' => null,
                                                    )),
                                            ),
                                        'bet_prompt_rating' => 5,
                                        'bet_prompt_weighting' => 100,
                                        'bet_prompt_score' => 5,
                                    )),
                            ),
                    )),
            ),
            'daily_683563' => array()
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return RowSignposts|null
     */
    public function getSevenDaysWinners()
    {
        $data = [
            'daily_21_645366' => [
                RowSignposts::createFromArray(
                    [
                        'country_code' => 'GB ',
                        'horse_name' => 'Lavetta',
                        'course_name' => 'Nottingham',
                        'race_instance_uid' => 654782,
                        'race_instance_title' => 'Nonsuch Park Handicap',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'race_datetime' => 'Jul 28 2016  8:05PM',
                        'perform_race_uid_atr' => null,
                        'perform_race_uid_ruk' => 1157167,
                        'course_won' => 'Catterick',
                        'date_won' => 'Wednesday',
                        'trainer_name' => 'Alan Swinbank',
                        'd7_wins' => 11,
                        'd7_runs' => 46,
                        'd7_perc' => 24,
                        'd8_perc' => 14,
                        'course_uid' => 40,
                        'trainer_uid' => 12188,
                        'course_won_uid' => 10,
                        'horse_uid' => 893338,
                        'owner_uid' => 213757,
                        'rp_owner_choice' => 'a',
                        'non_runner' => null
                    ]
                ),
                RowSignposts::createFromArray(
                    [
                        'country_code' => 'GB ',
                        'horse_name' => 'Argent Knight',
                        'course_name' => 'Wolverhampton (A.W)',
                        'race_instance_uid' => 654782,
                        'race_instance_title' => 'Nonsuch Park Handicap',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'race_datetime' => 'Jul 28 2016  8:05PM',
                        'perform_race_uid_atr' => null,
                        'perform_race_uid_ruk' => 1157167,
                        'course_won' => 'Wolverhampton (A.W)',
                        'date_won' => 'Tuesday',
                        'trainer_name' => 'Keith Dalgleish',
                        'd7_wins' => 43,
                        'd7_runs' => 235,
                        'd7_perc' => 18,
                        'd8_perc' => 13,
                        'course_uid' => 513,
                        'trainer_uid' => 24548,
                        'course_won_uid' => 513,
                        'horse_uid' => 800109,
                        'owner_uid' => 180280,
                        'rp_owner_choice' => 'a',
                        'non_runner' => null
                    ]
                )
            ],
            'daily_671692' => null
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return Row|null
     */
    public function getAheadOfHandicapper()
    {
        $data = [
            'daily_21_645366' => [
                895482 => Row::createFromArray(
                    [
                        'horse_style_name' => 'The Invisible Dog',
                        'horse_uid' => 895482,
                        'entries' => [
                            0 => RowSignposts::createFromArray(
                                [
                                    'race_instance_uid' => 654782,
                                    'race_instance_title' => 'Nonsuch Park Handicap',
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    'race_datetime' => 'Jul 28 2016  8:05PM',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157167,
                                    'course_style_name' => 'Epsom',
                                    'course_uid' => 17,
                                    'course_name' => 'EPSOM',
                                    'country_code' => 'GB',
                                    'losses_out' => '+3',
                                    'owner_uid' => 224645,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null,
                                ]
                            ),
                        ],
                        'horse_country_origin_code' => 'GB',
                    ]
                ),
                1009310 => Row::createFromArray(
                    [
                        'horse_style_name' => 'Montataire',
                        'horse_uid' => 1009310,
                        'entries' => [
                            0 => RowSignposts::createFromArray(
                                [
                                    'race_instance_uid' => 654795,
                                    'race_instance_title' => 'Telegraph Nursery Stakes (Handicap)',
                                    'declared_runners' => 14,
                                    'race_group_desc' => 'Handicap',
                                    'race_datetime' => 'Jul 28 2016  4:55PM',
                                    'perform_race_uid_atr' => null,
                                    'perform_race_uid_ruk' => 1157151,
                                    'course_style_name' => 'Goodwood',
                                    'course_uid' => 21,
                                    'course_name' => 'GOODWOOD',
                                    'country_code' => 'GB',
                                    'losses_out' => '+3',
                                    'owner_uid' => 59472,
                                    'rp_owner_choice' => 'a',
                                    'non_runner' => null,
                                ]
                            ),
                        ],
                        'horse_country_origin_code' => 'GB',
                    ]
                ),
            ],
            'daily_671692' => null
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return RowSignposts|null
     */
    public function getTravellersCheck()
    {
        $data = [
            'daily_21_645366' => [
                RowSignposts::createFromArray(
                    [
                        'race_instance_uid' => 654782,
                        'race_instance_title' => 'Nonsuch Park Handicap',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'race_datetime' => 'Jul 28 2016  8:05PM',
                        'perform_race_uid_atr' => null,
                        'perform_race_uid_ruk' => 1157167,
                        'country_code' => 'GB',
                        'course_name' => 'Ascot',
                        'horse_name' => 'Create A Dream',
                        'dist_out' => 'USA',
                        'trav_out' => 'all GB',
                        'all_out' => '; all 11%',
                        'trainer_name' => 'Wesley A Ward',
                        'trav_wins' => 14,
                        'trav_runs' => 72,
                        'trav_perc' => 19,
                        'course_uid' => 2,
                        'horse_uid' => 983091,
                        'trainer_uid' => 9026,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 238148,
                        'non_runner' => null
                    ]
                ),
                RowSignposts::createFromArray(
                    [
                        'race_instance_uid' => 654782,
                        'race_instance_title' => 'Nonsuch Park Handicap',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'race_datetime' => 'Jul 28 2016  8:05PM',
                        'perform_race_uid_atr' => null,
                        'perform_race_uid_ruk' => 1157167,
                        'country_code' => 'GB',
                        'course_name' => 'Ascot',
                        'horse_name' => 'The Last Lion',
                        'dist_out' => '243',
                        'trav_out' => null,
                        'all_out' => '; all 12%',
                        'trainer_name' => 'Mark Johnston',
                        'trav_wins' => 950,
                        'trav_runs' => 6866,
                        'trav_perc' => 20,
                        'course_uid' => 2,
                        'horse_uid' => 964610,
                        'trainer_uid' => 3378,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 80485,
                        'non_runner' => null
                    ]
                ),
                RowSignposts::createFromArray(
                    [
                        'race_instance_uid' => 654782,
                        'race_instance_title' => 'Nonsuch Park Handicap',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'race_datetime' => 'Jul 28 2016  8:05PM',
                        'perform_race_uid_atr' => null,
                        'perform_race_uid_ruk' => 1157167,
                        'country_code' => 'GB',
                        'course_name' => 'Ascot',
                        'horse_name' => 'The Last Lion',
                        'dist_out' => '243',
                        'trav_out' => null,
                        'all_out' => '; all 12%',
                        'trainer_name' => 'Mark Johnston',
                        'trav_wins' => 950,
                        'trav_runs' => 6866,
                        'trav_perc' => 24,
                        'course_uid' => 2,
                        'horse_uid' => 964610,
                        'trainer_uid' => 3378,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 80485,
                        'non_runner' => null
                    ]
                ),
                RowSignposts::createFromArray(
                    [
                        'race_instance_uid' => 654782,
                        'race_instance_title' => 'Nonsuch Park Handicap',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'race_datetime' => 'Jul 28 2016  8:05PM',
                        'perform_race_uid_atr' => null,
                        'perform_race_uid_ruk' => 1157167,
                        'country_code' => 'GB',
                        'course_name' => 'Ascot',
                        'horse_name' => 'The Last Lion',
                        'dist_out' => '243',
                        'trav_out' => null,
                        'all_out' => '; all 12%',
                        'trainer_name' => 'Mark Johnston',
                        'trav_wins' => 950,
                        'trav_runs' => 6866,
                        'trav_perc' => 34,
                        'course_uid' => 2,
                        'horse_uid' => 964610,
                        'trainer_uid' => 3378,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 80485,
                        'non_runner' => null
                    ]
                )
            ],
            'daily_671692' => array(
                845090 =>
                    \Api\Row\Signposts::createFromArray(
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
                            'bet_prompt_rating' => null,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 1,
                        )
                    ),
                832408 =>
                    \Api\Row\Signposts::createFromArray(
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
                            'bet_prompt_rating' => null,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 8,
                        )
                    ),
                873424 =>
                    \Api\Row\Signposts::createFromArray(
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
                            'bet_prompt_rating' => 6,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 9,
                        )
                    ),
                833171 =>
                    \Api\Row\Signposts::createFromArray(
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
                            'bet_prompt_rating' => null,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 1,
                        )
                    ),
                848199 =>
                    \Api\Row\Signposts::createFromArray(
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
                            'bet_prompt_rating' => 4,
                            'bet_prompt_weighting' => 100,
                            'bet_prompt_score' => 10,
                        )
                    ),
                874547 =>
                    \Api\Row\Signposts::createFromArray(
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
            )
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return RowSignposts|null
     */
    public function getFirstTimeBlinkers()
    {
        $data = [
            'daily_21_645366' => [
                879931 => RowSignposts::createFromArray(
                    [
                        'horse_uid' => 879931,
                        'horse_name' => 'GUNNER MOYNE',
                        'race_datetime' => 'Aug 23 2016  8:40PM',
                        'race_instance_uid' => 656351,
                        'race_instance_title' => 'totepool Live Info Download Our App Handicap',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'perform_race_uid_atr' => 139710,
                        'perform_race_uid_ruk' => null,
                        'course_uid' => 1083,
                        'course_name' => 'CHELMSFORD (A.W)',
                        'course_style_name' => 'Chelmsford (A.W)',
                        'country_code' => 'GB ',
                        'rp_postmark' => null,
                        'rp_owner_choice' => null,
                        'owner_uid' => null,
                        'first_time_blinkers' => 'N',
                        'first_time_visor' => 'Y',
                        'first_time_hood' => 'N',
                        'first_tongue_tie' => 'N',
                        'non_runner' => null,
                    ]
                ),
                1104818 => RowSignposts::createFromArray(
                    [
                        'horse_uid' => 1104818,
                        'horse_name' => 'WHISPERED KISS',
                        'race_datetime' => 'Aug 23 2016  6:40PM',
                        'race_instance_uid' => 656347,
                        'race_instance_title' => 'toteexacta Maiden Fillies\' Stakes',
                        'declared_runners' => 14,
                        'race_group_desc' => 'Handicap',
                        'perform_race_uid_atr' => 139702,
                        'perform_race_uid_ruk' => null,
                        'course_uid' => 1083,
                        'course_name' => 'CHELMSFORD (A.W)',
                        'course_style_name' => 'Chelmsford (A.W)',
                        'country_code' => 'GB ',
                        'rp_postmark' => null,
                        'rp_owner_choice' => null,
                        'owner_uid' => null,
                        'first_time_blinkers' => 'N',
                        'first_time_visor' => 'N',
                        'first_time_hood' => 'Y',
                        'first_tongue_tie' => 'N',
                        'non_runner' => null,
                    ]
                ),
            ],
            'daily_671692' => null
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }

    /**
     * @return Row|null
     */
    public function getTopRpr()
    {
        $data = [
            '5_daily_21_645366' => [
                797074 => [
                    Row::createFromArray(
                        [
                            "horse_name" => "Tornado In Milan",
                            "horse_uid" => 797074,
                            'race_instance_uid' => 654782,
                            'race_instance_title' => 'Nonsuch Park Handicap',
                            'declared_runners' => 14,
                            'race_group_desc' => 'Handicap',
                            'race_datetime' => 'Jul 28 2016  8:05PM',
                            'perform_race_uid_atr' => null,
                            'perform_race_uid_ruk' => 1157167,
                            "course_style_name" => "Taunton",
                            "course_uid" => 73,
                            "diffusion_course_name" => "Taunton",
                            "course_country_code" => "GB",
                            "rp_postmark" => 143,
                            'owner_uid' => 8968,
                            'rp_owner_choice' => 'a',
                            'non_runner' => null
                        ]
                    )
                ],
                833721 => [
                    Row::createFromArray(
                        [
                            "horse_name" => "Lochnagar",
                            "horse_uid" => 833721,
                            'race_instance_uid' => 654782,
                            'race_instance_title' => 'Nonsuch Park Handicap',
                            'declared_runners' => 14,
                            'race_group_desc' => 'Handicap',
                            'race_datetime' => 'Jul 28 2016  8:05PM',
                            'perform_race_uid_atr' => null,
                            'perform_race_uid_ruk' => 1157167,
                            "course_style_name" => "Taunton",
                            "course_uid" => 73,
                            "diffusion_course_name" => "Taunton",
                            "course_country_code" => "GB",
                            "rp_postmark" => 140,
                            'owner_uid' => 8968,
                            'rp_owner_choice' => 'a',
                            'non_runner' => null
                        ]
                    )
                ],
                854337 => [
                    Row::createFromArray(
                        [
                            "horse_name" => "Royal Vacation",
                            "horse_uid" => 854337,
                            'race_instance_uid' => 654782,
                            'race_instance_title' => 'Nonsuch Park Handicap',
                            'declared_runners' => 14,
                            'race_group_desc' => 'Handicap',
                            'race_datetime' => 'Jul 28 2016  8:05PM',
                            'perform_race_uid_atr' => null,
                            'perform_race_uid_ruk' => 1157167,
                            "course_style_name" => "Taunton",
                            "course_uid" => 73,
                            "diffusion_course_name" => "Taunton",
                            "course_country_code" => "GB",
                            "rp_postmark" => 143,
                            'owner_uid' => 8968,
                            'rp_owner_choice' => 'a',
                            'non_runner' => null
                        ]
                    )
                ],
                858091 => [
                    Row::createFromArray(
                        [
                            "horse_name" => "Qualando",
                            "horse_uid" => 858091,
                            'race_instance_uid' => 654782,
                            'race_instance_title' => 'Nonsuch Park Handicap',
                            'declared_runners' => 14,
                            'race_group_desc' => 'Handicap',
                            'race_datetime' => 'Jul 28 2016  8:05PM',
                            'perform_race_uid_atr' => null,
                            'perform_race_uid_ruk' => 1157167,
                            "course_style_name" => "Taunton",
                            "course_uid" => 73,
                            "diffusion_course_name" => "Taunton",
                            "course_country_code" => "GB",
                            "rp_postmark" => 142,
                            'owner_uid' => 8968,
                            'rp_owner_choice' => 'a',
                            'non_runner' => null
                        ]
                    )
                ],
                886063 => [
                    Row::createFromArray(
                        [
                            "horse_name" => "Born Survivor",
                            "horse_uid" => 886063,
                            'race_instance_uid' => 654782,
                            'race_instance_title' => 'Nonsuch Park Handicap',
                            'declared_runners' => 14,
                            'race_group_desc' => 'Handicap',
                            'race_datetime' => 'Jul 28 2016  8:05PM',
                            'perform_race_uid_atr' => null,
                            'perform_race_uid_ruk' => 1157167,
                            "course_style_name" => "Wetherby",
                            "course_uid" => 87,
                            "diffusion_course_name" => "Wetherby",
                            "course_country_code" => "GB",
                            "rp_postmark" => 145,
                            'owner_uid' => 8968,
                            'rp_owner_choice' => 'a',
                            'non_runner' => null
                        ]
                    )
                ]
            ],
            'daily_671692' => null
        ];
        return $data[$this::getRequestKey($this->getRequest())];
    }
}
