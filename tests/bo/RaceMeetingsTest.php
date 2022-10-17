<?php

namespace Tests;

use Phalcon\Exception;

class RaceMeetings extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\MeetingInfo $request
     * @param \Phalcon\Mvc\Model\Row\General | null $expectedResult
     *
     * @dataProvider providerTestGetMeetingInfo
     */
    public function testGetMeetingInfo(
        \Api\Input\Request\Horses\RaceMeetings\MeetingInfo $request,
        $expectedResult
    ) {
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($boMeetings->getMeetingInfo())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetMeetingInfo()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\MeetingInfo([15]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    "rp_admission_prices" => "Premier: £24.50. County: £20.50. Grandstand: £15.50. Family Enclosure: £7.00.",
                    "rp_parking" => "Free. (Premium public parking available in Car Park A - £5)\r\n",
                    "rp_children" => null,
                    "rp_disabled" => "Toilets, wheelchairs/blind plus carer, one entrance fee.",
                    "rp_flat_course_comment" => "left-handed, galloping track",
                    "rp_jump_course_comment" => "left-handed, galloping, flat track",
                    "course_stewards" => "Mr C. Warde-Aldam, Mrs D Powles",
                    "course_stewards_secs" => "(stipendiaries) Adie Smith, Robert Earnshaw, Sean McDonald.",
                    "course_starters" => "H Barclay, J Callaghan",
                    "course_judge" => "Miss Di Clark",
                    "course_scales_clerk" => "M Wright",
                    "course_clerk" => "Roderick Duncan",
                    "course_address" => "Doncaster Racecourse, Leger Way, Doncaster, DN2 6BB. Website: www.doncaster-racecourse.co.uk",
                    "course_tel" => "01302 304200",
                    "course_name" => "DONCASTER",
                    "course_type_code" => "B",
                    "country_code" => "GB ",
                    "course_directions" =>[
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "course_uid" => 15,
                            "direction_type_code" => "A",
                            "direction" => "Robin Hood Airport Doncaster Sheffield"

                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "course_uid" => 15,
                            "direction_type_code" => "R",
                            "direction" => "E of town, off the A638 (M18 Jctn 3 & 4, A1M Jct36)"

                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "course_uid" => 15,
                            "direction_type_code" => "T",
                            "direction" => "Doncaster Station (2.5 miles)."
                        ])
                    ]
                ])
            ],
            [
                new \Api\Input\Request\Horses\RaceMeetings\MeetingInfo([16]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    "rp_admission_prices" => "Premier: £24.50. County: £20.50. Grandstand: £15.50. Family Enclosure: £7.00.",
                    "rp_parking" => "Free. (Premium public parking available in Car Park A - £5)\r\n",
                    "rp_children" => null,
                    "rp_disabled" => "Toilets, wheelchairs/blind plus carer, one entrance fee.",
                    "rp_flat_course_comment" => "left-handed, galloping track",
                    "rp_jump_course_comment" => "left-handed, galloping, flat track",
                    "course_stewards" => "Mr C. Warde-Aldam, Mrs D Powles",
                    "course_stewards_secs" => "(stipendiaries) Adie Smith, Robert Earnshaw, Sean McDonald.",
                    "course_starters" => "H Barclay, J Callaghan",
                    "course_judge" => "Miss Di Clark",
                    "course_scales_clerk" => "M Wright",
                    "course_clerk" => "Roderick Duncan",
                    "course_address" => "Doncaster Racecourse, Leger Way, Doncaster, DN2 6BB. Website: www.doncaster-racecourse.co.uk",
                    "course_tel" => "01302 304200",
                    "course_name" => "DONCASTER",
                    "course_type_code" => "B",
                    "country_code" => "GB ",
                    "course_directions" => null
                ])
            ],
            [
                new \Api\Input\Request\Horses\RaceMeetings\MeetingInfo([17]),
                null
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\Favourites $request
     * @param                                                         $expectedResult
     *
     * @dataProvider providerTestGetFavourites
     */
    public function testGetFavourites(
        \Api\Input\Request\Horses\RaceMeetings\Favourites $request,
        $expectedResult
    ) {
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($boMeetings->getFavourites())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetFavourites()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\Favourites(
                    [
                        513,
                        2013,
                        2013,
                        'jumps'
                    ]
                ),
                array (
                    'handicap' => array (
                        'HURDLE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'CHASE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 2,
                            'runs' => 2,
                            'stake' => 2.875,
                        )),
                        'NHF' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'TOTAL' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 2,
                            'runs' => 2,
                            'stake' => 2.875,
                        )),
                    ),
                    'non_handicap' => array (
                        'HURDLE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 2,
                            'stake' => -2,
                        )),
                        'CHASE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'NHF' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'TOTAL' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 2,
                            'stake' => -2,
                        )),
                    ),
                ),
                new \Api\Input\Request\Horses\RaceMeetings\Favourites(
                    [
                        513,
                        2013,
                        2013,
                    ]
                ),
                array (
                    'handicap' => array (
                        'HURDLE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'CHASE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 2,
                            'runs' => 2,
                            'stake' => 2.875,
                        )),
                        'NHF' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'TOTAL' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 2,
                            'runs' => 2,
                            'stake' => 2.875,
                        )),
                    ),
                    'non_handicap' => array (
                        'HURDLE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 2,
                            'stake' => -2,
                        )),
                        'CHASE' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'NHF' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 0,
                            'stake' => 0,
                        )),
                        'TOTAL' => \Api\Row\RaceCards\Favourites::createFromArray(array(
                            'wins' => 0,
                            'runs' => 2,
                            'stake' => -2,
                        )),
                    ),
                )
            ],
        ];
    }


    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\RunnersIndex $request
     * @param \Phalcon\Mvc\Model\Row\General | null                     $expectedResult
     *
     * @dataProvider providerTestGetRunnersIndex
     */
    public function testGetRunnersIndex(
        \Api\Input\Request\Horses\RaceMeetings\RunnersIndex $request,
        $expectedResult
    ) {
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($boMeetings->getRunnersIndex())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetRunnersIndex()
    {

        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\RunnersIndex(['57', '2015-02-19']),
                [
                    "runners" => (Object)[
                        (Object)[

                            "group_name" => "runners",
                            "horse_name" => "Alzammaar",
                            "horse_uid" => 828580,
                            "position" => null,
                            "starting_price" => null,
                            "course_name" => "SEDGEFIELD",
                            "course_abbrev" => "SED",
                            "course_uid" => 57,
                            "race_datetime" => "Feb 19 2015  2:00PM",
                            "race_instance_uid" => 618109,
                            "race_status_code" => "4"
                        ],
                        (Object)[
                            "group_name" => "runners",
                            "horse_name" => "Ardesia",
                            "horse_uid" => 659714,
                            "position" => null,
                            "starting_price" => null,
                            "course_name" => "SEDGEFIELD",
                            "course_abbrev" => "SED",
                            "course_uid" => 57,
                            "race_datetime" => "Feb 19 2015  2:30PM",
                            "race_instance_uid" => 618110,
                            "race_status_code" => "4"
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 92152,
                            "group_name" => "Jordan Vaughan",
                            "rides" => 1,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -1
                        ],
                        (Object)[
                            "group_name" => "runners",
                            "horse_name" => "Aristo Du Plessis",
                            "horse_uid" => 847028,
                            "position" => null,
                            "starting_price" => null,
                            "course_name" => "SEDGEFIELD",
                            "course_abbrev" => "SED",
                            "course_uid" => 57,
                            "race_datetime" => "Feb 19 2015  2:00PM",
                            "race_instance_uid" => 618109,
                            "race_status_code" => "4"
                        ],
                        (Object)[
                            "group_name" => "runners",
                            "horse_name" => "Aristo Du Plessis",
                            "horse_uid" => 847028,
                            "position" => null,
                            "starting_price" => null,
                            "course_name" => "SEDGEFIELD",
                            "course_abbrev" => "SED",
                            "course_uid" => 57,
                            "race_datetime" => "Feb 19 2015  3:40PM",
                            "race_instance_uid" => 618112,
                            "race_status_code" => "4"
                        ]
                    ],
                    "non_runners" => (Object)[
                        (Object)[
                            "group_name" => "non_runners",
                            "horse_name" => "Mannered",
                            "horse_uid" => 746440,
                            "position" => null,
                            "starting_price" => null,
                            "course_name" => "SEDGEFIELD",
                            "course_abbrev" => "SED",
                            "course_uid" => 57,
                            "race_datetime" => "Feb 19 2015  3:05PM",
                            "race_instance_uid" => 618111,
                            "race_status_code" => "4"
                        ],
                    ]
                ],
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\Signposts $request
     * @param \Phalcon\Mvc\Model\Row\General | null $expectedResult
     *
     * @dataProvider providerTestGetSignposts
     */
    public function testGetSignposts(
        \Api\Input\Request\Horses\RaceMeetings\Signposts $request,
        $expectedResult
    ) {
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);
        $this->assertEquals($expectedResult, $boMeetings->getSignposts());
    }

    /**
     * @return array
     */
    public function providerTestGetSignposts()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\Signposts([73, '2015-02-17']),
                (Object)[
                    'travelers_check' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'horse_uid' => 751128,
                            'horse_style_name' => 'Madame Allsorts',
                            'race_datetime' => 'Feb 17 2015  2:10PM',
                            'trainer_style_name' => 'Willie Musson',
                            'course_uid' => 73,
                            'trainer_location' => 'Newmarket, Suffolk',
                            'miles' => 206,
                            'trainer_uid' => 516,
                            'horse_country_origin_code' => 'GB',
                            'course_country_code' => 'GB',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'horse_uid' => 854384,
                            'horse_style_name' => 'Glendermot',
                            'race_datetime' => 'Feb 17 2015  4:15PM',
                            'trainer_style_name' => 'Paul Cowley',
                            'course_uid' => 73,
                            'trainer_location' => 'Culworth, Northants',
                            'miles' => 134,
                            'trainer_uid' => 18773,
                            'horse_country_origin_code' => 'IRE',
                            'course_country_code' => 'GB',
                        ]),
                    ],
                    'first_time_blinkers' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'horse_style_name' => 'Bermuda Boy',
                            'horse_country_origin_code' => 'FR',
                            'horse_uid' => 693860,
                            'race_datetime' => 'Feb 17 2015  4:45PM',
                            'course_country_code' => 'GB',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'horse_style_name' => 'Canonicus',
                            'horse_country_origin_code' => 'GB',
                            'horse_uid' => 879717,
                            'race_datetime' => 'Feb 17 2015  5:20PM',
                            'course_country_code' => 'GB',
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'horse_style_name' => 'Lukes Hill',
                            'horse_country_origin_code' => 'IRE',
                            'horse_uid' => 827112,
                            'race_datetime' => 'Feb 17 2015  4:15PM',
                            'course_country_code' => 'GB',
                        ])
                    ],
                    'seven_day_winners' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'race_datetime' => 'Feb 17 2015  5:20PM',
                            'course_style_name' => 'Taunton',
                            'course_uid' => 73,
                            'race_instance_uid' => 618078,
                            'race_instance_title' => 'League of Friends of Taunton Hospitals Standard National Hunt Flat Race (Conditional And Amateur)',
                            'horse_style_name' => 'Persian Delight',
                            'horse_country_origin_code' => 'GB',
                            'horse_uid' => 876054,
                            'course_country_code' => 'GB',
                            'upcoming_race' => \Phalcon\Mvc\Model\Row\General::createFromArray([
                                'race_datetime' => 'Feb 19 2015  5:20PM',
                                'race_instance_uid' => 618234,
                                'horse_uid' => 876054,
                            ]),
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            'race_datetime' => 'Feb 17 2015  4:45PM',
                            'course_style_name' => 'Taunton',
                            'course_uid' => 73,
                            'race_instance_uid' => 618077,
                            'race_instance_title' => 'Pontispool Equine Sports Centre Foxhunter Trial (Open Hunters\' Chase for the Mitford-Slade)',
                            'horse_style_name' => 'Double Bank',
                            'horse_country_origin_code' => 'IRE',
                            'horse_uid' => 677681,
                            'course_country_code' => 'GB',
                            'upcoming_race' => null,
                        ]),
                    ]
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\Statistics $request
     * @param \Phalcon\Mvc\Model\Row\General | null $expectedResult
     * @dataProvider providerTestGetStatistics
     */
    public function testGetStatistics(
        \Api\Input\Request\Horses\RaceMeetings\Statistics $request,
        $expectedResult
    ) {
        $selectors = $request->getSelectors();
        $selectors->setDb(new \Tests\Stubs\Models\Bo\Selectors\Database());
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($boMeetings->getStatistics())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStatistics()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\Statistics([31, '2015-01-05', 'flat']),
                (Object)(array(
                    'top_jockeys' =>
                        array (
                            0 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'jockey_uid' => 90406,
                                'style_name' => 'Brendan Powell',
                                'wins' => 1,
                                'runs' => 5,
                                'stake' => '0.5',
                            )),
                            1 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'jockey_uid' => 86032,
                                'style_name' => 'Aidan Coleman',
                                'wins' => 1,
                                'runs' => 1,
                                'stake' => '4.5',
                            )),
                        ),
                    'top_trainers' =>
                        array (
                            0 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 7833,
                                'style_name' => 'Gary Moore',
                                'wins' => 6,
                                'runs' => 61,
                                'stake' => '-16.6250',
                            )),
                            1 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 11804,
                                'style_name' => 'Zoe Davison',
                                'wins' => 1,
                                'runs' => 26,
                                'stake' => '0.0',
                            )),
                            2 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 5106,
                                'style_name' => 'Bernard Llewellyn',
                                'wins' => 1,
                                'runs' => 6,
                                'stake' => '-0.5',
                            )),
                            3 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 17740,
                                'style_name' => 'Tim Vaughan',
                                'wins' => 1,
                                'runs' => 3,
                                'stake' => '0.5',
                            )),
                            4 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 19837,
                                'style_name' => 'Chris Gordon',
                                'wins' => 1,
                                'runs' => 3,
                                'stake' => '4.0',
                            )),
                            5 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 7118,
                                'style_name' => 'Linda Jewell',
                                'wins' => 0,
                                'runs' => 13,
                                'stake' => '-13.0',
                            )),
                            6 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 10890,
                                'style_name' => 'Mark Gillard',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )),
                            7 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 397,
                                'style_name' => 'Jonjo O\'Neill',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )),
                            8 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 7137,
                                'style_name' => 'Seamus Mullins',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )),
                            9 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 18639,
                                'style_name' => 'Anthony Honeyball',
                                'wins' => 0,
                                'runs' => 3,
                                'stake' => '-3.0',
                            )),
                            10 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 474,
                                'style_name' => 'Pam Sly',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            11 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 22097,
                                'style_name' => 'Tom Gretton',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            12 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 13116,
                                'style_name' => 'Emma Lavelle',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            13 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 20451,
                                'style_name' => 'Neil Mulholland',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            14 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'trainer_uid' => 22195,
                                'style_name' => 'Alison Batchelor',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                        ),
                    'top_owners' =>
                        array (
                            0 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 111866,
                                'style_name' => 'Heart Of The South Racing',
                                'wins' => 1,
                                'runs' => 12,
                                'stake' => '-9.5',
                            )),
                            1 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 123800,
                                'style_name' => 'Sussex Racing',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )),
                            2 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 165936,
                                'style_name' => 'Valence Racing',
                                'wins' => 0,
                                'runs' => 2,
                                'stake' => '-2.0',
                            )),
                            3 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 38565,
                                'style_name' => 'B W Parren',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            4 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 191236,
                                'style_name' => 'P B Moorhead',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            5 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 215151,
                                'style_name' => 'S P O\'Loughlin',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            6 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 119295,
                                'style_name' => 'The Secret Circle',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            7 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 53501,
                                'style_name' => 'Diamond Racing Ltd',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            8 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 87366,
                                'style_name' => 'Mrs Alison Batchelor',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                            9 => \Api\Row\RaceCards\Statistics::createFromArray(array(

                                'owner_uid' => 198056,
                                'style_name' => 'The Lump O\'Clock Syndicate',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )),
                        ),
                ))
            ],
        ];
    }


    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\StandardTimes $request
     * @param \Phalcon\Mvc\Model\Row\General | null $expectedResult
     *
     * @dataProvider providerTestGetStandardTimes
     */
    public function testGetStandardTimes(
        \Api\Input\Request\Horses\RaceMeetings\StandardTimes $request,
        $expectedResult
    ) {
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($boMeetings->getStandardTimes())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStandardTimes()
    {

        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\StandardTimes([15]),
                (Object)[
                    "flat_records" => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "race_type_code" => "F",
                            "straight_round_jubilee_code" => null,
                            "race_date" => "Sep 11 2009 12:00AM",
                            "horse_name" => "Sand Vixen",
                            "distance_yards" => 1100,
                            "time_secs" => 58.1,
                            "rp_ages_allowed_desc" => "2yo",
                            "no_of_fences" => null,
                            "average_time_sec" => 57.9
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "race_type_code" => "F",
                            "straight_round_jubilee_code" => null,
                            "race_date" => "Aug 14 2010 12:00AM",
                            "horse_name" => "Tabaret",
                            "distance_yards" => 1100,
                            "time_secs" => 57.31,
                            "rp_ages_allowed_desc" => "3yo+",
                            "no_of_fences" => null,
                            "average_time_sec" => 57.9
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "race_type_code" => "F",
                            "straight_round_jubilee_code" => null,
                            "race_date" => "Sep 13 2014 12:00AM",
                            "horse_name" => "Muthmir",
                            "distance_yards" => 1240,
                            "time_secs" => 65.38,
                            "rp_ages_allowed_desc" => "3yo+",
                            "no_of_fences" => null,
                            "average_time_sec" => 66.2
                        ]),
                    ],
                    "jumps_records" => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "race_type_code" => "C",
                            "straight_round_jubilee_code" => null,
                            "race_date" => "Jan 28 1989 12:00AM",
                            "horse_name" => "Itsgottabealright",
                            "distance_yards" => 3630,
                            "time_secs" => 231.9,
                            "rp_ages_allowed_desc" => "3yo+",
                            "no_of_fences" => 12,
                            "average_time_sec" => 238
                        ]),
                        \Phalcon\Mvc\Model\Row\General::createFromArray([
                            "race_type_code" => "H",
                            "straight_round_jubilee_code" => null,
                            "race_date" => "Feb 24 1993 12:00AM",
                            "horse_name" => "Good For A Loan",
                            "distance_yards" => 3630,
                            "time_secs" => 226.6,
                            "rp_ages_allowed_desc" => "3yo+",
                            "no_of_fences" => 8,
                            "average_time_sec" => 231
                        ]),
                    ]
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\NonRunners $request
     * @param \Phalcon\Mvc\Model\Row\General $expectedResult
     *
     * @dataProvider providerTestGetNonRunners
     */
    public function testGetNonRunners(\Api\Input\Request\Horses\RaceMeetings\NonRunners $request, $expectedResult)
    {
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($boMeetings->getNonRunners())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetNonRunners()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\NonRunners(['2016-07-04']),
                [
                    '813' => \Phalcon\Mvc\Model\Row\General::createFromArray([
                        'course_uid' =>  813,
                        'mixed_course_uid' => null,
                        'rp_abbrev_3' =>  'Kmb',
                        'course_name' =>  'KEMBLA GRANGE',
                        'course_style_name' => 'Kembla Grange',
                        'country_code' => 'AUS',
                        'pmd_going_desc' => 'TURF: GOOD (Watered)',
                        'md_going_desc' =>  'TURF: GOOD',
                        'stalls_position' =>  null,
                        'weather_cond' =>  null,
                        'races' =>  [
                            '654994' => \Phalcon\Mvc\Model\Row\General::createFromArray([
                                'race_datetime' =>  '2016-07-04T05:40:00+01:00',
                                'race_instance_uid' =>  654994,
                                'race_instance_title' =>  'Robinhood Rangehoods 2yo Maiden Handicap (Turf)',
                                'race_status_code' => 'R',
                                'horses' =>  [
                                    '1044671' => \Api\Row\Results\Horse::createFromArray([
                                        'rp_owner_choice' => 'a',
                                        'owner_uid' => 12345,
                                        'horse_uid' =>  1044671,
                                        'horse_name' =>  'STARE',
                                        'horse_style_name' =>  'Stare',
                                        'horse_country_origin_code' => "GB",
                                        'trainer_name' =>  'GAI WATERHOUSE',
                                        'trainer_uid' =>  10709,
                                        'trainer_style_name' =>  'Gai Waterhouse',
                                        'draw' =>  5,
                                        'race_number' =>  null,
                                    ]),
                                    '1044674' => \Api\Row\Results\Horse::createFromArray([
                                        'rp_owner_choice' => 'a',
                                        'owner_uid' => 12345,
                                        'horse_uid' =>  1044674,
                                        'horse_name' =>  'MONACO VILLE',
                                        'horse_style_name' =>  'Monaco Ville',
                                        'horse_country_origin_code' => "GB",
                                        'trainer_name' =>  'JOHN P THOMPSON',
                                        'trainer_uid' =>  15796,
                                        'trainer_style_name' =>  'John P Thompson',
                                        'draw' =>  6,
                                        'race_number' =>  null,
                                    ]),
                                    '1044675' => \Api\Row\Results\Horse::createFromArray([
                                        'rp_owner_choice' => 'a',
                                        'owner_uid' => 12345,
                                        'horse_uid' =>  1044675,
                                        'horse_name' =>  'MOOHARIBA',
                                        'horse_style_name' =>  'Moohariba',
                                        'horse_country_origin_code' => "GB",
                                        'trainer_name' =>  'MICHAEL, WAYNE & JOHN HAWKES',
                                        'trainer_uid' =>  21012,
                                        'trainer_style_name' =>  'Michael, Wayne & John Hawkes',
                                        'draw' =>  8,
                                        'race_number' =>  null,
                                    ]),
                                ]
                            ]),
                        ],
                        'race_status_code' => 'R'
                    ]),
                ],
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\SilksGen $request
     * @param \Phalcon\Mvc\Model\Row\General $expectedResult
     *
     * @dataProvider providerTestGetSilksGen
     */
    public function testGetSilksGen(\Api\Input\Request\Horses\RaceMeetings\SilksGen $request, $expectedResult)
    {
        $boMeetings = new \Tests\Stubs\Bo\RaceMeetings($request);

        $this->assertEquals(
            $expectedResult,
            $boMeetings->getSilksGen()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSilksGen()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceMeetings\SilksGen(['2016-12-10', '2016-12-15']),
                [
                    '8/2/2/240228.gif',
                    '4/6/4/242464.gif',
                    '0/5/6/231650.gif',
                    '5/2/6/226625.gif',
                    '5/4/9/113945.gif',
                    '5/5/8/191855.gif',
                    '9/4/6/171649.gif',
                    '9/5/1/222159.gif',
                    '2/5/7/85752.gif',
                    '8/5/2/35258.gif',
                    '9/9/9/45999.gif',
                    '0/4/4/233440.gif',
                    '4/5/9/122954.gif',
                    '6/0/1/171106.gif',
                    '8/5/4/245458.gif',
                    '3/0/7/217703.gif',
                    'b/3/0/217703b.gif',
                    '3/7/7/116773.gif',
                    '4/6/7/177764.gif',
                    '1/6/3/163361.gif',
                    '2/4/5/211542.gif',
                    '2/2/6/213622.gif',
                    '1/2/0/63021.gif',
                ],
            ],
            [
                new \Api\Input\Request\Horses\RaceMeetings\SilksGen(['2016-12-10', '2016-12-15'], ['type' => 'png']),
                [
                    '8/2/2/240228.png',
                    '4/6/4/242464.png',
                    '0/5/6/231650.png',
                    '5/2/6/226625.png',
                    '5/4/9/113945.png',
                    '5/5/8/191855.png',
                    '9/4/6/171649.png',
                    '9/5/1/222159.png',
                    '2/5/7/85752.png',
                    '8/5/2/35258.png',
                    '9/9/9/45999.png',
                    '0/4/4/233440.png',
                    '4/5/9/122954.png',
                    '6/0/1/171106.png',
                    '8/5/4/245458.png',
                    '3/0/7/217703.png',
                    'b/3/0/217703b.png',
                    '3/7/7/116773.png',
                    '4/6/7/177764.png',
                    '1/6/3/163361.png',
                    '2/4/5/211542.png',
                    '2/2/6/213622.png',
                    '1/2/0/63021.png',
                ],
            ]
        ];
    }
}
