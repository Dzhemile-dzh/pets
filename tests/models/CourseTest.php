<?php

namespace Tests;

use \DateTime;
use Phalcon\Exception;
use Models\Course;

class CourseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $meetings
     * @param $expectedResult
     *
     * @dataProvider providerTestPrepareMeetingsForComparison
     * @throws \Exception
     */
    public function testPrepareMeetingsForComparison($meetings, $expectedResult)
    {
        $course = new Course();
        $course->prepareMeetingsForComparison($meetings);

        $this->assertEquals($expectedResult, $meetings);
    }

    /**
     * Test 1 changes nothing as 1 pre-evening meeting still has unfinished races
     * Test 2 switches the eveningMeeting priority as both the pre-evening meetings have finished
     * Test 3 changes nothing as race_date is in the past
     *
     * @return array
     * @throws \Exception
     */
    public function providerTestPrepareMeetingsForComparison()
    {
        $today     = (new DateTime())->format('Y-m-d');
        $yesterday = (new DateTime())->modify('-1 day')->format('Y-m-d');

        return [
            [
                [
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => 1,
                        'containsNotFinishedRaces' => -1
                    ]
                ],
                [
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => 1,
                        'containsNotFinishedRaces' => -1
                    ]
                ]
            ],
            [
                [
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => 1,
                        'containsNotFinishedRaces' => -1
                    ]
                ],
                [
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => 1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => 1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $today,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => -1
                    ]
                ]
            ],
            [
                [
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $yesterday,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $yesterday,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $yesterday,
                        'eveningMeeting'           => 1,
                        'containsNotFinishedRaces' => 0
                    ]
                ],
                [
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $yesterday,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $yesterday,
                        'eveningMeeting'           => -1,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'rp_position'              => 1,
                        'race_date'                => $yesterday,
                        'eveningMeeting'           => 1,
                        'containsNotFinishedRaces' => 0
                    ]
                ]
            ]
        ];
    }

    /**
     * @param $meetings
     * @param $expectedResult
     *
     * @dataProvider providerTestIsFirstLowerThanSecond
     * @throws \Exception
     */
    public function testIsFirstLowerThanSecond($meetings, $expectedResult)
    {
        list($meeting1, $meeting2) = $meetings;

        $course = new Course();
        $isLower = $course->isFirstLowerThanSecond($meeting1, $meeting2);

        $this->assertEquals($expectedResult, $isLower);
    }

    /**
     * Test 1 returns false as second array has lower racesItv
     * Test 2 returns true as racesItv is equal but first array has lower rp_position
     * Test 3 returns true as racesItv and rp_position are equal but first array has lower eveningMeeting
     * Test 4 returns false as racesItv, rp_position and eveningMeeting are equal but second array has lower totalPrizeMoney
     * Test 5 returns true as racesItv, rp_position, eveningMeeting and totalPrizeMoney are equal but first array has lower course_name
     *
     * @return array
     * @throws \Exception
     */
    public function providerTestIsFirstLowerThanSecond()
    {
        return [
            [
                [
                    (Object)[
                        'racesItv'        => 0,
                        'rp_position'     => 1,
                        'eveningMeeting'  => -1,
                        'totalPrizeMoney' => -98,765.43,
                        'course_name'     => 'ASCOT'
                    ],
                    (Object)[
                        'racesItv'        => -1,
                        'rp_position'     => 1,
                        'eveningMeeting'  => 1,
                        'totalPrizeMoney' => -123,456.78,
                        'course_name'     => 'KEMPTON'
                    ],
                ],
                false
            ],
            [
                [
                    (Object)[
                        'racesItv' => 0,
                        'rp_position' => 1,
                        'eveningMeeting' => -1,
                        'totalPrizeMoney' => -98,765.43,
                        'course_name' => 'ASCOT'
                    ],
                    (Object)[
                        'racesItv' => 0,
                        'rp_position' => 2,
                        'eveningMeeting' => -1,
                        'totalPrizeMoney' => -123,456.78,
                        'course_name' => 'SHA TIN'
                    ],
                ],
                true
            ],
            [
                [
                    (Object)[
                        'racesItv' => -1,
                        'rp_position' => 1,
                        'eveningMeeting' => -1,
                        'totalPrizeMoney' => -98,765.43,
                        'course_name' => 'ASCOT'
                    ],
                    (Object)[
                        'racesItv' => -1,
                        'rp_position' => 1,
                        'eveningMeeting' => 1,
                        'totalPrizeMoney' => -123,456.78,
                        'course_name' => 'KEMPTON'
                    ],
                ],
                true
            ],
            [
                [
                    (Object)[
                        'racesItv'        => 0,
                        'rp_position'     => 1,
                        'eveningMeeting'  => -1,
                        'totalPrizeMoney' => -98,765.43,
                        'course_name'     => 'ASCOT'
                    ],
                    (Object)[
                        'racesItv'        => 0,
                        'rp_position'     => 1,
                        'eveningMeeting'  => -1,
                        'totalPrizeMoney' => -123,456.78,
                        'course_name'     => 'KEMPTON'
                    ],
                ],
                false
            ],
            [
                [
                    (Object)[
                        'racesItv'        => 0,
                        'rp_position'     => 1,
                        'eveningMeeting'  => -1,
                        'totalPrizeMoney' => -123,456.78,
                        'course_name'     => 'ASCOT'
                    ],
                    (Object)[
                        'racesItv'        => 0,
                        'rp_position'     => 1,
                        'eveningMeeting'  => -1,
                        'totalPrizeMoney' => -123,456.78,
                        'course_name'     => 'KEMPTON'
                    ],
                ],
                true
            ]
        ];
    }

    /**
     * @param $meetings
     * @param $expectedResult
     *
     * @dataProvider providerTestCalculateRpMeetingOrder
     * @throws \Exception
     */
    public function testCalculateRpMeetingOrder($meetings, $expectedResult)
    {
        $course = new Course();
        $course->calculateRpMeetingOrder($meetings);

        $this->assertEquals($expectedResult, $meetings);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function providerTestCalculateRpMeetingOrder()
    {
        $today = (new DateTime())->format('Y-m-d');

        return [
            [
                [
                    (Object)[
                        'course_name'              => 'ASCOT',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 100,
                        'racesItv'                 => 0,
                        'rp_position'              => 1,
                        'eveningMeeting'           => -1,
                        'totalPrizeMoney'          => -98,765.43,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'course_name'              => 'KEMPTON',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 101,
                        'racesItv'                 => 0,
                        'rp_position'              => 1,
                        'eveningMeeting'           => 1,
                        'totalPrizeMoney'          => -93,445.68,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'course_name'              => 'LINGFIELD',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 102,
                        'racesItv'                 => -1,
                        'rp_position'              => 1,
                        'eveningMeeting'           => -1,
                        'totalPrizeMoney'          => -123,456.78,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'course_name'              => 'DUNDALK',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 103,
                        'racesItv'                 => 0,
                        'rp_position'              => 1,
                        'eveningMeeting'           => -1,
                        'totalPrizeMoney'          => -78,234.75,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'course_name'              => 'SHA TIN',
                        'course_type_code'         => 'F',
                        'rp_meeting_order'         => 104,
                        'racesItv'                 => 0,
                        'rp_position'              => 2,
                        'eveningMeeting'           => 0,
                        'totalPrizeMoney'          => -1,234,567.89,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ]
                ],
                [
                    (Object)[
                        'course_name'              => 'ASCOT',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 2,
                        'racesItv'                 => 0,
                        'rp_position'              => 1,
                        'eveningMeeting'           => -1,
                        'totalPrizeMoney'          => -98,765.43,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => 0
                    ],
                    (Object)[
                        'course_name'              => 'KEMPTON',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 4,
                        'racesItv'                 => 0,
                        'rp_position'              => 1,
                        'eveningMeeting'           => 1,
                        'totalPrizeMoney'          => -93,445.68,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'course_name'              => 'LINGFIELD',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 1,
                        'racesItv'                 => -1,
                        'rp_position'              => 1,
                        'eveningMeeting'           => -1,
                        'totalPrizeMoney'          => -123,456.78,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'course_name'              => 'DUNDALK',
                        'course_type_code'         => 'B',
                        'rp_meeting_order'         => 3,
                        'racesItv'                 => 0,
                        'rp_position'              => 1,
                        'eveningMeeting'           => -1,
                        'totalPrizeMoney'          => -78,234.75,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ],
                    (Object)[
                        'course_name'              => 'SHA TIN',
                        'course_type_code'         => 'F',
                        'rp_meeting_order'         => 5,
                        'racesItv'                 => 0,
                        'rp_position'              => 2,
                        'eveningMeeting'           => 0,
                        'totalPrizeMoney'          => -1,234,567.89,
                        'race_date'                => $today,
                        'containsNotFinishedRaces' => -1
                    ]
                ]
            ]
        ];
    }
}
