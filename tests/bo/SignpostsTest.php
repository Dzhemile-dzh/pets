<?php

namespace Tests\Bo;

use Phalcon\Exception;
use \Api\Input\Request\Horses\Signposts as Request;

class SignpostsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestSweetspots
     */
    public function testGetSweetspots(
        Request\Sweetspots $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals($expectedResult, $signpostsObject->getSweetspots());
    }

    /**
     * @return array
     */
    public function providerTestSweetspots()
    {
        $data = [
            [
                new Request\Sweetspots(
                    [
                        '2017-07-04'
                    ],
                    []
                ),
                array(
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
                )
            ]
        ];
        return $data;
    }

    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestGetHotTrainers
     */
    public function testGetHotTrainers(
        Request\HotTrainers $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals($expectedResult, $signpostsObject->getHotTrainers());
    }

    /**
     * @return array
     */
    public function providerTestGetHotTrainers()
    {
        $data = [
            [
                new Request\HotTrainers(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    16270 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "trainer_uid" => 16270,
                            "trainer_name" => "Dan Skelton",
                            "wins_14" => 4,
                            "runs" => 12,
                            "percentage" => 33,
                            "entries" => [
                                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                    10157 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "trainer_uid" => 10157,
                            "trainer_name" => "David Pipe",
                            "wins_14" => 5,
                            "runs" => 16,
                            "percentage" => 31,
                            "entries" => [
                                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                ]
            ]
        ];
        return $data;
    }

    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestGetHotJockeys
     */
    public function testGetHotJockeys(
        Request\HotJockeys $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals(
            $signpostsObject->getHotJockeys(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function providerTestGetHotJockeys()
    {
        $data = [
            [
                new Request\HotJockeys(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    311 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "jockey_uid" => 311,
                            "jockey_name" => "Nicky Henderson",
                            "wins_14" => 4,
                            "runs" => 16,
                            "percentage" => 25,
                            "entries" => [
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
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

                    10157 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "jockey_uid" => 10157,
                            "jockey_name" => "David Pipe",
                            "wins_14" => 5,
                            "runs" => 16,
                            "percentage" => 31,
                            "entries" => [
                                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                ]
            ]
        ];
        return $data;
    }

    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestGetCourseJockeys
     */
    public function testGetCourseJockeys(
        Request\CourseJockeys $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals(
            $signpostsObject->getCourseJockeys(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function providerTestGetCourseJockeys()
    {
        $data = [
            [
                new Request\CourseJockeys(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'course_uid' => 5,
                            'course_name' => 'Bath',
                            'country_code' => 'GB ',
                            'jockeys' => [
                                619 => \Api\Row\Signposts::createFromArray(
                                    [
                                        'jockey_uid' => 619,
                                        'jockey_name' => 'Sir Michael Stoute',
                                        'd7_wins' => 8,
                                        'd7_runs' => 36,
                                        'd7_perc' => 22,
                                        'entries' => [
                                            0 => \Api\Row\Horse::createFromArray(
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
                                            1 => \Api\Row\Horse::createFromArray(
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
                                4635 => \Api\Row\Signposts::createFromArray(
                                    [
                                        'jockey_uid' => 4635,
                                        'jockey_name' => 'Roger Charlton',
                                        'd7_wins' => 3,
                                        'd7_runs' => 5,
                                        'd7_perc' => 60,
                                        'entries' => [
                                            0 => \Api\Row\Horse::createFromArray(
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
                ]
            ]
        ];
        return $data;
    }

    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestGetCourseTrainers
     */
    public function testGetCourseTrainers(
        Request\CourseTrainers $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals(
            $signpostsObject->getCourseTrainers(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function providerTestGetCourseTrainers()
    {
        $data = [
            [
                new Request\CourseTrainers(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'course_uid' => 5,
                            'course_name' => 'Bath',
                            'country_code' => 'GB ',
                            'trainers' => [
                                619 => \Api\Row\Signposts::createFromArray(
                                    [
                                        'trainer_uid' => 619,
                                        'trainer_name' => 'Sir Michael Stoute',
                                        'd7_wins' => 8,
                                        'd7_runs' => 36,
                                        'd7_perc' => 22,
                                        'entries' => [
                                            0 => \Api\Row\Horse::createFromArray(
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
                                            1 => \Api\Row\Horse::createFromArray(
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
                                4635 => \Api\Row\Signposts::createFromArray(
                                    [
                                        'trainer_uid' => 4635,
                                        'trainer_name' => 'Roger Charlton',
                                        'd7_wins' => 3,
                                        'd7_runs' => 5,
                                        'd7_perc' => 60,
                                        'entries' => [
                                            0 => \Api\Row\Horse::createFromArray(
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
                ]
            ]
        ];
        return $data;
    }

    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestGetTrainersJockeys
     */
    public function testGetTrainersJockeys(
        Request\TrainersJockeys $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals(
            $signpostsObject->getTrainersJockeys(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function providerTestGetTrainersJockeys()
    {
        $data = [
            [
                new Request\TrainersJockeys(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    16270 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "trainer_uid" => 16270,
                            "trainer_name" => "Dan Skelton",
                            "jockey_uid" => 16270,
                            "jockey_name" => "Deen Skelton",
                            "t_percent" => 4,
                            "j_percent" => 12,
                            "percentage" => 33,
                            "entries" => [
                                \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                    10157 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            "trainer_uid" => 10157,
                            "trainer_name" => "Dan Skelton",
                            "jockey_uid" => 311,
                            "jockey_name" => "Deen Skelton",
                            "t_percent" => 4,
                            "j_percent" => 12,
                            "percentage" => 33,
                            "entries" => [
                                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                ]
            ]
        ];
        return $data;
    }

    /**
     * @param Request\HorsesForCourses $request
     * @param                          $expected
     *
     * @dataProvider providerTestGetHorsesForCourses
     */
    public function testGetHorsesForCourses($request, $expected)
    {
        $actual = (new \Tests\Stubs\Bo\Signposts($request))->getHorsesForCourses();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function providerTestGetHorsesForCourses()
    {
        return [
            [
                new Request\HorsesForCourses(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    825685 => \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                            'entries' => \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                ]
            ]
        ];
    }

    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestGetTopUpcomingRpr
     */
    public function testGetTopUpcomingRpr(
        Request\TopUpcomingRpr $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals(
            $signpostsObject->getTopUpcomingHorses($request->getTopHorses(), []),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function providerTestGetTopUpcomingRpr()
    {
        return [
            [
                new Request\TopUpcomingRpr(
                    [
                        5,
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    797074 => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
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
                ]
            ]
        ];
    }

    /**
     * @param Request\AheadOfHandicapper $request
     * @param array                      $expected
     *
     * @dataProvider providerTestGetAheadOfHandicapper
     */
    public function testGetAheadOfHandicapper($request, $expected)
    {
        $actual = (new \Tests\Stubs\Bo\Signposts($request))->getAheadOfHandicapper();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function providerTestGetAheadOfHandicapper()
    {
        return [
            [
                new Request\AheadOfHandicapper(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    895482 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_style_name' => 'The Invisible Dog',
                            'horse_uid' => 895482,
                            'entries' => [
                                0 => \Api\Row\Signposts::createFromArray(
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
                    1009310 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_style_name' => 'Montataire',
                            'horse_uid' => 1009310,
                            'entries' => [
                                0 => \Api\Row\Signposts::createFromArray(
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
                ]
            ]
        ];
    }

    /**
     * @param $expected
     *
     * @dataProvider providerTestGetSevenDayWinners
     */
    public function testGetSevenDayWinners(Request\SevenDayWinners $request, $expected)
    {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals($signpostsObject->getSevenDayWinners(), $expected);
    }

    /**
     * @return array
     */
    public function providerTestGetSevenDayWinners()
    {
        $data = [
            [
                new Request\SevenDayWinners(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    \Api\Row\Signposts::createFromArray(
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
                    \Api\Row\Signposts::createFromArray(
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
                ]
            ]
        ];
        return $data;
    }

    /**
     * @param $request
     * @param $expectedResult
     *
     * @dataProvider providerTestGetTravellersCheck
     */
    public function testGetTravellersCheck(
        Request\TravellersCheck $request,
        $expectedResult
    ) {
        $signpostsObject = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals($signpostsObject->getTravellersCheck(), $expectedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetTravellersCheck()
    {
        $data = [
            [
                new Request\TravellersCheck(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    \Api\Row\Signposts::createFromArray(
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
                    \Api\Row\Signposts::createFromArray(
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
                    \Api\Row\Signposts::createFromArray(
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
                    \Api\Row\Signposts::createFromArray(
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
                ]
            ]
        ];
        return $data;
    }

    /**
     * @dataProvider providerTestGetFirstTimeBlinkers
     *
     * @param Request\FirstTimeBlinkers $request
     * @param \Api\Row\Signposts[]      $expectedResult
     */
    public function testGetFirstTimeBlinkers(
        Request\FirstTimeBlinkers $request,
        $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals($bo->getFirstTimeBlinkers(), $expectedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetFirstTimeBlinkers()
    {
        return [
            [
                new Request\FirstTimeBlinkers(
                    [
                        'daily'
                    ],
                    [
                        'courseId' => 21,
                        'raceId' => 645366
                    ]
                ),
                [
                    879931 => \Api\Row\Signposts::createFromArray(
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
                    1104818 => \Api\Row\Signposts::createFromArray(
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
                ]
            ]
        ];
    }

    /**
     * @param Request\ListForMobile $request
     * @param array                 $data
     * @param                       $expectedResult
     *
     * @dataProvider                provideTestBuildListForMobile
     */
    public function testBuildListForMobile(Request\ListForMobile $request, array $data, $expectedResult)
    {
        $bo = new \Tests\Stubs\Bo\Signposts($request);
        $this->assertEquals($expectedResult, $bo->buildListForMobile($data));
    }

    /**
     * @return array
     */
    public function provideTestBuildListForMobile()
    {
        return [
            [
                new Request\ListForMobile(),
                [
                    394 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'trainer_uid' => 394,
                            'trainer_name' => 'Malcolm Jefferson',
                            'wins_14' => 6,
                            'runs_14' => 14,
                            'percentage' => 43,
                            'entries' => [
                                0 => \Api\Row\Signposts::createFromArray(
                                    [
                                        'trainer_uid' => 394,
                                        'trainer_name' => 'Malcolm Jefferson',
                                        'race_datetime' => 'Nov  7 2016  1:45PM',
                                        'horse_uid' => 882980,
                                        'horse_name' => 'Gully\'s Edge',
                                        'horse_country_origin_code' => 'GB',
                                        'course_uid' => 8,
                                        'country_code' => 'GB ',
                                        'course_name' => 'Carlisle',
                                        'owner_uid' => 93258,
                                        'rp_owner_choice' => 'a',
                                        'non_runner' => null,
                                        'race_instance_uid' => 661030,
                                        'race_instance_title' => 'ApolloBet Home Of Cashback Offers Novices\' Chase',
                                        'declared_runners' => 14,
                                        'race_group_desc' => 'Handicap',
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => 1195555,
                                    ]
                                ),
                                1 => \Api\Row\Signposts::createFromArray(
                                    [
                                        'trainer_uid' => 394,
                                        'trainer_name' => 'Malcolm Jefferson',
                                        'race_datetime' => 'Nov  7 2016  4:00PM',
                                        'horse_uid' => 1021441,
                                        'horse_name' => 'Frobisher Bay',
                                        'horse_country_origin_code' => 'IRE',
                                        'course_uid' => 8,
                                        'country_code' => 'GB ',
                                        'course_name' => 'Carlisle',
                                        'owner_uid' => 88520,
                                        'rp_owner_choice' => 'a',
                                        'non_runner' => null,
                                        'race_instance_uid' => 661034,
                                        'race_instance_title' => 'ApolloBet Bet Through Your Mobile Standard Open National Hunt Flat Race',
                                        'declared_runners' => 14,
                                        'race_group_desc' => 'Handicap',
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => 1195571,
                                    ]
                                ),
                            ],
                        ]
                    )
                ],
                [
                    0 => (Object)[
                        'race_instance_uid' => 661030,
                        'horse_uid' => 882980,
                    ],
                    1 => (Object)[
                        'race_instance_uid' => 661034,
                        'horse_uid' => 1021441
                    ]
                ]
            ],
            [
                new Request\ListForMobile(),
                [
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'entries' => [
                                0 => (Object)[
                                    'horse_uid' => 882980,
                                    'race_instance_uid' => 661030,
                                ],
                                1 => [
                                    [
                                        [
                                            [
                                                (Object)[
                                                    'horse_uid' => 1021441,
                                                    [
                                                        (Object)[
                                                            'race_instance_uid' => 661034
                                                        ]
                                                    ]
                                                ],
                                                [
                                                    [
                                                        [
                                                            [
                                                                [
                                                                    (Object)[
                                                                        'race_instance_uid' => 111111,
                                                                        'horse_uid' => 123123,
                                                                    ]
                                                                ]
                                                            ]
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    )
                ],
                [
                    0 => (Object)[
                        'race_instance_uid' => 661030,
                        'horse_uid' => 882980,
                    ],
                    1 => (Object)[
                        'race_instance_uid' => 661034,
                        'horse_uid' => 1021441
                    ]
                ]
            ]
        ];
    }
}
