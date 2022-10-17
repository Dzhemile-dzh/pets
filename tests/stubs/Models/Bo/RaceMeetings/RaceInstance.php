<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/26/2015
 * Time: 11:07 AM
 */

namespace Tests\Stubs\Models\Bo\RaceMeetings;

class RaceInstance extends \Tests\Stubs\Models\Course
{
    private static $data;

    public function getRunnersIndexByDate()
    {

        if (empty(self::$data)) {
            $this->init();
        }

        return self::$data[md5(serialize(func_get_args()))];
    }

    private function init()
    {
        self::$data =
            [
                '5d5048f0591cde7a5a3a4ca11dfd63bc' => [
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
            ];
    }

    public function getTravelersCheck($courseId, $raceDate)
    {
        $data = [
            '73,2015-02-17' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
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
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
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
                    ]
                ),
            ]
        ];

        return $data[$courseId . ',' . $raceDate];
    }

    /**
     * @param int    $courseId
     * @param string $raceDate
     *
     * @return array
     */
    public function getFirstTimeBlinkers($courseId, $raceDate)
    {
        $data = [
            '73,2015-02-17' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_style_name' => 'Bermuda Boy',
                        'horse_country_origin_code' => 'FR',
                        'horse_uid' => 693860,
                        'race_datetime' => 'Feb 17 2015  4:45PM',
                        'course_country_code' => 'GB',
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_style_name' => 'Canonicus',
                        'horse_country_origin_code' => 'GB',
                        'horse_uid' => 879717,
                        'race_datetime' => 'Feb 17 2015  5:20PM',
                        'course_country_code' => 'GB',
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_style_name' => 'Lukes Hill',
                        'horse_country_origin_code' => 'IRE',
                        'horse_uid' => 827112,
                        'race_datetime' => 'Feb 17 2015  4:15PM',
                        'course_country_code' => 'GB',
                    ]
                )
            ]
        ];

        return $data[$courseId . ',' . $raceDate];
    }

    /**
     * @param int    $courseId
     * @param string $raceDate
     *
     * @return array
     */
    public function getSevenDayWinners($courseId, $raceDate)
    {
        $data = [
            '73,2015-02-17' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'race_datetime' => 'Feb 17 2015  5:20PM',
                        'course_style_name' => 'Taunton',
                        'course_uid' => 73,
                        'race_instance_uid' => 618078,
                        'race_instance_title' => 'League of Friends of Taunton Hospitals Standard National Hunt Flat Race (Conditional And Amateur)',
                        'horse_style_name' => 'Persian Delight',
                        'horse_country_origin_code' => 'GB',
                        'horse_uid' => 876054,
                        'course_country_code' => 'GB',
                        'upcoming_race' => null,
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
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
                    ]
                ),
            ]
        ];

        return $data[$courseId . ',' . $raceDate];
    }

    public function getUpcomingRace(array $horseIds, $fromDate)
    {
        $key = implode('_', array_merge($horseIds, [$fromDate]));
        $rows = [
            '876054_677681_2015-02-17' => [
                '876054' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'race_datetime' => 'Feb 19 2015  5:20PM',
                        'race_instance_uid' => 618234,
                        'horse_uid' => 876054,
                    ]
                ),
            ]
        ];

        return isset($rows[$key]) ? $rows[$key] : null;
    }

    public function getStatisticsTopJockeys($request, $seasonBeg, $seasonEnd)
    {
        $arr = [
            31 => [
                '2015-01-05' => [
                    'flat' => array(
                        0 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'jockey_uid' => 90406,
                                'style_name' => 'Brendan Powell',
                                'wins' => 1,
                                'runs' => 5,
                                'stake' => '0.5',
                            )
                        ),
                        1 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'jockey_uid' => 86032,
                                'style_name' => 'Aidan Coleman',
                                'wins' => 1,
                                'runs' => 1,
                                'stake' => '4.5',
                            )
                        ),
                    )
                ]
            ]
        ];

        if (isset($arr[$request->getCourseId()][$request->getDate()][$request->getRaceType()])) {
            return $arr[$request->getCourseId()][$request->getDate()][$request->getRaceType()];
        }
    }

    public function getStatisticsTopOwners($request, $seasonBeg, $seasonEnd)
    {
        $arr = [
            31 => [
                '2015-01-05' => [
                    'flat' => array(
                        0 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 111866,
                                'style_name' => 'Heart Of The South Racing',
                                'wins' => 1,
                                'runs' => 12,
                                'stake' => '-9.5',
                            )
                        ),
                        1 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 123800,
                                'style_name' => 'Sussex Racing',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )
                        ),
                        2 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 165936,
                                'style_name' => 'Valence Racing',
                                'wins' => 0,
                                'runs' => 2,
                                'stake' => '-2.0',
                            )
                        ),
                        3 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 38565,
                                'style_name' => 'B W Parren',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        4 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 191236,
                                'style_name' => 'P B Moorhead',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        5 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 215151,
                                'style_name' => 'S P O\'Loughlin',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        6 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 119295,
                                'style_name' => 'The Secret Circle',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        7 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 53501,
                                'style_name' => 'Diamond Racing Ltd',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        8 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 87366,
                                'style_name' => 'Mrs Alison Batchelor',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        9 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'owner_uid' => 198056,
                                'style_name' => 'The Lump O\'Clock Syndicate',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                    )
                ]
            ]
        ];

        if (isset($arr[$request->getCourseId()][$request->getDate()][$request->getRaceType()])) {
            return $arr[$request->getCourseId()][$request->getDate()][$request->getRaceType()];
        }
    }

    public function getStatisticsTopTrainers($request, $seasonBeg, $seasonEnd)
    {
        $arr = [
            31 => [
                '2015-01-05' => [
                    'flat' => array(
                        0 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 7833,
                                'style_name' => 'Gary Moore',
                                'wins' => 6,
                                'runs' => 61,
                                'stake' => '-16.6250',
                            )
                        ),
                        1 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 11804,
                                'style_name' => 'Zoe Davison',
                                'wins' => 1,
                                'runs' => 26,
                                'stake' => '0.0',
                            )
                        ),
                        2 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 5106,
                                'style_name' => 'Bernard Llewellyn',
                                'wins' => 1,
                                'runs' => 6,
                                'stake' => '-0.5',
                            )
                        ),
                        3 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 17740,
                                'style_name' => 'Tim Vaughan',
                                'wins' => 1,
                                'runs' => 3,
                                'stake' => '0.5',
                            )
                        ),
                        4 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 19837,
                                'style_name' => 'Chris Gordon',
                                'wins' => 1,
                                'runs' => 3,
                                'stake' => '4.0',
                            )
                        ),
                        5 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 7118,
                                'style_name' => 'Linda Jewell',
                                'wins' => 0,
                                'runs' => 13,
                                'stake' => '-13.0',
                            )
                        ),
                        6 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 10890,
                                'style_name' => 'Mark Gillard',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )
                        ),
                        7 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 397,
                                'style_name' => 'Jonjo O\'Neill',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )
                        ),
                        8 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 7137,
                                'style_name' => 'Seamus Mullins',
                                'wins' => 0,
                                'runs' => 4,
                                'stake' => '-4.0',
                            )
                        ),
                        9 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 18639,
                                'style_name' => 'Anthony Honeyball',
                                'wins' => 0,
                                'runs' => 3,
                                'stake' => '-3.0',
                            )
                        ),
                        10 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 474,
                                'style_name' => 'Pam Sly',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        11 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 22097,
                                'style_name' => 'Tom Gretton',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        12 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 13116,
                                'style_name' => 'Emma Lavelle',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        13 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 20451,
                                'style_name' => 'Neil Mulholland',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                        14 => \Api\Row\RaceCards\Statistics::createFromArray(
                            array(
                                'trainer_uid' => 22195,
                                'style_name' => 'Alison Batchelor',
                                'wins' => 0,
                                'runs' => 1,
                                'stake' => '-1.0',
                            )
                        ),
                    )
                ]
            ]
        ];

        if (isset($arr[$request->getCourseId()][$request->getDate()][$request->getRaceType()])) {
            return $arr[$request->getCourseId()][$request->getDate()][$request->getRaceType()];
        }
    }

    public function getRunners($request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'course_uid' => 813,
                'mixed_course_uid' => null,
                'rp_abbrev_3' => "Kmb",
                'course_name' => "KEMBLA GRANGE",
                'course_style_name' => 'Kembla Grange',
                'country_code' => 'AUS',
                'stalls_position' => null,
                'weather_cond' => null,
                'race_datetime' => '2016-07-04T05:40:00+01:00',
                'race_instance_uid' => 654994,
                'race_instance_title' => "Robinhood Rangehoods 2yo Maiden Handicap (Turf)",
                'horse_uid' => 1044671,
                'horse_name' => "STARE",
                'horse_style_name' => "Stare",
                'horse_country_origin_code' => "GB",
                'non_runner' => 'Y',
                'trainer_name' => "GAI WATERHOUSE",
                'trainer_uid' => 10709,
                'trainer_style_name' => "Gai Waterhouse",
                'draw' => 5,
                'race_number' => null,
                'race_status_code' => "R",
                'md_going_desc' => "TURF: GOOD",
                'pmd_going_desc' => "TURF: GOOD (Watered)",
                'rp_owner_choice' => 'a',
                'owner_uid' => 12345
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'course_uid' => 813,
                'mixed_course_uid' => null,
                'rp_abbrev_3' => "Kmb",
                'course_name' => "KEMBLA GRANGE",
                'course_style_name' => 'Kembla Grange',
                'country_code' => 'AUS',
                'stalls_position' => null,
                'weather_cond' => null,
                'race_datetime' => '2016-07-04T05:40:00+01:00',
                'race_instance_uid' => 654994,
                'race_instance_title' => "Robinhood Rangehoods 2yo Maiden Handicap (Turf)",
                'horse_uid' => 1044674,
                'horse_name' => "MONACO VILLE",
                'horse_style_name' => "Monaco Ville",
                'horse_country_origin_code' => "GB",
                'non_runner' => 'Y',
                'trainer_name' => "JOHN P THOMPSON",
                'trainer_uid' => 15796,
                'trainer_style_name' => "John P Thompson",
                'draw' => 6,
                'race_number' => null,
                'race_status_code' => "R",
                'md_going_desc' => "TURF: GOOD",
                'pmd_going_desc' => "TURF: GOOD (Watered)",
                'rp_owner_choice' => 'a',
                'owner_uid' => 12345
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'course_uid' => 813,
                'mixed_course_uid' => null,
                'rp_abbrev_3' => "Kmb",
                'course_name' => "KEMBLA GRANGE",
                'course_style_name' => 'Kembla Grange',
                'country_code' => 'AUS',
                'stalls_position' => null,
                'weather_cond' => null,
                'race_datetime' => '2016-07-04T05:40:00+01:00',
                'race_instance_uid' => 654994,
                'race_instance_title' => "Robinhood Rangehoods 2yo Maiden Handicap (Turf)",
                'horse_uid' => 1044675,
                'horse_name' => "MOOHARIBA",
                'horse_style_name' => "Moohariba",
                'horse_country_origin_code' => "GB",
                'non_runner' => 'Y',
                'trainer_name' => "MICHAEL, WAYNE & JOHN HAWKES",
                'trainer_uid' => 21012,
                'trainer_style_name' => "Michael, Wayne & John Hawkes",
                'draw' => 8,
                'race_number' => null,
                'race_status_code' => "R",
                'md_going_desc' => "TURF: GOOD",
                'pmd_going_desc' => "TURF: GOOD (Watered)",
                'rp_owner_choice' => 'a',
                'owner_uid' => 12345
            ]),
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\NonRunners $request
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getNonRunners(\Api\Input\Request\Horses\RaceMeetings\NonRunners $request)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'course_uid' => 813,
                'mixed_course_uid' => null,
                'rp_abbrev_3' => "Kmb",
                'course_name' => "KEMBLA GRANGE",
                'course_style_name' => 'Kembla Grange',
                'country_code' => 'AUS',
                'stalls_position' => null,
                'weather_cond' => null,
                'race_datetime' => '2016-07-04T05:40:00+01:00',
                'race_instance_uid' => 654994,
                'race_instance_title' => "Robinhood Rangehoods 2yo Maiden Handicap (Turf)",
                'horse_uid' => 1044671,
                'horse_name' => "STARE",
                'horse_style_name' => "Stare",
                'horse_country_origin_code' => "GB",
                'trainer_name' => "GAI WATERHOUSE",
                'trainer_uid' => 10709,
                'trainer_style_name' => "Gai Waterhouse",
                'draw' => 5,
                'race_number' => null,
                'race_status_code' => "R",
                'md_going_desc' => "TURF: GOOD",
                'pmd_going_desc' => "TURF: GOOD (Watered)",
                'rp_owner_choice' => 'a',
                'owner_uid' => 23494
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'course_uid' => 813,
                'mixed_course_uid' => null,
                'rp_abbrev_3' => "Kmb",
                'course_name' => "KEMBLA GRANGE",
                'course_style_name' => 'Kembla Grange',
                'country_code' => 'AUS',
                'stalls_position' => null,
                'weather_cond' => null,
                'race_datetime' => '2016-07-04T05:40:00+01:00',
                'race_instance_uid' => 654994,
                'race_instance_title' => "Robinhood Rangehoods 2yo Maiden Handicap (Turf)",
                'horse_uid' => 1044674,
                'horse_name' => "MONACO VILLE",
                'horse_style_name' => "Monaco Ville",
                'horse_country_origin_code' => "GB",
                'trainer_name' => "JOHN P THOMPSON",
                'trainer_uid' => 15796,
                'trainer_style_name' => "John P Thompson",
                'draw' => 6,
                'race_number' => null,
                'race_status_code' => "R",
                'md_going_desc' => "TURF: GOOD",
                'pmd_going_desc' => "TURF: GOOD (Watered)",
                'rp_owner_choice' => 'a',
                'owner_uid' => 23429
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'course_uid' => 813,
                'mixed_course_uid' => null,
                'rp_abbrev_3' => "Kmb",
                'course_name' => "KEMBLA GRANGE",
                'course_style_name' => 'Kembla Grange',
                'country_code' => 'AUS',
                'stalls_position' => null,
                'weather_cond' => null,
                'race_datetime' => '2016-07-04T05:40:00+01:00',
                'race_instance_uid' => 654994,
                'race_instance_title' => "Robinhood Rangehoods 2yo Maiden Handicap (Turf)",
                'horse_uid' => 1044675,
                'horse_name' => "MOOHARIBA",
                'horse_style_name' => "Moohariba",
                'horse_country_origin_code' => "GB",
                'trainer_name' => "MICHAEL, WAYNE & JOHN HAWKES",
                'trainer_uid' => 21012,
                'trainer_style_name' => "Michael, Wayne & John Hawkes",
                'draw' => 8,
                'race_number' => null,
                'race_status_code' => "R",
                'md_going_desc' => "TURF: GOOD",
                'pmd_going_desc' => "TURF: GOOD (Watered)",
                'rp_owner_choice' => 'a',
                'owner_uid' => 23424
            ]),
        ];
    }
}
