<?php

namespace Bo\RaceCards;

use Bo\Standart;

/**
 * Class TopDraw
 *
 * @package Bo\RaceCards
 */
class TopDraw extends Standart
{
    const STALLS_POSITION_NONE = 'F';
    const DIRECTION_LEFT = 'L';
    const DIRECTION_RIGHT = 'R';

    private $raceId = null;

    private $cumulative = [
        'low' => 0,
        'high' => 0
    ];

    private $finals = [
        'low' => 0,
        'mid' => 0,
        'high' => 0,
    ];

    private $wins = [
        'low' => 0,
        'mid' => 0,
        'high' => 0,
    ];

    private $raceCount = 0;


    /**
     * @param int|null $raceId
     *
     * @throws \Api\Exception\InternalServerError
     */
    public function __construct($raceId = null)
    {
        if ((!is_null($raceId) && !is_numeric($raceId)) || $raceId < 0) {
            throw new \Api\Exception\InternalServerError(3);
        }

        $this->setRaceId($raceId);
    }

    /**
     * @param int|null|string $raceId
     */
    private function setRaceId($raceId)
    {
        $this->raceId = $raceId;
    }

    /**
     * Get race instance id
     *
     * @return int|null
     */
    public function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * @return \Api\DataProvider\Bo\RaceCards\TopDraw
     */
    protected function getDataProvider()
    {
        return new \Api\DataProvider\Bo\RaceCards\TopDraw();
    }

    /**
     * Get top draw stats
     *
     * @return null|object
     */
    public function getTopDraw()
    {
        $dataProvider = $this->getDataProvider();
        $dataProvider->dropTmpTables();
        $raceInfo = $dataProvider->getRaceInfo($this->getRaceId());

        if (is_null($raceInfo)) {
            return null;
        }

        $result = $dataProvider->crateLastYearsRaces($raceInfo);

        if ($result == false) {
            return null;
        }

        if ($raceInfo->course_name == "ASCOT") {
            $raceInfo->season_10_year = '01 Jan 2006 00:01';
        }

        $lowRunners = $raceInfo->no_of_runners - 3;
        $highRunners = $raceInfo->no_of_runners + 3;

        $lowMinimum = $this->getLowMinimum($raceInfo->pre_distance_yard, $raceInfo->course_name);

        if ($lowRunners < $lowMinimum) {
            $lowRunners = $lowMinimum;
        }

        if ($raceInfo->no_of_runners >= $lowRunners) {
            $this->setCumulative($dataProvider, $raceInfo, $lowRunners, $highRunners);

            if ($this->raceCount > 20) {
                $this->raceCount = 20;
            }

            if ($this->raceCount > 0) {
                $this->finals['low'] = intval(round($this->cumulative['low'] / $this->raceCount, 0));
                $this->finals['high'] = intval(round($this->cumulative['high'] / $this->raceCount, 0));
                $this->finals['mid'] = 150 - ($this->finals['low'] + $this->finals['high']);
            }
        }

        $dataProvider->dropTmpTables();

        if ($this->finals['low'] == 0 || $this->finals['mid'] == 0 || $this->finals['high'] == 0) {
            return null;
        }

        return (Object)[
            'race_instance_uid' => $this->getRaceId(),
            'race_datetime' => $raceInfo->pre_race_datetime,
            'no_of_runners' => $raceInfo->no_of_runners,
            'distance' => $this->getDistanceFurlong($raceInfo->pre_distance_yard),
            'going_type_code' => $raceInfo->going_type_code,
            'stalls' => $this->getStalls($raceInfo->pre_direction, $raceInfo->pre_stalls_pos),
            'low_final' => $this->finals['low'],
            'mid_final' => $this->finals['mid'],
            'high_final' => $this->finals['high'],
            'low_wins' => $this->wins['low'],
            'mid_wins' => $this->wins['mid'],
            'high_wins' => $this->wins['high'],
            'races' => $this->raceCount
        ];
    }

    /**
     * Get low minimum
     *
     * @param int    $distanceYard
     * @param string $courseName
     *
     * @return int
     */
    public function getLowMinimum($distanceYard, $courseName)
    {
        if ($distanceYard < 1540) {
            if ($courseName == 'CHESTER') {
                $lowMinimum = 6;
            } elseif (in_array($courseName, ['BEVERLEY', 'HAMILTON'])) {
                $lowMinimum = 7;
            } else {
                $lowMinimum = 10;
            }
        } elseif ($distanceYard >= 1540 && $distanceYard <= 1979) {
            if ($courseName == 'CHESTER') {
                $lowMinimum = 6;
            } else {
                $lowMinimum = 12;
            }
        } elseif ($distanceYard >= 1980 && $distanceYard <= 2639) {
            $lowMinimum = 14;
        } elseif ($distanceYard >= 2640 && $distanceYard <= 3519) {
            $lowMinimum = 16;
        } else {
            $lowMinimum = 30;
        }

        if (strpos($courseName, '(A.W)') > 0) {
            $lowMinimum = 8;
        }

        return $lowMinimum;
    }

    /**
     * Get stalls
     *
     * @param string $direction
     * @param string $stallsPos
     *
     * @return string
     */
    public function getStalls($direction, $stallsPos)
    {
        if ($stallsPos == self::STALLS_POSITION_NONE) {
            return 'None';
        }

        $stalls = '';

        if ($direction == self::DIRECTION_LEFT || self::DIRECTION_RIGHT) {
            switch ($stallsPos) {
                case 'L':
                    $stalls = 'Low';
                    break;
                case 'M':
                case 'C':
                    $stalls = 'Middle';
                    break;
                case 'H':
                    $stalls = 'High';
                    break;
            }
        }

        return $stalls;
    }

    /**
     * Convert distance in yards to furlongs
     *
     * @param int $distanceYard
     *
     * @return float
     */
    private function getDistanceFurlong($distanceYard)
    {
        if (!is_null($distanceYard) && $distanceYard > 0) {
            $distanceFurlong = intval(floor($distanceYard / 220));
            $distanceYard -= ($distanceFurlong * 220);
        } else {
            return 0.0;
        }
        if ($distanceYard > 0) {
            $distanceFurlong += (floor(round((($distanceYard * 10.0) / 220.0), 0)) * 0.1);
        }

        return $distanceFurlong;
    }

    /**
     * Set cumulative low and high values
     *
     * @param array $dataProvider
     * @param array $raceInfo
     * @param int   $lowRunners
     * @param int   $highRunners
     */
    private function setCumulative($dataProvider, $raceInfo, $lowRunners, $highRunners)
    {

        $lastRaces = $dataProvider->getLastYearsRaces($raceInfo);
        $actualStallsPositions = $dataProvider->getActualStallsPositions();
        $runners = $dataProvider->getRunners();

        foreach ($lastRaces as $id => $race) {
            if ($race->ran >= $lowRunners && $race->ran <= $highRunners
                && (
                    (
                        $raceInfo->country_code == 'GB'
                        && ($race->rp_stalls_position == $raceInfo->pre_stalls_pos
                            || $race->safety_factor_number - $race->ran <= 3
                            || $raceInfo->pre_safety_factor_number - $raceInfo->no_of_runners <= 3)
                    )
                    || (
                        $raceInfo->country_code == 'IRE'
                        && ($race->safety_factor_number - $race->ran <= 3
                            || $raceInfo->pre_safety_factor_number - $raceInfo->no_of_runners <= 3)
                    )
                )
            ) {
                $this->raceCount++;

                if ($this->raceCount > 20) {
                    break;
                }

                $runnerDraw = $this->getRunnerDraw($race, $actualStallsPositions);

                /* Now read through all runners in this race and work out the following
                1) Where they were drawn Low, Middle or High
                2) where they finished
                3) how many points they warrant for their group */

                $lowCnt = 0;
                $midCnt = 0;
                $highCnt = 0;
                $lowPoints = 0;
                $midPoints = 0;
                $highPoints = 0;
                $maxAvg = 0;
                $maxRunners = 0;

                if (array_key_exists($race->race_instance_uid, $runners)) {
                    foreach ($runners[$race->race_instance_uid] as $runner) {
                        if ($runner->pos_num <= $runnerDraw['lowInit']) {
                            $points = ($race->ran + 1 - $runner->pos_num) + ($runnerDraw['lowInit'] + 1
                                    - $runner->pos_num);
                            $maxAvg += $points;
                            $maxRunners++;
                        } elseif ($runner->pos_num > $runnerDraw['lowInit']
                            && $runner->pos_num <= $runnerDraw['highInit']
                        ) {
                            $points = $race->ran + 1 - $runner->pos_num;
                        } else {
                            $points = 0;
                        }

                        if ($runner->horse_draw <= $runnerDraw['low']) {
                            $lowPoints += $points;
                            if ($runner->pos_num < 99) {
                                $lowCnt++;
                                if ($runner->pos_num == 1) {
                                    $this->wins['low']++;
                                }
                            }
                        } elseif ($runner->horse_draw > $runnerDraw['high']) {
                            $highPoints += $points;
                            if ($runner->pos_num < 99) {
                                $highCnt++;
                                if ($runner->pos_num == 1) {
                                    $this->wins['high']++;
                                }
                            }
                        } else {
                            $midPoints += $points;
                            if ($runner->pos_num < 99) {
                                $midCnt++;
                                if ($runner->pos_num == 1) {
                                    $this->wins['mid']++;
                                }
                            }
                        }
                    }
                }

                $lowRace = 0;
                $highRace = 0;

                $lowAvg = ($lowCnt > 0) ? round($lowPoints / $lowCnt, 4) : 0.0;
                $highAvg = ($highCnt > 0) ? round($highPoints / $highCnt, 4) : 0.0;
                $totalAvg = ($maxRunners > 0) ? round($maxAvg / $maxRunners, 4) : 0.0;

                if ($totalAvg > 0) {
                    $lowRace = intval(floor(round(($lowAvg / $totalAvg) * 100, 0)));
                    $highRace = intval(floor(round(($highAvg / $totalAvg) * 100, 0)));
                }

                $this->cumulative['low'] += $lowRace;
                $this->cumulative['high'] += $highRace;
            }
        }
    }

    /**
     * Get draw values of runners
     *
     * @param array $race
     * @param array $actualStallsPositions
     *
     * @return array
     */
    private function getRunnerDraw($race, $actualStallsPositions)
    {

        $lowInit = floor(round($race->ran / 3, 0));
        $highInit = $race->ran - $lowInit;

        $low = 0;
        $high = 0;
        $stallCnt = 0;

        if (array_key_exists($race->race_instance_uid, $actualStallsPositions)) {
            foreach ($actualStallsPositions[$race->race_instance_uid] as $stallPosition) {
                $stallCnt++;

                if ($stallCnt == $lowInit) {
                    $low = $stallPosition->draw;
                } elseif ($stallCnt == $highInit) {
                    $high = $stallPosition->draw;
                }
            }
        }

        if ($low == 0) {
            $low = $lowInit;
        }
        if ($high == 0) {
            $high = $highInit;
        }

        return [
            'lowInit' => $lowInit,
            'highInit' => $highInit,
            'low' => $low,
            'high' => $high
        ];
    }
}
