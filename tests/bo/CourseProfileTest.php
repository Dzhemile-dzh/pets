<?php

namespace Tests;

use Api\Input\Request\Horses\Profile as ProfileRequest;
use Phalcon\Mvc\Model\Row\General as GeneralRow;
use \Api\Input\Request\Horses\Profile\Course as InputRequest;
use Tests\Stubs\Bo\CourseProfile;
use Api\Row\CourseProfile\TopTrainers as TopTrainersRow;

class CourseProfileTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param ProfileRequest $request
     * @param array          $expectedResult
     *
     * @dataProvider providerTestInitByModel
     */
    public function testInitByModel(ProfileRequest $request, array $expectedResult)
    {
        $courseProfileObject = CourseProfile::initByModel($request);
        $newRerequest = $courseProfileObject->getRequest();
        $this->assertEquals(
            [
                CourseProfile::MODEL_COURSE => $newRerequest->get(CourseProfile::MODEL_COURSE),
                CourseProfile::MODEL_RACE_INSTANCE => $newRerequest->get(CourseProfile::MODEL_RACE_INSTANCE),
            ],
            $expectedResult
        );
    }

    public function providerTestInitByModel()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\Horses([], [
                    'ownerId' => 1,
                ]),
                [
                    CourseProfile::MODEL_COURSE => new \Tests\Stubs\Models\Bo\CourseProfile\Course(),
                    CourseProfile::MODEL_RACE_INSTANCE => new \Tests\Stubs\Models\Bo\CourseProfile\RaceInstance(),
                ]
            ]
        ];
    }

    /**
     * @param InputRequest\Index $request
     * @param array              $expectedResult
     *
     * @dataProvider providerTestGetProfile
     */
    public function testGetProfile(
        InputRequest\Index $request,
        $expectedResult
    ) {
        $courseProfileObject = new Stubs\Bo\CourseProfile($request);
        $this->assertEquals(
            $courseProfileObject->getProfile(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProfile()
    {
        return [
            [
                new InputRequest\Index(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                (Object)[
                    'country_code' => 'GB',
                    'course_name' => 'ASCOT',
                    'course_style_name' => 'Ascot',
                    'course_clerk' => 'Chris Stickels',
                    'course_tel' => '01344 878502, all general enquiries: 01344 876 876',
                    'course_scales_clerk' => null,
                    'course_judge' => null,
                    'course_stewards' => null,
                    'course_starters' => null,
                    'course_type_code' => 'B',
                ]
            ]
        ];
    }

    /**
     * @param InputRequest\UpcomingRaces $request
     * @param array                      $expectedResult
     *
     * @dataProvider providerTestGetUpcomingRaces
     */
    public function testGetUpcomingRaces(
        InputRequest\UpcomingRaces $request,
        array $expectedResult
    ) {
        $courseProfileObject = new Stubs\Bo\CourseProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($courseProfileObject->getUpcomingRaces())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetUpcomingRaces()
    {
        return [
            [
                new InputRequest\UpcomingRaces(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    (Object)[

                        "race_date" => "11/21/2014",
                        "race_datetime_first" => "Nov 21 2014 3:50PM",
                        "race_datetime_last" => "Nov 21 2014 1:00PM",
                        "race_instance_uid_first" => 613393,
                        "race_instance_uid_fast" => 613378

                    ],
                    (Object)[

                        "race_date" => "11/22/2014",
                        "race_datetime_first" => "Nov 22 2014 3:50PM",
                        "race_datetime_last" => "Nov 22 2014 12:25PM",
                        "race_instance_uid_first" => 613510,
                        "race_instance_uid_fast" => 613484

                    ]
                ]
            ]
        ];
    }

    /**
     * @param InputRequest\PrincipleRaceResults $request
     * @param array|null                        $expectedResult
     *
     * @dataProvider providerTestGetPrincipleRaceResults
     */
    public function testGetPrincipleRaceResults(
        InputRequest\PrincipleRaceResults $request,
        $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertEquals($expectedResult, $courseProfile->getPrincipleRaceResults());
    }

    /**
     * @return array
     */
    public function providerTestGetPrincipleRaceResults()
    {
        return [
            [
                new InputRequest\PrincipleRaceResults(
                    [2015],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    0 => GeneralRow::createFromArray([
                        'race_instance_uid' => 631698,
                        'race_instance_title' => 'Qipco Champion Stakes (British Champions Middle Distance) (Group 1)',
                        'race_group_uid' => 1,
                        'race_datetime' => 'Oct 17 2015  3:05PM',
                        'horse_uid' => 846896,
                        'horse_style_name' => 'Fascinating Rock',
                        'country_origin_code' => 'IRE',
                        'trainer_uid' => 1010,
                        'trainer_style_name' => 'D K Weld',
                        'ptp_type_code' => 'N',
                        'prize_sterling' => 770547.12,
                        'video_detail' => [
                            0 => GeneralRow::createFromArray([
                                'race_instance_uid' => 631698,
                                'ptv_video_id' => 1068617,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2548248,
                                'complete_race_start' => 566,
                                'complete_race_end' => 794,
                                'finish_race_uid' => 2548250,
                                'finish_race_start' => 652,
                                'finish_race_end' => 713,
                            ]),
                        ],
                    ]),
                    1 => GeneralRow::createFromArray([
                        'race_instance_uid' => 627834,
                        'race_instance_title' => 'King George VI And Queen Elizabeth Stakes (Sponsored By Qipco) (British Champions Series) (Group 1)',
                        'race_group_uid' => 1,
                        'race_datetime' => 'Jul 25 2015  3:50PM',
                        'horse_uid' => 836837,
                        'horse_style_name' => 'Postponed',
                        'country_origin_code' => 'IRE',
                        'trainer_uid' => 401,
                        'trainer_style_name' => 'Luca Cumani',
                        'ptp_type_code' => 'N',
                        'prize_sterling' => 689026.5,
                        'video_detail' => [
                            0 => GeneralRow::createFromArray([
                                'race_instance_uid' => 627834,
                                'ptv_video_id' => 1043559,
                                'video_provider' => 'RUK',
                                'complete_race_uid' => 2529151,
                                'complete_race_start' => 479,
                                'complete_race_end' => 776,
                                'finish_race_uid' => 2529152,
                                'finish_race_start' => 590,
                                'finish_race_end' => 701,
                            ]),
                        ],
                    ]),
                ]
            ],
            [
                new InputRequest\PrincipleRaceResults(
                    [2015],
                    [
                        'courseId' => 5
                    ]
                ),
                null
            ]
        ];
    }

    /**
     * @param InputRequest\Index $request
     * @param array              $expectedResult
     *
     * @dataProvider providerTestAdmission
     */
    public function testGetAdmission(
        InputRequest\Index $request,
        array $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($courseProfile->getAdmission())
        );
    }

    /**
     * @return array
     */
    public function providerTestAdmission()
    {
        return [
            [
                new InputRequest\Index(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    (Object)[
                        "rp_admission_prices" => "Premier: SOLD OUT Grandstand: FREE. Accompanied U-18's free.",
                        "rp_children" => "Parent and baby changing rooms available."
                    ]
                ]
            ]
        ];
    }

    /**
     * @param InputRequest\Index $request
     * @param array              $expectedResult
     *
     * @dataProvider providerTestDirections
     */
    public function testGetDirections(
        InputRequest\Index $request,
        array $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($courseProfile->getDirections())
        );
    }

    /**
     * @return array
     */
    public function providerTestDirections()
    {
        return [
            [
                new InputRequest\Index(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    (Object)[
                        "course_address" => "Ascot Racecourse, Ascot, Berks, SL5 7JX",
                        "rp_parking" => "Car Park 8: £20 For Royal Ascot meeting, please contact general enquiries for details.",
                        "rp_disabled" => "Disabled car parking, wheelchair hire, access to all enclosures, designated viewing areas.",
                        "how_to_get_there" => (Object)[
                            "road" => "W of town on A329 Bracknell road. M4(Jctn6); M3(Jctn3).",
                            "rail" => "500yds, Ascot Stn (from London Waterloo).",
                            "air" => "15m, London (Heathrow); 12m, White Waltham Airfield.",
                            "bus" => null,
                            "riverbus" => null
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @param InputRequest\CourseMap $request
     * @param array|null             $expectedResult
     *
     * @dataProvider providerTestCourseMap
     */
    public function testGetCourseMap(
        InputRequest\CourseMap $request,
        array $expectedResult = null
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertEquals($expectedResult, $courseProfile->getCourseMap());
    }

    /**
     * @return array
     */
    public function providerTestCourseMap()
    {
        return [
            [
                new InputRequest\CourseMap(
                    [],
                    [
                        'courseId' => 123
                    ]
                ),
                null
            ],
            [
                new InputRequest\CourseMap(
                    [],
                    [
                        'courseId' => 4
                    ]
                ),
                [
                    0 => GeneralRow::createFromArray([
                        'course_uid' => 4,
                        'course_name' => 'BANGOR-ON-DEE',
                        'latitude' => 51.094062999999998,
                        'longitude' => 1.0320279999999999,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'H' => 'H',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'right-handed, fairly sharp track',
                        'rp_detailed_flat_desc' => 'Right-handed, undulating 1 1/4m oval with 3f run-in.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Right-handed, undulating oval of 1m2f',
                        'rp_detailed_hurdle_desc' => 'right-handed, undulating track with easy hurdles',
                        'rp_detailed_chase_desc' => 'right-handed, undulating track with easy fences',
                        'small_map_image_path' => 'course_maps/small/bangor-on-deeh.jpg',
                        'large_map_image_path' => 'course_maps/large/bangor-on-deeh.jpg',
                    ]),
                    1 => GeneralRow::createFromArray([
                        'course_uid' => 4,
                        'course_name' => 'BANGOR-ON-DEE',
                        'latitude' => 51.094062999999998,
                        'longitude' => 1.0320279999999999,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'U' => 'U',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'right-handed, undulating track with easy fences',
                        'rp_detailed_flat_desc' => 'Right-handed, undulating 1 1/4m oval with 3f run-in.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Right-handed, undulating oval of 1m2f',
                        'rp_detailed_hurdle_desc' => 'right-handed, undulating track with easy hurdles',
                        'rp_detailed_chase_desc' => 'right-handed, undulating track with easy fences',
                        'small_map_image_path' => 'course_maps/small/bangor-on-deech.jpg',
                        'large_map_image_path' => 'course_maps/large/bangor-on-deech.jpg',
                    ])
                ]
            ],
            [
                new InputRequest\CourseMap(
                    [],
                    [
                        'courseId' => 19
                    ]
                ),
                [
                    0 => GeneralRow::createFromArray([
                        'course_uid' => 19,
                        'course_name' => 'FOLKESTONE',
                        'latitude' => 51.094062999999998,
                        'longitude' => 1.0320279999999999,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'F' => 'F',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'right-handed, fairly sharp track',
                        'rp_detailed_flat_desc' => 'Right-handed, undulating 1 1/4m oval with 3f run-in.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Right-handed, undulating oval of 1m2f',
                        'rp_detailed_hurdle_desc' => 'right-handed, undulating track with easy hurdles',
                        'rp_detailed_chase_desc' => 'right-handed, undulating track with easy fences',
                        'small_map_image_path' => 'course_maps/small/folkestone.jpg',
                        'large_map_image_path' => 'course_maps/large/folkestone.jpg',
                    ]),
                    1 => GeneralRow::createFromArray([
                        'course_uid' => 19,
                        'course_name' => 'FOLKESTONE',
                        'latitude' => 51.094062999999998,
                        'longitude' => 1.0320279999999999,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'H' => 'H',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'right-handed, undulating track with easy fences',
                        'rp_detailed_flat_desc' => 'Right-handed, undulating 1 1/4m oval with 3f run-in.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Right-handed, undulating oval of 1m2f',
                        'rp_detailed_hurdle_desc' => 'right-handed, undulating track with easy hurdles',
                        'rp_detailed_chase_desc' => 'right-handed, undulating track with easy fences',
                        'small_map_image_path' => 'course_maps/small/folkestoneh.jpg',
                        'large_map_image_path' => 'course_maps/large/folkestoneh.jpg',
                    ]),
                    2 => GeneralRow::createFromArray([
                        'course_uid' => 19,
                        'course_name' => 'FOLKESTONE',
                        'latitude' => 51.094062999999998,
                        'longitude' => 1.0320279999999999,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'U' => 'U',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'right-handed, undulating track with easy fences',
                        'rp_detailed_flat_desc' => 'Right-handed, undulating 1 1/4m oval with 3f run-in.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Right-handed, undulating oval of 1m2f',
                        'rp_detailed_hurdle_desc' => 'right-handed, undulating track with easy hurdles',
                        'rp_detailed_chase_desc' => 'right-handed, undulating track with easy fences',
                        'small_map_image_path' => 'course_maps/small/folkestonech.jpg',
                        'large_map_image_path' => 'course_maps/large/folkestonech.jpg',
                    ]),
                ]
            ],
            [
                new InputRequest\CourseMap(
                    [],
                    [
                        'courseId' => 3
                    ]
                ),
                [
                    0 => GeneralRow::createFromArray([
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'latitude' => 55.467311000000002,
                        'longitude' => -4.6053699999999997,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'F' => 'F',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'left-handed, galloping track',
                        'rp_detailed_flat_desc' => 'Left-handed 1 1/2m oval, galloping with minor undulations.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Left-handed, mainly flat. Circuit 1m4f.',
                        'rp_detailed_hurdle_desc' => null,
                        'rp_detailed_chase_desc' => null,
                        'small_map_image_path' => 'course_maps/small/ayr.jpg',
                        'large_map_image_path' => 'course_maps/large/ayr.jpg',
                    ]),
                    1 => GeneralRow::createFromArray([
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'latitude' => 55.467311000000002,
                        'longitude' => -4.6053699999999997,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'H' => 'H',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'left-handed, fairly galloping track',
                        'rp_detailed_flat_desc' => 'Left-handed 1 1/2m oval, galloping with minor undulations.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Left-handed, mainly flat. Circuit 1m4f.',
                        'rp_detailed_hurdle_desc' => null,
                        'rp_detailed_chase_desc' => null,
                        'small_map_image_path' => 'course_maps/small/ayrh.jpg',
                        'large_map_image_path' => 'course_maps/large/ayrh.jpg',
                    ]),
                    2 => GeneralRow::createFromArray([
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'latitude' => 55.467311000000002,
                        'longitude' => -4.6053699999999997,
                        'zoom' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'race_type_code' => [
                            'U' => 'U',
                        ],
                        'straight_round_jubilee' => null,
                        'course_comment' => 'left-handed, fairly galloping track',
                        'rp_detailed_flat_desc' => 'Left-handed 1 1/2m oval, galloping with minor undulations.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => 'Left-handed, mainly flat. Circuit 1m4f.',
                        'rp_detailed_hurdle_desc' => null,
                        'rp_detailed_chase_desc' => null,
                        'small_map_image_path' => 'course_maps/small/ayrch.jpg',
                        'large_map_image_path' => 'course_maps/large/ayrch.jpg',
                    ]),
                ]
            ],
            [
                new InputRequest\CourseMap(
                    [],
                    [
                        'courseId' => 38
                    ]
                ),
                [
                    0 => GeneralRow::createFromArray([
                        'course_uid' => 38,
                        'course_name' => 'NEWMARKET',
                        'latitude' => 52.236941999999999,
                        'longitude' => 0.374135,
                        'zoom' => 14,
                        'country_code' => 'GB ',
                        'course_type_code' => 'F',
                        'race_type_code' => [
                            'F' => 'F'
                        ],
                        'straight_round_jubilee' => 'row',
                        'course_comment' => 'right-handed, galloping track',
                        'rp_detailed_flat_desc' => 'Right-handed 2m2f Cesarewitch Course turning into undulating 1m2f straight. Uphill final furlong exposes stamina weaknesses. Wide and galloping; good test.',
                        'rp_detailed_aw_desc' => null,
                        'rp_detailed_jump_desc' => null,
                        'rp_detailed_hurdle_desc' => null,
                        'rp_detailed_chase_desc' => null,
                        'small_map_image_path' => 'course_maps/small/newmarketrm.jpg',
                        'large_map_image_path' => 'course_maps/large/newmarketrm.jpg',
                    ]),
                ]
            ]
        ];
    }

    /**
     * @param InputRequest\Statistics $request
     * @param mixed                   $expectedResult $expectedResult
     *
     * @dataProvider providerTestGetStatistics
     */
    public function testGetStatistics(
        InputRequest\Statistics $request,
        $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($courseProfile->getStatistics())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStatistics()
    {
        return [
            [
                new InputRequest\Statistics(
                    [
                        2011,
                        2015,
                        'flat'
                    ],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    'top_jockeys' => [
                        GeneralRow::createFromArray(
                            [
                                'jockey_uid' => 79202,
                                'style_name' => 'Ryan Moore',
                                'ptp_type_code' => 'N',
                                'wins' => 37,
                                'runs' => 242,
                                'stake' => -67.17,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'jockey_uid' => 85793,
                                'style_name' => 'William Buick',
                                'ptp_type_code' => 'N',
                                'wins' => 24,
                                'runs' => 185,
                                'stake' => -19.43,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'jockey_uid' => 3793,
                                'style_name' => 'Richard Hughes',
                                'ptp_type_code' => 'N',
                                'wins' => 22,
                                'runs' => 233,
                                'stake' => -91.83,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'jockey_uid' => 13689,
                                'style_name' => 'Jamie Spencer',
                                'ptp_type_code' => 'N',
                                'wins' => 16,
                                'runs' => 159,
                                'stake' => -41.82,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'jockey_uid' => 6901,
                                'style_name' => 'James Doyle',
                                'ptp_type_code' => 'N',
                                'wins' => 15,
                                'runs' => 127,
                                'stake' => -25.27,
                            ]
                        ),
                    ],
                    'top_trainers' => [
                        GeneralRow::createFromArray(
                            [
                                'trainer_uid' => 4336,
                                'style_name' => 'John Gosden',
                                'ptp_type_code' => 'N',
                                'wins' => 28,
                                'runs' => 170,
                                'stake' => 33.57,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'trainer_uid' => 282,
                                'style_name' => 'Richard Hannon Snr',
                                'ptp_type_code' => 'N',
                                'wins' => 24,
                                'runs' => 259,
                                'stake' => -75.65,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'trainer_uid' => 3378,
                                'style_name' => 'Mark Johnston',
                                'ptp_type_code' => 'N',
                                'wins' => 18,
                                'runs' => 249,
                                'stake' => -79.84,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'trainer_uid' => 619,
                                'style_name' => 'Sir Michael Stoute',
                                'ptp_type_code' => 'N',
                                'wins' => 14,
                                'runs' => 109,
                                'stake' => -45.62,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'trainer_uid' => 7978,
                                'style_name' => 'A P O\'Brien',
                                'wins' => 14,
                                'ptp_type_code' => 'N',
                                'runs' => 105,
                                'stake' => -13.59,
                            ]
                        ),
                    ],
                    'top_owners' => [
                        GeneralRow::createFromArray(
                            [
                                'owner_uid' => 49845,
                                'style_name' => 'Godolphin',
                                'ptp_type_code' => 'N',
                                'wins' => 24,
                                'runs' => 212,
                                'stake' => -31.63,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'owner_uid' => 1859,
                                'style_name' => 'Hamdan Al Maktoum',
                                'ptp_type_code' => 'N',
                                'wins' => 21,
                                'runs' => 184,
                                'stake' => -45.50,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'owner_uid' => 16906,
                                'style_name' => 'K Abdullah',
                                'ptp_type_code' => 'N',
                                'wins' => 16,
                                'runs' => 103,
                                'stake' => -38.45,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'owner_uid' => 59472,
                                'style_name' => 'Sheikh Hamdan bin Mohammed Al Maktoum',
                                'ptp_type_code' => 'N',
                                'wins' => 8,
                                'runs' => 131,
                                'stake' => -17.00,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'owner_uid' => 49024,
                                'style_name' => 'Lady Rothschild',
                                'ptp_type_code' => 'N',
                                'wins' => 7,
                                'runs' => 20,
                                'stake' => 22.50,
                            ]
                        )
                    ],
                    'top_horses' => [
                        GeneralRow::createFromArray(
                            [
                                'horse_uid' => 861914,
                                'style_name' => 'Masterplan',
                                'wins' => 2,
                                'runs' => 3,
                                'trainer_uid' => 18660,
                                'trainer_name' => 'Charlie Longsdon',
                                'top_rpr' => null,
                                'stake' => 21.50,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'horse_uid' => 832406,
                                'style_name' => 'Cold March',
                                'wins' => 1,
                                'runs' => 3,
                                'trainer_uid' => 17752,
                                'trainer_name' => 'B Lefevre',
                                'top_rpr' => null,
                                'stake' => 10.00,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'horse_uid' => 805076,
                                'style_name' => 'Royal Regatta',
                                'wins' => 1,
                                'runs' => 3,
                                'trainer_uid' => 135,
                                'trainer_name' => 'Philip Hobbs',
                                'top_rpr' => null,
                                'stake' => 6.00,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'horse_uid' => 870671,
                                'style_name' => 'Duke Des Champs',
                                'wins' => 1,
                                'runs' => 2,
                                'trainer_uid' => 135,
                                'trainer_name' => 'Philip Hobbs',
                                'top_rpr' => null,
                                'stake' => -0.09,
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'horse_uid' => 856933,
                                'style_name' => 'Desert Queen',
                                'wins' => 1,
                                'runs' => 2,
                                'trainer_uid' => 29988,
                                'trainer_name' => 'Ben Clarke',
                                'top_rpr' => null,
                                'stake' => 7.00,
                            ]
                        )
                    ]
                ]
            ]
        ];
    }

    /**
     * @param int   $courseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetStandardTimes
     */
    public function testGetStandardTimes($courseId, array $expectedResult)
    {
        $courseProfileObject = new Stubs\Bo\CourseProfile($courseId);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($courseProfileObject->getStandardTimes())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStandardTimes()
    {
        return [
            [
                new InputRequest\StandardTimes(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                array(
                    'flat' => array(
                        0 => GeneralRow::createFromArray(
                            array(
                                'race_type_code' => 'F',
                                'distance_yards' => 1100,
                                'straight_round_jubilee_code' => null,
                                'race_date' => 'Sep 18 2003 12:00AM',
                                'horse_name' => 'Boogie Street',
                                'course_record_horse_name' => 'Boogie Street',
                                'horse_uid' => 579799,
                                'country_origin_code' => 'GB',
                                'rp_ages_allowed_desc' => '2yo',
                                'winners_time' => 56.979999999999997,
                                'no_of_fences' => null,
                                'average_time_sec' => 57.299999999999997,
                                'race_instance_uid' => 338426,
                            )
                        ),
                        1 => GeneralRow::createFromArray(
                            array(
                                'race_type_code' => 'F',
                                'distance_yards' => 1100,
                                'straight_round_jubilee_code' => null,
                                'race_date' => 'Jun 21 2008 12:00AM',
                                'horse_name' => 'Look Busy',
                                'course_record_horse_name' => 'Look Busy',
                                'horse_uid' => 679092,
                                'country_origin_code' => 'IRE',
                                'rp_ages_allowed_desc' => '3yo+',
                                'winners_time' => 55.68,
                                'no_of_fences' => null,
                                'average_time_sec' => 57.299999999999997,
                                'race_instance_uid' => null,
                            )
                        ),
                        2 => GeneralRow::createFromArray(
                            array(
                                'race_type_code' => 'F',
                                'distance_yards' => 1320,
                                'straight_round_jubilee_code' => null,
                                'race_date' => 'Jun 21 2008 12:00AM',
                                'horse_name' => 'Maison Dieu',
                                'course_record_horse_name' => 'Maison Dieu',
                                'horse_uid' => 637115,
                                'country_origin_code' => 'GB',
                                'rp_ages_allowed_desc' => '3yo+',
                                'winners_time' => 68.370000000000005,
                                'no_of_fences' => null,
                                'average_time_sec' => 70,
                                'race_instance_uid' => 459434,
                            )
                        ),
                        3 => GeneralRow::createFromArray(
                            array(
                                'race_type_code' => 'F',
                                'distance_yards' => 1320,
                                'straight_round_jubilee_code' => null,
                                'race_date' => 'Sep 17 1969 12:00AM',
                                'horse_name' => 'Sir Bert',
                                'course_record_horse_name' => 'Sir Bert',
                                'horse_uid' => 865413,
                                'country_origin_code' => 'GB',
                                'rp_ages_allowed_desc' => '2yo',
                                'winners_time' => 69.730000000000004,
                                'no_of_fences' => null,
                                'average_time_sec' => 70,
                                'race_instance_uid' => 607228,
                            )
                        )
                    ),
                    'jump' => array(
                        0 => GeneralRow::createFromArray(
                            array(
                                'race_type_code' => 'C',
                                'distance_yards' => 3412,
                                'straight_round_jubilee_code' => null,
                                'race_date' => 'Oct 12 1991 12:00AM',
                                'horse_name' => 'Clay County',
                                'course_record_horse_name' => 'Clay County',
                                'horse_uid' => 40890,
                                'country_origin_code' => 'GB',
                                'rp_ages_allowed_desc' => '3yo+',
                                'winners_time' => 218.59999999999999,
                                'no_of_fences' => 12,
                                'average_time_sec' => 220,
                                'race_instance_uid' => 42488,
                            )
                        ),
                        2 => GeneralRow::createFromArray(
                            array(
                                'race_type_code' => 'H',
                                'distance_yards' => 3520,
                                'straight_round_jubilee_code' => 'Z',
                                'race_date' => 'Apr 19 1980 12:00AM',
                                'horse_name' => 'Secret Ballot',
                                'course_record_horse_name' => 'Secret Ballot',
                                'horse_uid' => 884161,
                                'country_origin_code' => 'GB',
                                'rp_ages_allowed_desc' => '3yo+',
                                'winners_time' => 207.40000000000001,
                                'no_of_fences' => 9,
                                'average_time_sec' => 219,
                                'race_instance_uid' => 622614,
                            )
                        ),
                        3 => GeneralRow::createFromArray(
                            array(
                                'race_type_code' => 'H',
                                'distance_yards' => 3520,
                                'straight_round_jubilee_code' => 'Z',
                                'race_date' => 'Apr 19 1980 12:00AM',
                                'horse_name' => 'Secret Ballot',
                                'course_record_horse_name' => 'Secret Ballot',
                                'horse_uid' => 449098,
                                'country_origin_code' => 'IRE',
                                'rp_ages_allowed_desc' => '3yo+',
                                'winners_time' => 207.40000000000001,
                                'no_of_fences' => 9,
                                'average_time_sec' => 219,
                                'race_instance_uid' => 622614,
                            )
                        )
                    ),
                )
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param array                            $expectedResult
     *
     * @dataProvider providerTestGetSeasonDefaultValues
     */
    public function testGetSeasonDefaultValues(
        $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\CourseProfile($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getSeasonDefaultValues())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSeasonDefaultValues()
    {
        return [
            [
                new InputRequest\Statistics(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    'seasonYearBegin' => 2015,
                    'seasonYearEnd' => 2015,
                    'raceType' => 'flat'
                ]
            ],

        ];
    }

    /**
     * @param InputRequest\CourseMap $request
     * @param                        $courseMaps
     * @param array                  $expectedResult
     *
     * @dataProvider providerTestAddMapImagePath
     */
    public function testAddMapImagePath(
        InputRequest\CourseMap $request,
        $courseMaps,
        array $expectedResult
    ) {

        $object = new \Tests\Stubs\Bo\CourseProfile($request);
        $reflector = new \ReflectionClass('\Tests\Stubs\Bo\CourseProfile');
        $method = $reflector->getMethod(
            'addMapImagePath'
        );
        $method->setAccessible(true);

        $result = $method->invokeArgs($object, [$courseMaps]);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function providerTestAddMapImagePath()
    {
        $request = new InputRequest\CourseMap(
            [],
            ['courseId' => 2]
        );
        return [
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'J',
                            'race_type_code' => 'H',
                            'small_map_image_path' => 'course_maps/small/ascoth.jpg',
                            'large_map_image_path' => 'course_maps/large/ascoth.jpg',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'J',
                            'race_type_code' => 'H',
                            'small_map_image_path' => 'course_maps/small/ascoth.jpg',
                            'large_map_image_path' => 'course_maps/large/ascoth.jpg',
                        ]
                    )
                ]
            ],
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'F',
                            'race_type_code' => 'F',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'F',
                            'race_type_code' => 'F',
                            'small_map_image_path' => 'course_maps/small/ascot.jpg',
                            'large_map_image_path' => 'course_maps/large/ascot.jpg',
                        ]
                    )
                ]
            ],
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                            'small_map_image_path' => 'course_maps/small/ascotaw.jpg',
                            'large_map_image_path' => 'course_maps/large/ascotaw.jpg',
                        ]
                    )
                ]
            ],
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'B',
                            'race_type_code' => 'B',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'B',
                            'race_type_code' => 'B',
                            'small_map_image_path' => 'course_maps/small/ascot.jpg',
                            'large_map_image_path' => 'course_maps/large/ascot.jpg',
                        ]
                    )
                ]
            ],
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'P',
                            'race_type_code' => 'P',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'GB',
                            'course_type_code' => 'P',
                            'race_type_code' => 'P',
                            'small_map_image_path' => null,
                            'large_map_image_path' => null
                        ]
                    )
                ]
            ],
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'IRE',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'country_code' => 'IRE',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                            'small_map_image_path' => 'course_maps/small/ascot(ire)aw.jpg',
                            'large_map_image_path' => 'course_maps/large/ascot(ire)aw.jpg',
                        ]
                    )
                ]
            ],
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT A.W.',
                            'country_code' => 'IRE',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'ASCOT A.W.',
                            'country_code' => 'IRE',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                            'small_map_image_path' => 'course_maps/small/ascot(ire)aw.jpg',
                            'large_map_image_path' => 'course_maps/large/ascot(ire)aw.jpg',
                        ]
                    )
                ]
            ],
            [
                $request,
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'A S C-O-T A.W.',
                            'country_code' => 'IRE',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                        ]
                    )
                ],
                [
                    GeneralRow::createFromArray(
                        [
                            'course_uid' => 2,
                            'course_name' => 'A S C-O-T A.W.',
                            'country_code' => 'IRE',
                            'course_type_code' => 'X',
                            'race_type_code' => 'X',
                            'small_map_image_path' => 'course_maps/small/ascot(ire)aw.jpg',
                            'large_map_image_path' => 'course_maps/large/ascot(ire)aw.jpg',
                        ]
                    )
                ]
            ],
        ];
    }

    /**
     * @param InputRequest\SeasonsAvailable $request
     * @param array                         $expectedResult
     *
     * @throws \Api\Exception\ValidationError
     *
     * @dataProvider providerTestSeasonsAvailable
     */
    public function testGetSeasonsAvailable(
        InputRequest\SeasonsAvailable $request,
        array $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertEquals($expectedResult, $courseProfile->getSeasonsAvailable());
    }

    /**
     * @return array
     */
    public function providerTestSeasonsAvailable()
    {
        return [
            [
                new InputRequest\SeasonsAvailable(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    'FLAT' => [
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'FLAT',
                                'season_start_date' => 'Jan  1 2015 12:00AM',
                                'season_end_date' => 'Dec 31 2015 11:59PM',
                                'season_desc' => 'Flat 2015',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'FLAT',
                                'season_start_date' => 'Jan  1 2014 12:00AM',
                                'season_end_date' => 'Dec 31 2014 11:59PM',
                                'season_desc' => 'Flat 2014',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'FLAT',
                                'season_start_date' => 'Jan  1 2013 12:00AM',
                                'season_end_date' => 'Dec 31 2013 11:59PM',
                                'season_desc' => 'Flat 2013',
                            ]
                        ),
                    ],
                    'JUMPS' => [
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'JUMPS',
                                'season_start_date' => 'Apr 26 2015 12:00AM',
                                'season_end_date' => 'Apr 23 2016 11:59PM',
                                'season_desc' => 'NH 2015-2016',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'JUMPS',
                                'season_start_date' => 'Apr 27 2014 12:00AM',
                                'season_end_date' => 'Apr 25 2015 11:59PM',
                                'season_desc' => 'NH 2014-2015',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'JUMPS',
                                'season_start_date' => 'Apr 28 2013 12:00AM',
                                'season_end_date' => 'Apr 26 2014 11:59PM',
                                'season_desc' => 'NH 2013-2014',
                            ]
                        ),
                    ],
                ]
            ]
        ];
    }

    /**
     * @param InputRequest\SeasonsAvailable $request
     * @param array                         $expectedResult
     *
     * @throws \Api\Exception\ValidationError
     *
     * @dataProvider providerTestSeasonsAvailableException
     */
    public function testGetSeasonsAvailableException(
        InputRequest\SeasonsAvailable $request,
        array $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertEquals($expectedResult, $courseProfile->getSeasonsAvailable());
    }

    /**
     * @return array
     */
    public function providerTestSeasonsAvailableException()
    {
        return [
            [
                new InputRequest\SeasonsAvailable(
                    [],
                    [
                        'courseId' => 2
                    ]
                ),
                [
                    'FLAT' => [
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'FLAT',
                                'season_start_date' => 'Jan  1 2015 12:00AM',
                                'season_end_date' => 'Dec 31 2015 11:59PM',
                                'season_desc' => 'Flat 2015',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'FLAT',
                                'season_start_date' => 'Jan  1 2014 12:00AM',
                                'season_end_date' => 'Dec 31 2014 11:59PM',
                                'season_desc' => 'Flat 2014',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'FLAT',
                                'season_start_date' => 'Jan  1 2013 12:00AM',
                                'season_end_date' => 'Dec 31 2013 11:59PM',
                                'season_desc' => 'Flat 2013',
                            ]
                        ),
                    ],
                    'JUMPS' => [
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'JUMPS',
                                'season_start_date' => 'Apr 26 2015 12:00AM',
                                'season_end_date' => 'Apr 23 2016 11:59PM',
                                'season_desc' => 'NH 2015-2016',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'JUMPS',
                                'season_start_date' => 'Apr 27 2014 12:00AM',
                                'season_end_date' => 'Apr 25 2015 11:59PM',
                                'season_desc' => 'NH 2014-2015',
                            ]
                        ),
                        GeneralRow::createFromArray(
                            [
                                'season_type' => 'JUMPS',
                                'season_start_date' => 'Apr 28 2013 12:00AM',
                                'season_end_date' => 'Apr 26 2014 11:59PM',
                                'season_desc' => 'NH 2013-2014',
                            ]
                        ),
                    ],
                ]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderGetTopJockeys
     *
     * @param InputRequest\TopJockeys $request
     * @param array                   $expectedResult
     */
    public function testGetTopJockeys(
        InputRequest\TopJockeys $request,
        array $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertEquals($expectedResult, $courseProfile->getTopJockeys());
    }

    /**
     * @return array
     */
    public function dataProviderGetTopJockeys()
    {
        return [
            [
                new InputRequest\TopJockeys([2014, 2015], ['courseId' => 2]),
                [
                    'flat_turf' => [
                        0 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 79202,
                                'jockey_name' => 'RYAN MOORE',
                                'style_name' => 'Ryan Moore',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 62,
                                'no_of_wins' => 11,
                                'stake' => '-23.21600000000000',
                                'race_type' => 'flat_turf',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 85793,
                                'jockey_name' => 'WILLIAM BUICK',
                                'style_name' => 'William Buick',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 57,
                                'no_of_wins' => 9,
                                'stake' => '4.44400000000000',
                                'race_type' => 'flat_turf',
                            ]
                        ),
                    ],
                    'hurdle_turf' => [
                        0 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 14447,
                                'jockey_name' => 'BARRY GERAGHTY',
                                'style_name' => 'Barry Geraghty',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 15,
                                'no_of_wins' => 5,
                                'stake' => '-0.88100000000000',
                                'race_type' => 'hurdle_turf',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 12612,
                                'jockey_name' => 'R WALSH',
                                'style_name' => 'R Walsh',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 5,
                                'no_of_wins' => 3,
                                'stake' => '2.68300000000000',
                                'race_type' => 'hurdle_turf',
                            ]
                        ),
                    ],
                    'chase_turf' => [
                        0 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 81266,
                                'jockey_name' => 'DARYL JACOB',
                                'style_name' => 'Daryl Jacob',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 2,
                                'no_of_wins' => 2,
                                'stake' => '5.83300000000000',
                                'race_type' => 'chase_turf',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 77061,
                                'jockey_name' => 'NOEL FEHILY',
                                'style_name' => 'Noel Fehily',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 5,
                                'no_of_wins' => 2,
                                'stake' => '10.50000000000000',
                                'race_type' => 'chase_turf',
                            ]
                        ),
                    ],
                    'nh_flat' => [
                        0 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 91230,
                                'jockey_name' => 'JAMES BEST',
                                'style_name' => 'James Best',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 1,
                                'no_of_wins' => 1,
                                'stake' => '6.00000000000000',
                                'race_type' => 'nh_flat',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 87644,
                                'jockey_name' => 'NICO DE BOINVILLE',
                                'style_name' => 'Nico de Boinville',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 2,
                                'no_of_wins' => 1,
                                'stake' => '6.00000000000000',
                                'race_type' => 'nh_flat',
                            ]
                        ),
                    ],
                    'hunter_chase' => [
                        0 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 92302,
                                'jockey_name' => 'HARRY BANNISTER',
                                'style_name' => 'Harry Bannister',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 1,
                                'no_of_wins' => 1,
                                'stake' => '8.00000000000000',
                                'race_type' => 'hunter_chase',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopJockeys::createFromArray(
                            [
                                'jockey_uid' => 78905,
                                'jockey_name' => 'MR J SOLE',
                                'style_name' => 'Mr J Sole',
                                'ptp_type_code' => 'N',
                                'no_of_runs' => 1,
                                'no_of_wins' => 0,
                                'stake' => '-1.00000000000000',
                                'race_type' => 'hunter_chase',
                            ]
                        ),
                    ],
                    'point_to_point' => null,
                    'nh_flat_aw' => null,
                    'flat_aw' => null,
                    'hurdle_aw' => null,
                    'chase_aw' => null,
                ]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderGetTopTrainers
     *
     * @param InputRequest\TopTrainers $request
     * @param array                    $expectedResult
     */
    public function testGetTopTrainers(
        InputRequest\TopTrainers $request,
        array $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertEquals($expectedResult, $courseProfile->getTopTrainers());
    }

    /**
     * @return array
     */
    public function dataProviderGetTopTrainers()
    {
        return [
            [
                new InputRequest\TopTrainers([2014, 2015], ['courseId' => 2]),
                [
                    'flat_turf' => [
                        0 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 4336,
                                'trainer_name' => 'JOHN GOSDEN',
                                'style_name' => 'John Gosden',
                                'no_of_runs' => 45,
                                'no_of_wins' => 9,
                                'stake' => '10.17100000000000',
                                'race_type' => 'flat_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 3415,
                                'trainer_name' => 'WILLIAM HAGGAS',
                                'style_name' => 'William Haggas',
                                'no_of_runs' => 47,
                                'no_of_wins' => 6,
                                'stake' => '-12.87500000000000',
                                'race_type' => 'flat_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        2 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 28787,
                                'trainer_name' => 'RICHARD HANNON',
                                'style_name' => 'Richard Hannon',
                                'no_of_runs' => 91,
                                'no_of_wins' => 6,
                                'stake' => '-63.20000000000000',
                                'race_type' => 'flat_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                    ],
                    'chase_turf' => [
                        0 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 5767,
                                'trainer_name' => 'PAUL NICHOLLS',
                                'style_name' => 'Paul Nicholls',
                                'no_of_runs' => 17,
                                'no_of_wins' => 6,
                                'stake' => '14.20000000000000',
                                'race_type' => 'chase_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 20451,
                                'trainer_name' => 'NEIL MULHOLLAND',
                                'style_name' => 'Neil Mulholland',
                                'no_of_runs' => 2,
                                'no_of_wins' => 2,
                                'stake' => '4.25000000000000',
                                'race_type' => 'chase_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        2 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 188,
                                'trainer_name' => 'OLIVER SHERWOOD',
                                'style_name' => 'Oliver Sherwood',
                                'no_of_runs' => 4,
                                'no_of_wins' => 2,
                                'stake' => '1.75000000000000',
                                'race_type' => 'chase_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                    ],
                    'hurdle_turf' => [
                        0 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 311,
                                'trainer_name' => 'NICKY HENDERSON',
                                'style_name' => 'Nicky Henderson',
                                'no_of_runs' => 22,
                                'no_of_wins' => 5,
                                'stake' => '-11.63100000000000',
                                'race_type' => 'hurdle_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 27170,
                                'trainer_name' => 'HARRY FRY',
                                'style_name' => 'Harry Fry',
                                'no_of_runs' => 5,
                                'no_of_wins' => 4,
                                'stake' => '6.60000000000000',
                                'race_type' => 'hurdle_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        2 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 5767,
                                'trainer_name' => 'PAUL NICHOLLS',
                                'style_name' => 'Paul Nicholls',
                                'no_of_runs' => 10,
                                'no_of_wins' => 3,
                                'stake' => '9.12500000000000',
                                'race_type' => 'hurdle_turf',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                    ],
                    'nh_flat' => [
                        0 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 135,
                                'trainer_name' => 'PHILIP HOBBS',
                                'style_name' => 'Philip Hobbs',
                                'no_of_runs' => 1,
                                'no_of_wins' => 1,
                                'stake' => '6.00000000000000',
                                'race_type' => 'nh_flat',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 15605,
                                'trainer_name' => 'ANDREW BALDING',
                                'style_name' => 'Andrew Balding',
                                'no_of_runs' => 1,
                                'no_of_wins' => 1,
                                'stake' => '16.00000000000000',
                                'race_type' => 'nh_flat',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        2 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 18660,
                                'trainer_name' => 'CHARLIE LONGSDON',
                                'style_name' => 'Charlie Longsdon',
                                'no_of_runs' => 3,
                                'no_of_wins' => 1,
                                'stake' => '14.00000000000000',
                                'race_type' => 'nh_flat',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                    ],
                    'hunter_chase' => [
                        0 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 4415,
                                'trainer_name' => 'HENRIETTA KNIGHT',
                                'style_name' => 'Henrietta Knight',
                                'no_of_runs' => 1,
                                'no_of_wins' => 1,
                                'stake' => '8.00000000000000',
                                'race_type' => 'hunter_chase',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        1 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 8348,
                                'trainer_name' => 'IAN COBB',
                                'style_name' => 'Ian Cobb',
                                'no_of_runs' => 1,
                                'no_of_wins' => 0,
                                'stake' => '-1.00000000000000',
                                'race_type' => 'hunter_chase',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                        2 => \Api\Row\CourseProfile\TopTrainers::createFromArray(
                            [
                                'trainer_uid' => 10235,
                                'trainer_name' => 'STEVE FLOOK',
                                'style_name' => 'Steve Flook',
                                'no_of_runs' => 1,
                                'no_of_wins' => 0,
                                'stake' => '-1.00000000000000',
                                'race_type' => 'hunter_chase',
                                'ptp_type_code' => 'N',
                            ]
                        ),
                    ],
                    'point_to_point' => null,
                    'nh_flat_aw' => null,
                    'flat_aw' => null,
                    'hurdle_aw' => null,
                    'chase_aw' => null,
                ]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderGetTopOwners
     *
     * @param InputRequest\TopTrainers $request
     * @param object                   $expectedResult
     */
    public function testGetTopOwners(
        InputRequest\TopOwners $request,
        array $expectedResult
    ) {
        $courseProfile = new \Tests\Stubs\Bo\CourseProfile($request);
        $this->assertEquals($expectedResult, $courseProfile->getTopOwners());
    }

    /**
     * @return array
     */
    public function dataProviderGetTopOwners()
    {
        return [
            [
                new InputRequest\TopOwners([2014, 2015], ['courseId' => 2]),
                [
                    'flat_turf' => [
                        0 => TopTrainersRow::createFromArray([
                            'owner_uid' => 49845,
                            'owner_name' => 'GODOLPHIN',
                            'style_name' => 'Godolphin',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 75,
                            'no_of_wins' => 10,
                            'stake' => '-5.80000000000000',
                            'race_type' => 'flat_turf',
                        ]),
                        1 => TopTrainersRow::createFromArray([
                            'owner_uid' => 1859,
                            'owner_name' => 'HAMDAN AL MAKTOUM',
                            'style_name' => 'Hamdan Al Maktoum',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 40,
                            'no_of_wins' => 4,
                            'stake' => '-11.75000000000000',
                            'race_type' => 'flat_turf',
                        ]),
                        2 => TopTrainersRow::createFromArray([
                            'owner_uid' => 143821,
                            'owner_name' => 'MRS JOHN MAGNIER & MICHAEL TABOR & DERRICK SMITH',
                            'style_name' => 'Mrs John Magnier & Michael Tabor & Derrick Smith',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 5,
                            'no_of_wins' => 3,
                            'stake' => '18.50000000000000',
                            'race_type' => 'flat_turf',
                        ]),
                        3 => TopTrainersRow::createFromArray([
                            'owner_uid' => 100567,
                            'owner_name' => 'LORD BLYTH',
                            'style_name' => 'Lord Blyth',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 2,
                            'no_of_wins' => 2,
                            'stake' => '5.50000000000000',
                            'race_type' => 'flat_turf',
                        ]),
                        4 => TopTrainersRow::createFromArray([
                            'owner_uid' => 59934,
                            'owner_name' => 'WERTHEIMER & FRERE',
                            'style_name' => 'Wertheimer & Frere',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 2,
                            'no_of_wins' => 2,
                            'stake' => '2.47500000000000',
                            'race_type' => 'flat_turf',
                        ]),
                        5 => TopTrainersRow::createFromArray([
                            'owner_uid' => 118162,
                            'owner_name' => 'NEWSELLS PARK STUD',
                            'style_name' => 'Newsells Park Stud',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 2,
                            'no_of_wins' => 2,
                            'stake' => '5.75000000000000',
                            'race_type' => 'flat_turf',
                        ]),
                    ],
                    'hurdle_turf' => [
                        0 => TopTrainersRow::createFromArray([
                            'owner_uid' => 48081,
                            'owner_name' => 'GAVIN MACECHERN',
                            'style_name' => 'Gavin MacEchern',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 2,
                            'no_of_wins' => 2,
                            'stake' => '22.50000000000000',
                            'race_type' => 'hurdle_turf',
                        ]),
                        1 => TopTrainersRow::createFromArray([
                            'owner_uid' => 206338,
                            'owner_name' => 'THE JAGO FAMILY PARTNERSHIP',
                            'style_name' => 'The Jago Family Partnership',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 2,
                            'no_of_wins' => 2,
                            'stake' => '10.75000000000000',
                            'race_type' => 'hurdle_turf',
                        ]),
                        2 => TopTrainersRow::createFromArray([
                            'owner_uid' => 20887,
                            'owner_name' => 'JOHN P MCMANUS',
                            'style_name' => 'John P McManus',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 4,
                            'no_of_wins' => 2,
                            'stake' => '1.08300000000000',
                            'race_type' => 'hurdle_turf',
                        ]),
                    ],
                    'chase_turf' => [
                        0 => TopTrainersRow::createFromArray([
                            'owner_uid' => 20887,
                            'owner_name' => 'JOHN P MCMANUS',
                            'style_name' => 'John P McManus',
                            'ptp_type_code' => 'N',
                            'no_of_runs' => 5,
                            'no_of_wins' => 2,
                            'stake' => '7.00000000000000',
                            'race_type' => 'chase_turf',
                        ]),
                    ],
                    'nh_flat' => null,
                    'point_to_point' => null,
                    'hunter_chase' => null,
                    'nh_flat_aw' => null,
                    'flat_aw' => null,
                    'hurdle_aw' => null,
                    'chase_aw' => null,
                ]
            ]
        ];
    }

    /**
     * @param int   $courseId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetAverageTimes
     */
    public function testGetAverageTimes($courseId, array $expectedResult)
    {
        $courseProfileObject = new Stubs\Bo\CourseProfile($courseId);
        $actualResult = $courseProfileObject->getAverageTimes();
        $expectedResult = (Object)$expectedResult;
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($actualResult)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetAverageTimes()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Course\AverageTimes(
                    [],
                    [
                        'courseId' => 393
                    ]
                ),
                [
                    'flat' => [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'course_type' => 'flat',
                                'race_type_code' => 'X',
                                'distance_yards' => 1106,
                                'straight_round_jubilee_code' => null,
                                'straight_round_jubilee_desc' => null,
                                'no_of_fences' => null,
                                'average_time_sec' => 57.1,
                            ]
                        ),
                        1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'course_type' => 'flat',
                                'race_type_code' => 'X',
                                'distance_yards' => 1321,
                                'straight_round_jubilee_code' => null,
                                'straight_round_jubilee_desc' => null,
                                'no_of_fences' => null,
                                'average_time_sec' => 69.5,
                            ]
                        ),
                    ],
                    'jumps' => [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'course_type' => 'jumps',
                                'race_type_code' => 'W',
                                'distance_yards' => 2860,
                                'straight_round_jubilee_code' => null,
                                'straight_round_jubilee_desc' => null,
                                'no_of_fences' => null,
                                'average_time_sec' => 160.5,
                            ]
                        ),
                    ],
                ]
            ]
        ];
    }
}
