<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/04/2016
 * Time: 2:15 PM
 */
namespace Tests\Stubs\DataProvider\Bo\RaceCards;

class TopDraw extends \Api\DataProvider\Bo\RaceCards\TopDraw
{
    // a key used for identify a needed portion of a stab data
    private $key = 0;

    /**
     * @return int
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $key
     *
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param int $raceId
     *
     * @return \Api\Row\RaceInstance
     *
     * @codeCoverageIgnore
     */
    public function getRaceInfo($raceId)
    {
        $data = [
            100001 => null,
            100002 => \Phalcon\Mvc\Model\Row\General::createFromArray([]),
            200001 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'zenithOfficial' => 90.833333330000002,
                        'course_uid' => 1079,
                        'course_name' => 'KEMPTON (A.W)',
                        'country_code' => 'GB',
                        'season_10_year' => 'Jan  1 2007 12:01AM',
                        'pre_race_datetime' => 'Jan 11 2017  4:45PM',
                        'pre_distance_yard' => 1540,
                        'pre_direction' => 'R',
                        'srj' => ' ',
                        'srj_desc' => ' ',
                        'race_type_code' => 'X',
                        'pre_stalls_pos' => 'L',
                        'race_group_uid' => 6,
                        'pre_race_instance_uid' => 665827,
                        'pre_going_band_uid' => 4,
                        'going_type_code' => 'SS',
                        'pre_going_type_value' => 8,
                        'pre_safety_factor_number' => 14,
                        'no_of_runners' => 14,
                    )
                ),
            200002 =>
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    array(
                        'zenithOfficial' => 90.833333330000002,
                        'course_uid' => 1079,
                        'course_name' => 'ASCOT',
                        'country_code' => 'IRE',
                        'season_10_year' => 'Jan  1 2007 12:01AM',
                        'pre_race_datetime' => 'Jan 11 2017  4:45PM',
                        'pre_distance_yard' => 2639,
                        'pre_direction' => 'R',
                        'srj' => ' ',
                        'srj_desc' => ' ',
                        'race_type_code' => 'X',
                        'pre_stalls_pos' => 'L',
                        'race_group_uid' => 6,
                        'pre_race_instance_uid' => 665827,
                        'pre_going_band_uid' => 4,
                        'going_type_code' => 'SS',
                        'pre_going_type_value' => 8,
                        'pre_safety_factor_number' => 14,
                        'no_of_runners' => 14,
                    )
                ),

        ];

        return $data[$this->getKey()];
    }

    /**
     * Get actual stalls positions
     *
     * @return array
     */
    public function getActualStallsPositions()
    {
        $data = require 'source/TopDraw/getActualStallsPositions.php';

        return $data[$this->getKey()];
    }

    /**
     * Gets last years races
     *
     * @return array
     */
    public function getLastYearsRaces()
    {
        $data = [
            100001 => false,
            100002 => false,
            200001 =>
                array(
                    0 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 665381,
                                'race_datetime' => 'Jan  5 2017  8:15PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    1 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 664040,
                                'race_datetime' => 'Dec 22 2016  2:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    2 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 664014,
                                'race_datetime' => 'Dec 19 2016  3:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    3 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 664008,
                                'race_datetime' => 'Dec 19 2016  3:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    4 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 663702,
                                'race_datetime' => 'Dec 15 2016  5:15PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    5 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 663193,
                                'race_datetime' => 'Dec  8 2016  5:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 14,
                            )
                        ),
                    6 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 663191,
                                'race_datetime' => 'Dec  8 2016  4:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 15,
                            )
                        ),
                    7 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 662163,
                                'race_datetime' => 'Nov 21 2016  5:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 15,
                            )
                        ),
                    8 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 662165,
                                'race_datetime' => 'Nov 21 2016  2:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 4,
                            )
                        ),
                    9 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661694,
                                'race_datetime' => 'Nov 17 2016  7:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    10 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661691,
                                'race_datetime' => 'Nov 17 2016  6:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    11 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661165,
                                'race_datetime' => 'Nov 10 2016  7:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 14,
                            )
                        ),
                    12 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661168,
                                'race_datetime' => 'Nov 10 2016  4:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    13 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660706,
                                'race_datetime' => 'Nov  5 2016  7:55PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    14 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660687,
                                'race_datetime' => 'Nov  3 2016  7:30PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    15 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660213,
                                'race_datetime' => 'Oct 29 2016  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    16 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660212,
                                'race_datetime' => 'Oct 29 2016  5:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    17 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661951,
                                'race_datetime' => 'Oct 27 2016  9:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    18 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660196,
                                'race_datetime' => 'Oct 27 2016  8:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    19 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659756,
                                'race_datetime' => 'Oct 22 2016  7:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 15,
                            )
                        ),
                    20 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659744,
                                'race_datetime' => 'Oct 20 2016  7:15PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    21 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659326,
                                'race_datetime' => 'Oct 13 2016  7:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    22 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659310,
                                'race_datetime' => 'Oct 10 2016  6:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    23 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 657711,
                                'race_datetime' => 'Sep 15 2016  7:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    24 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 657268,
                                'race_datetime' => 'Sep 11 2016  4:35PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    25 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 656346,
                                'race_datetime' => 'Aug 23 2016  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    26 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 655348,
                                'race_datetime' => 'Aug  7 2016  3:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    27 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 654306,
                                'race_datetime' => 'Jul 19 2016  6:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    28 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 652226,
                                'race_datetime' => 'May 26 2016  5:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    29 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 650016,
                                'race_datetime' => 'May 26 2016  4:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    30 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 647637,
                                'race_datetime' => 'Apr 25 2016  2:30PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    31 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 645467,
                                'race_datetime' => 'Mar 31 2016  8:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    32 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 644236,
                                'race_datetime' => 'Mar 11 2016  8:45PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    33 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 643814,
                                'race_datetime' => 'Mar  3 2016  8:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    34 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 643099,
                                'race_datetime' => 'Feb 18 2016  5:35PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    35 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 642406,
                                'race_datetime' => 'Feb  4 2016  8:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    36 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641950,
                                'race_datetime' => 'Jan 28 2016  5:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 5,
                            )
                        ),
                    37 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641563,
                                'race_datetime' => 'Jan 24 2016  1:45PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    38 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641533,
                                'race_datetime' => 'Jan 21 2016  7:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    39 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641457,
                                'race_datetime' => 'Jan 14 2016  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    40 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641455,
                                'race_datetime' => 'Jan 14 2016  5:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    41 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641355,
                                'race_datetime' => 'Jan  7 2016  8:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    42 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641126,
                                'race_datetime' => 'Jan  7 2016  7:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    43 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641106,
                                'race_datetime' => 'Jan  6 2016  3:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    44 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 640582,
                                'race_datetime' => 'Dec 21 2015  2:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    45 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 639551,
                                'race_datetime' => 'Dec 17 2015  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    46 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 639157,
                                'race_datetime' => 'Dec 10 2015  7:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    47 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 639151,
                                'race_datetime' => 'Dec 10 2015  4:05PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    48 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 638159,
                                'race_datetime' => 'Nov 23 2015  4:05PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    49 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 638156,
                                'race_datetime' => 'Nov 23 2015  2:35PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 4,
                            )
                        ),
                    50 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 637691,
                                'race_datetime' => 'Nov 19 2015  6:05PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    51 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 637214,
                                'race_datetime' => 'Nov 12 2015  7:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    52 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 637209,
                                'race_datetime' => 'Nov 12 2015  4:55PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                ),
            200002 =>
                array(
                    0 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 665381,
                                'race_datetime' => 'Jan  5 2017  8:15PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    1 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 664040,
                                'race_datetime' => 'Dec 22 2016  2:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    2 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 664014,
                                'race_datetime' => 'Dec 19 2016  3:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    3 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 664008,
                                'race_datetime' => 'Dec 19 2016  3:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    4 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 663702,
                                'race_datetime' => 'Dec 15 2016  5:15PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    5 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 663193,
                                'race_datetime' => 'Dec  8 2016  5:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 14,
                            )
                        ),
                    6 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 663191,
                                'race_datetime' => 'Dec  8 2016  4:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 15,
                            )
                        ),
                    7 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 662163,
                                'race_datetime' => 'Nov 21 2016  5:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 15,
                            )
                        ),
                    8 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 662165,
                                'race_datetime' => 'Nov 21 2016  2:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 4,
                            )
                        ),
                    9 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661694,
                                'race_datetime' => 'Nov 17 2016  7:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    10 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661691,
                                'race_datetime' => 'Nov 17 2016  6:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    11 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661165,
                                'race_datetime' => 'Nov 10 2016  7:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 14,
                            )
                        ),
                    12 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661168,
                                'race_datetime' => 'Nov 10 2016  4:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    13 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660706,
                                'race_datetime' => 'Nov  5 2016  7:55PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    14 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660687,
                                'race_datetime' => 'Nov  3 2016  7:30PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    15 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660213,
                                'race_datetime' => 'Oct 29 2016  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    16 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660212,
                                'race_datetime' => 'Oct 29 2016  5:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    17 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 661951,
                                'race_datetime' => 'Oct 27 2016  9:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    18 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 660196,
                                'race_datetime' => 'Oct 27 2016  8:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    19 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659756,
                                'race_datetime' => 'Oct 22 2016  7:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 15,
                            )
                        ),
                    20 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659744,
                                'race_datetime' => 'Oct 20 2016  7:15PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    21 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659326,
                                'race_datetime' => 'Oct 13 2016  7:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    22 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 659310,
                                'race_datetime' => 'Oct 10 2016  6:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    23 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 657711,
                                'race_datetime' => 'Sep 15 2016  7:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    24 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 657268,
                                'race_datetime' => 'Sep 11 2016  4:35PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    25 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 656346,
                                'race_datetime' => 'Aug 23 2016  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    26 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 655348,
                                'race_datetime' => 'Aug  7 2016  3:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    27 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 654306,
                                'race_datetime' => 'Jul 19 2016  6:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    28 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 652226,
                                'race_datetime' => 'May 26 2016  5:20PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    29 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 650016,
                                'race_datetime' => 'May 26 2016  4:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    30 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 647637,
                                'race_datetime' => 'Apr 25 2016  2:30PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    31 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 645467,
                                'race_datetime' => 'Mar 31 2016  8:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    32 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 644236,
                                'race_datetime' => 'Mar 11 2016  8:45PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    33 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 643814,
                                'race_datetime' => 'Mar  3 2016  8:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    34 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 643099,
                                'race_datetime' => 'Feb 18 2016  5:35PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    35 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 642406,
                                'race_datetime' => 'Feb  4 2016  8:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 12,
                            )
                        ),
                    36 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641950,
                                'race_datetime' => 'Jan 28 2016  5:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 5,
                            )
                        ),
                    37 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641563,
                                'race_datetime' => 'Jan 24 2016  1:45PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    38 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641533,
                                'race_datetime' => 'Jan 21 2016  7:40PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    39 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641457,
                                'race_datetime' => 'Jan 14 2016  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    40 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641455,
                                'race_datetime' => 'Jan 14 2016  5:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    41 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641355,
                                'race_datetime' => 'Jan  7 2016  8:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    42 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641126,
                                'race_datetime' => 'Jan  7 2016  7:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    43 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 641106,
                                'race_datetime' => 'Jan  6 2016  3:00PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 8,
                            )
                        ),
                    44 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 640582,
                                'race_datetime' => 'Dec 21 2015  2:50PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 7,
                            )
                        ),
                    45 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 639551,
                                'race_datetime' => 'Dec 17 2015  6:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 9,
                            )
                        ),
                    46 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 639157,
                                'race_datetime' => 'Dec 10 2015  7:10PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    47 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 639151,
                                'race_datetime' => 'Dec 10 2015  4:05PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 10,
                            )
                        ),
                    48 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 638159,
                                'race_datetime' => 'Nov 23 2015  4:05PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                    49 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 638156,
                                'race_datetime' => 'Nov 23 2015  2:35PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 4,
                            )
                        ),
                    50 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 637691,
                                'race_datetime' => 'Nov 19 2015  6:05PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    51 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 637214,
                                'race_datetime' => 'Nov 12 2015  7:25PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 11,
                            )
                        ),
                    52 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 637209,
                                'race_datetime' => 'Nov 12 2015  4:55PM',
                                'safety_factor_number' => 16,
                                'rp_stalls_position' => 'L',
                                'ran' => 13,
                            )
                        ),
                ),
        ];

        return $data[$this->getKey()];
    }

    /**
     * Get runners
     *
     * @return array
     */
    public function getRunners()
    {
        $data = require 'source/TopDraw/getRunners.php';

        return $data[$this->getKey()];
    }

    /**
     * Creates tmp tables with last years races
     *
     * @param $raceInfo
     *
     * @return bool
     */

    public function crateLastYearsRaces($raceInfo)
    {
        return isset($raceInfo->course_uid);
    }

    /**
     * Check and drop tmp table in DB
     *
     * @param string $tableName
     *
     * @return bool
     */

    public function dropTmpTable($tableName)
    {
        return true;
    }

    /**
     * Drop all temporary tables used by this response
     */
    public function dropTmpTables()
    {
        return true;
    }
}
