<?php

namespace Tests\Stubs\DataProvider\Bo\RaceCards;

use Api\Row\RaceInstance as RiRow;
use Phalcon\Mvc\Model\Row\General as GeneralRow;

/**
 * Class RaceWFA
 *
 * @package Tests\Stubs\DataProvider\Bo\RaceCards
 */
class RaceWFA extends \Api\DataProvider\Bo\RaceCards\RaceWFA
{
    // a key used for identify a needed portion of a stab data
    private $key = 0;

    /**
     * @return int
     */
    private function getKey()
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
     * @return \Api\Row\RaceInstance|boolean
     *
     * @codeCoverageIgnore
     */
    public function getRaceInfo($raceId)
    {
        $data = [
            100001 => false,
            100002 => RiRow::createFromArray([
                'race_type_code' => 'C',
                'race_datetime' => 'Feb  4 2018  1:15PM',
                'race_status_code' => 'O',
                'distance_yard' => 4472,
                'going_type_code' => 'HY',
            ]),
            100003 => RiRow::createFromArray([
                'race_type_code' => 'C',
                'race_datetime' => 'Feb  24 2018  1:15PM',
                'race_status_code' => '4',
                'distance_yard' => 4472,
                'going_type_code' => 'HY',
            ]),
            100004 => RiRow::createFromArray([
                'race_type_code' => 'Y',
                'race_datetime' => 'Feb  24 2018  1:15PM',
                'race_status_code' => '6',
                'distance_yard' => 4472,
                'going_type_code' => 'HY',
            ]),
            643539 => false,

            200001 => RiRow::createFromArray([
                'race_type_code' => 'X',
                'race_datetime' => 'Jan  4 2018  1:30PM',
                'race_status_code' => 'O',
                'distance_yard' => 3576,
                'going_type_code' => 'SD',
            ]),
            200002 => RiRow::createFromArray([
                'race_type_code' => 'C',
                'race_datetime' => 'Jan  7 2018  1:20PM',
                'race_status_code' => '4',
                'distance_yard' => 3595,
                'going_type_code' => 'S',
            ]),
        ];

        return $data[$this->getKey()];
    }

    /**
     * @param $raceId       int
     * @param $raceStatus   string
     * @param $raceDateTime string
     *
     * @return \Api\Row\RaceInstance|boolean
     *
     * @codeCoverageIgnore
     */
    public function getTopStats($raceId, $raceStatus, $raceDateTime)
    {
        $data = [
            100002 => RiRow::createFromArray([
                'max_age' => 10,
                'min_age' => 6,
                'top_age' => 7,
            ]),
            100003 => RiRow::createFromArray([
                'max_age' => 8,
                'min_age' => 3,
                'top_age' => 3,
            ]),
            100004 => false,
            200001 => RiRow::createFromArray([
                'max_age' => 13,
                'min_age' => 4,
                'top_age' => 7,
            ]),
            200002 => RiRow::createFromArray([
                'max_age' => 13,
                'min_age' => 5,
                'top_age' => 6,
            ]),
        ];

        return $data[$this->getKey()];
    }

    /**
     * Gets weight allowances and ages for a flat race
     *
     * @param object $race
     * @param int    $raceMonth
     * @param int    $raceMonthHalf
     *
     * @return array
     *
     */
    public function getWfAgesFlat($race, $raceMonth, $raceMonthHalf)
    {
        $data = [
            200001 => [
                4 =>
                    [
                        0 =>
                            GeneralRow::createFromArray([
                                'age' => 4,
                                'wfa' => 5,
                                'race_type_code' => null,
                            ]),
                    ],
            ]
        ];

        return $data[$this->getKey()];
    }

    /**
     * Gets weight allowances and ages for a jumps race
     *
     * @param object $race
     * @param int    $raceMonth
     *
     * @return array
     */
    public function getWfAgesJumps($race, $raceMonth)
    {
        $data = [
            100002 => [],
            200001 => [],
            200002 => [
                5 =>
                    [
                        0 =>
                            GeneralRow::createFromArray([
                                'age' => 5,
                                'wfa' => 3,
                                'race_type_code' => 'C',
                            ]),
                    ],
            ]
        ];

        return $data[$this->getKey()];
    }

    /**
     * @param int    $raceId
     * @param string $raceStatus
     * @param string $raceDateTime
     * @param string $raceType
     * @param int    $topAge
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function getRaceHorses(int $raceId, string $raceStatus, string $raceDateTime, string $raceType, int $topAge)
    {
        $data = [
            100002 => [
                0 =>
                    RiRow::createFromArray([
                        'horse_uid' => 974126,
                        'adjusted_age' => 6,
                        'age' => 6,
                        'weight_carried_lbs' => 146,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                1 =>
                    RiRow::createFromArray([
                        'horse_uid' => 963866,
                        'adjusted_age' => 6,
                        'age' => 7,
                        'weight_carried_lbs' => 160,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                2 =>
                    RiRow::createFromArray([
                        'horse_uid' => 987728,
                        'adjusted_age' => 6,
                        'age' => 7,
                        'weight_carried_lbs' => 140,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                3 =>
                    RiRow::createFromArray([
                        'horse_uid' => 904033,
                        'adjusted_age' => 6,
                        'age' => 7,
                        'weight_carried_lbs' => 150,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                4 =>
                    RiRow::createFromArray([
                        'horse_uid' => 879216,
                        'adjusted_age' => 6,
                        'age' => 7,
                        'weight_carried_lbs' => 166,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                5 =>
                    RiRow::createFromArray([
                        'horse_uid' => 905151,
                        'adjusted_age' => 6,
                        'age' => 7,
                        'weight_carried_lbs' => 151,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                6 =>
                    RiRow::createFromArray([
                        'horse_uid' => 959207,
                        'adjusted_age' => 6,
                        'age' => 7,
                        'weight_carried_lbs' => 163,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                7 =>
                    RiRow::createFromArray([
                        'horse_uid' => 858410,
                        'adjusted_age' => 6,
                        'age' => 9,
                        'weight_carried_lbs' => 162,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                8 =>
                    RiRow::createFromArray([
                        'horse_uid' => 824610,
                        'adjusted_age' => 6,
                        'age' => 10,
                        'weight_carried_lbs' => 151,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
            ],
            100003 => [],
            200001 => [
                0 =>
                    RiRow::createFromArray([
                        'horse_uid' => 1325368,
                        'adjusted_age' => 4,
                        'age' => 4,
                        'weight_carried_lbs' => 120,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                1 =>
                    RiRow::createFromArray([
                        'horse_uid' => 1452957,
                        'adjusted_age' => 4,
                        'age' => 4,
                        'weight_carried_lbs' => 120,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                2 =>
                    RiRow::createFromArray([
                        'horse_uid' => 1296073,
                        'adjusted_age' => 4,
                        'age' => 4,
                        'weight_carried_lbs' => 118,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                3 =>
                    RiRow::createFromArray([
                        'horse_uid' => 898071,
                        'adjusted_age' => 5,
                        'age' => 5,
                        'weight_carried_lbs' => 121,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                4 =>
                    RiRow::createFromArray([
                        'horse_uid' => 901918,
                        'adjusted_age' => 5,
                        'age' => 5,
                        'weight_carried_lbs' => 133,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                5 =>
                    RiRow::createFromArray([
                        'horse_uid' => 864075,
                        'adjusted_age' => 5,
                        'age' => 6,
                        'weight_carried_lbs' => 119,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                6 =>
                    RiRow::createFromArray([
                        'horse_uid' => 1031294,
                        'adjusted_age' => 5,
                        'age' => 6,
                        'weight_carried_lbs' => 130,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                7 =>
                    RiRow::createFromArray([
                        'horse_uid' => 900235,
                        'adjusted_age' => 5,
                        'age' => 6,
                        'weight_carried_lbs' => 130,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                8 =>
                    RiRow::createFromArray([
                        'horse_uid' => 843006,
                        'adjusted_age' => 5,
                        'age' => 7,
                        'weight_carried_lbs' => 136,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                9 =>
                    RiRow::createFromArray([
                        'horse_uid' => 823021,
                        'adjusted_age' => 5,
                        'age' => 8,
                        'weight_carried_lbs' => 125,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                10 =>
                    RiRow::createFromArray([
                        'horse_uid' => 753294,
                        'adjusted_age' => 5,
                        'age' => 10,
                        'weight_carried_lbs' => 119,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                11 =>
                    RiRow::createFromArray([
                        'horse_uid' => 720229,
                        'adjusted_age' => 5,
                        'age' => 13,
                        'weight_carried_lbs' => 119,
                        'wfage' => 4,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
            ],
            200002 => [
                0 =>
                    RiRow::createFromArray([
                        'horse_uid' => 1659619,
                        'adjusted_age' => 5,
                        'age' => 5,
                        'weight_carried_lbs' => 143,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                1 =>
                    RiRow::createFromArray([
                        'horse_uid' => 1024277,
                        'adjusted_age' => 6,
                        'age' => 6,
                        'weight_carried_lbs' => 147,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                2 =>
                    RiRow::createFromArray([
                        'horse_uid' => 891470,
                        'adjusted_age' => 6,
                        'age' => 6,
                        'weight_carried_lbs' => 154,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                3 =>
                    RiRow::createFromArray([
                        'horse_uid' => 964972,
                        'adjusted_age' => 6,
                        'age' => 6,
                        'weight_carried_lbs' => 147,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                4 =>
                    RiRow::createFromArray([
                        'horse_uid' => 788047,
                        'adjusted_age' => 6,
                        'age' => 9,
                        'weight_carried_lbs' => 154,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                5 =>
                    RiRow::createFromArray([
                        'horse_uid' => 766178,
                        'adjusted_age' => 6,
                        'age' => 10,
                        'weight_carried_lbs' => 154,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                6 =>
                    RiRow::createFromArray([
                        'horse_uid' => 807285,
                        'adjusted_age' => 6,
                        'age' => 11,
                        'weight_carried_lbs' => 147,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
                7 =>
                    RiRow::createFromArray([
                        'horse_uid' => 713902,
                        'adjusted_age' => 6,
                        'age' => 13,
                        'weight_carried_lbs' => 154,
                        'wfage' => 5,
                        'wfa' => 0,
                        'currhp' => 0,
                        'currhp2' => 0,
                        'lsnum' => 0,
                        'lsnum2' => 0,
                    ]),
            ]
        ];

        return $data[$this->getKey()];
    }
}
