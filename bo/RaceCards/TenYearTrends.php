<?php

namespace Bo\RaceCards;

use \Api\DataProvider\Bo\RaceCards\TenYearTrends as DataProvider;
use Bo\Standart;
use \Api\Exception\InternalServerError;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Api\Exception\ValidationError;
use \Api\Constants\Horses as Constants;

/**
 * Class TenYearTrends
 *
 * @package Bo\RaceCards
 */
class TenYearTrends extends Standart
{
    /**
     * @var int
     */
    private $raceId;
    /**
     * @var DataProvider
     */
    private $dataProvider;

    /**
     * A handicap race code
     */
    const HANDICAP_CODE = 'H';

    /**
     * Past races limit in years
     */
    const PAST_RACES_LIMIT = 10;

    /**
     * A minimum number of past races (including requested race)
     */
    const PAST_RACES_MIN = 3;

    const JOINT_FAV_SUFFIX = 'J';

    /**
     * @param int|null $raceId
     *
     * @throws InternalServerError
     */
    public function __construct($raceId = null)
    {
        if ((!is_null($raceId) && !is_numeric($raceId)) || $raceId < 0) {
            throw new InternalServerError(3);
        }

        $this->setRaceId($raceId);
        $this->setDataProvider(new DataProvider($raceId));
    }

    /**
     * @param int|null|string $raceId
     */
    public function setRaceId($raceId)
    {
        $this->raceId = $raceId;
    }

    /**
     * @param DataProvider|null $dataProvider
     */
    public function setDataProvider($dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Gets race instance id
     *
     * @return int
     */
    protected function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * @return DataProvider
     */
    protected function getDataProvider()
    {
        return $this->dataProvider;
    }

    /**
     * Gets ten year trends stats
     *
     * @return object
     * @throws ValidationError
     * @throws ResultsetException
     */
    public function getTenYearTrends()
    {
        $dataProvider = $this->getDataProvider();
        $lastYearRaces = $this->getLastRacesIDs();

        if (count($lastYearRaces) < self::PAST_RACES_MIN || $dataProvider->getRaceId() < 1) {
            return null;
        }

        $dataProvider->setLastRacesIDs($lastYearRaces);

        $trends = $this->getTrends();
        $trainers = $dataProvider->getWinningTrainers();
        $jockeys = $dataProvider->getJockeys();
        $prevRun = $this->getPreviousRun();
        $favourites = $this->getFavourites();

        $tenYearTrends = [
            'trends' => (object)$trends,
            'winning_trainers' => (!empty($trainers)) ? $trainers : null,
            'jockeys' => (!empty($jockeys)) ? $jockeys : null,
            'previous_run' => (!empty($prevRun)) ? (object)$prevRun : null,
            'favourites' => (!empty($favourites)) ? (object)$favourites : null,
        ];

        return (object)$tenYearTrends;
    }

    /**
     * Returns array of IDs of last years races for the past 10 years
     *
     * @return array
     * @throws ValidationError
     */
    protected function getLastRacesIDs()
    {
        $lastYearRaces = (new \Bo\LastYearRaces([$this->getRaceId()]))->getPastRacesIDs(self::PAST_RACES_LIMIT);

        return array_keys($lastYearRaces);
    }

    /**
     * Returns stats of the first, the second favorites and co-favorites
     *
     * @return array
     * @throws ValidationError
     */
    protected function getFavourites()
    {
        $favFirst = [];
        $favSecond = [];

        $poundSign = '£';
        $fav1Profit = 0.000;
        $fav1Wins = 0;
        $fav1Runs = 0;
        $fav2Profit = 0.000;
        $fav2Wins = 0;
        $fav2Runs = 0;


        $fav1JFav = 0;
        $fav2JFav = 0;
        $fav1Odds = 0.0;
        $fav2Odds = 0.0;
        $fav1ProfitOut = '';
        $fav2ProfitOut = '';

        $races = $this->getDataProvider()->getLastYearsWinRaces();
        $marketOdds = $this->getDataProvider()->getOddsValues();

        foreach ($races as $race) {
            if (array_key_exists($race->race_instance_uid, $marketOdds)) {
                $marketCnt = 0;
                $prevMarketOdds = 0.000;
                $fav1 = 0;
                $fav1Win = 0;
                $fav2 = 0;
                $fav2Win = 0;
                $fav1JFCnt = 0; // Francis calling co-favs jt-favs
                $fav2JFCnt = 0;

                $markets = $marketOdds[$race->race_instance_uid];

                foreach ($markets as $n => $market) {
                    if ($market->odds_value != $prevMarketOdds) {
                        $marketCnt++;
                    }

                    if ($marketCnt == 1) {
                        $fav1++;
                        if ($market->race_outcome_code == '1') {
                            $fav1Odds = $market->odds_value;
                            $fav1Win++;
                            if ($this->isCoFavorite($markets, $market->horse_uid, $market->odds_value)) {
                                $fav1JFCnt++;
                            }
                        }
                    } elseif ($marketCnt == 2) {
                        $fav2++;
                        if ($market->race_outcome_code == '1') {
                            $fav2Odds = $market->odds_value;
                            $fav2Win++;
                            if ($this->isCoFavorite($markets, $market->horse_uid, $market->odds_value)) {
                                $fav2JFCnt++;
                            }
                        }
                    }
                    $prevMarketOdds = $market->odds_value;
                }
                if ($fav1 > 1) {
                    $fav2 = $fav1;
                    $fav2Odds = $fav1Odds;
                    $fav2WinOut = 0;
                    $fav2Win = $fav1Win;
                    $fav2JFCnt = 0;
                } else {
                    $fav2WinOut = $fav2Win;
                }

                $fav1JFav = $fav1JFav + $fav1JFCnt;
                $fav2JFav = $fav2JFav + $fav2JFCnt;

                if ($race->rule4_value > 0) {
                    $fav1Odds = $fav1Odds * $race->rule4_value;
                }

                $fav1Stake = 1.00;

                if ($fav1 > 1) {
                    $fav1Stake = $fav1Stake / ($fav1 * 1.00);
                }

                if ($fav1Win > 1) {
                    $fav1Stake = $fav1Stake / ($fav1Win * 1.00);
                }

                if ($fav1Win > 0) {
                    $fav1Profit = $fav1Profit + ($fav1Stake * $fav1Odds) - (1.00 - $fav1Stake);
                    if ($fav1JFCnt == 0) {
                        $fav1Wins++;
                    }
                } else {
                    $fav1Profit = $fav1Profit - 1.00;
                }

                if ($race->rule4_value > 0) {
                    $fav2Odds = $fav2Odds * $race->rule4_value;
                }

                $fav2Stake = 1.00;

                if ($fav2 > 1) {
                    $fav2Stake = $fav2Stake / ($fav2 * 1.00);
                }

                if ($fav2Win > 1) {
                    $fav2Stake = $fav2Stake / ($fav2Win * 1.00);
                }

                if ($fav2Win > 0) {
                    $fav2Profit = $fav2Profit + ($fav2Stake * $fav2Odds) - (1.00 - $fav2Stake);
                    if ($fav2JFCnt == 0 && $fav2WinOut > 0) {
                        $fav2Wins++;
                    }
                } else {
                    $fav2Profit = $fav2Profit - 1.00;
                }

                $fav1Runs++;
                $fav2Runs++;
            }
        }

        if ($fav1Profit > 0) {
            $fav1ProfitOut = '+';
        } elseif ($fav1Profit < 0) {
            $fav1Profit = $fav1Profit * -1.000;
            $fav1ProfitOut = '-';
        }

        $fav1ProfitOut = $fav1ProfitOut . $poundSign . round($fav1Profit, 2);

        if ($fav2Profit > 0) {
            $fav2ProfitOut = '+';
        } elseif ($fav2Profit < 0) {
            $fav2Profit = $fav2Profit * -1.000;
            $fav2ProfitOut = '-';
        }

        $fav2ProfitOut = $fav2ProfitOut . $poundSign . round($fav2Profit, 2);

        if ($fav1JFav > 0) {
            $fav1JFavOut = "+" . $fav1JFav . self::JOINT_FAV_SUFFIX;
        } else {
            $fav1JFavOut = null;
        }

        if ($fav2JFav > 0) {
            $fav2JFOut = "+" . $fav2JFav . self::JOINT_FAV_SUFFIX;
        } else {
            $fav2JFOut = null;
        }

        $favFirst['wins'] = $fav1Wins . $fav1JFavOut;
        $favFirst['races'] = $fav1Runs;
        $favFirst['stake'] = $fav1ProfitOut;

        $favSecond['wins'] = $fav2Wins . $fav2JFOut;
        $favSecond['races'] = $fav2Runs;
        $favSecond['stake'] = $fav2ProfitOut;

        return [
            '1st_favourite' => (object)$favFirst,
            '2nd_favourite' => (object)$favSecond,
        ];
    }

    /**
     * Gets trends stats
     *
     * @return array
     * @throws ValidationError
     * @throws ResultsetException
     */
    protected function getTrends()
    {
        $dataProvider = $this->getDataProvider();
        $raceGroupCode = $dataProvider->getRaceGroup();

        $trends = [];
        $trends['weight_lowest'] = null;
        $trends['weight_highest'] = null;
        $trends['weight_median'] = null;
        $trends['age_lowest'] = null;
        $trends['age_highest'] = null;
        $trends['age_median'] = null;
        $trends['or_lowest'] = null;
        $trends['or_highest'] = null;
        $trends['or_median'] = null;
        $trends['handicap_rating_flag'] = ($raceGroupCode == self::HANDICAP_CODE) ? true : false;
        $trends['starting_price_lowest'] = null;
        $trends['starting_price_highest'] = null;
        $trends['starting_price_median'] = null;
        $trends['market_position_lowest'] = null;
        $trends['market_position_highest'] = null;
        $trends['market_position_median'] = null;

        if ($raceGroupCode != self::HANDICAP_CODE) {
            $this->adjustRpr();
        }

        $stats = $dataProvider->getStats();
        if (is_null($stats)) {
            return $trends;
        }

        $winStats = $dataProvider->getWinStats();

        $marketOdds = $dataProvider->getOddsValues();

        $midPoint = round(($stats->no_of_races + 1) / 2, 0, PHP_ROUND_HALF_DOWN);
        $midPointNext = ($stats->no_of_races % 2 == 0) ? $midPoint + 1 : $midPoint;
        $midPointOR = round(($stats->no_of_races_or + 1) / 2, 0, PHP_ROUND_HALF_DOWN);
        $midPointORNext = ($stats->no_of_races_or % 2 == 0) ? $midPointOR + 1 : $midPointOR;

        $runnersList = [];
        $weightsList = [];
        $orList = [];
        $agesList = [];
        $spList = [];
        $oddsList = [];

        $races = $dataProvider->getLastYearsWinRaces();

        foreach ($races as $i => $race) {
            $weightsList[] = $race->weight_carried_lbs;
            if ((($raceGroupCode != self::HANDICAP_CODE
                        && $race->race_group_code != self::HANDICAP_CODE)
                    || ($raceGroupCode == self::HANDICAP_CODE
                        && $race->race_group_code == self::HANDICAP_CODE))
                && $race->rpr > 0
            ) {
                $orList[] = $race->rpr;
            }
            $agesList[] = $race->age;
            $runnersList[] = $race->no_of_runners;
            $spList[] = [
                'val' => $race->odds_value,
                'desc' => $race->odds_desc
            ];
            $oddsList[$race->race_instance_uid][] = $race->odds_value;
        }

        // Weight
        if ($stats->diff_weights > 1 && $raceGroupCode == self::HANDICAP_CODE) {
            $weightMedian = $this->getMedian($weightsList, $midPoint, $midPointNext);

            $trends['weight_lowest'] = floor($winStats->min_wt / 14) . '-' . floor($winStats->min_wt % 14);
            $trends['weight_highest'] = floor($winStats->max_wt / 14) . '-' . floor($winStats->max_wt % 14);
            $trends['weight_median'] = floor($weightMedian / 14) . '-' . floor($weightMedian % 14);
        }

        // Official rating
        if ($winStats->min_or > 0 && $winStats->max_or > 0) {
            $trends['or_lowest'] = $winStats->min_or;
            $trends['or_highest'] = $winStats->max_or;
            $trends['or_median'] = $this->getMedian($orList, $midPointOR, $midPointORNext);
        }

        // Horse age
        if ($stats->diff_ages > 1) {
            $trends['age_lowest'] = $winStats->min_age;
            $trends['age_highest'] = $winStats->max_age;
            $trends['age_median'] = $this->getMedian($agesList, $midPoint, $midPointNext);
        }

        // Number of runners
        $trends['total_runners_lowest'] = $winStats->min_runners;
        $trends['total_runners_highest'] = $winStats->max_runners;
        $trends['total_runners_median'] = $this->getMedian($runnersList, $midPoint, $midPointNext);

        //  Starting price
        $spDesc = $dataProvider->getMinMaxSPDesc($winStats->min_sp, $winStats->max_sp);

        if (!empty($spDesc['min_sp_desc']) && !empty($spDesc['max_sp_desc'])) {
            $trends['starting_price_lowest'] = $this->replaceOddsDesc($spDesc['min_sp_desc']);
            $trends['starting_price_highest'] = $this->replaceOddsDesc($spDesc['max_sp_desc']);
            $trends['starting_price_median'] = $this->replaceOddsDesc(
                $this->getMedianSP($spList, $midPoint, $midPointNext)
            );
        }

        // Market position
        $marketOddsList = $this->getMarketPositions($oddsList, $marketOdds);
        if (!empty($marketOddsList)) {
            sort($marketOddsList);
            $marketMedian = $this->getMedian($marketOddsList, $midPoint, $midPointNext);

            if (!empty($marketOddsList) && $marketOddsList[0] > 0) {
                $trends['market_position_lowest'] = $marketOddsList[0];
                $trends['market_position_highest'] = $marketOddsList[sizeof($marketOddsList) - 1];
                $trends['market_position_median'] = $marketMedian;
            }
        }

        return $trends;
    }

    /**
     * Replace odds description with a proper one
     *
     * @param $oddsDesc string
     *
     * @return string
     */
    protected function replaceOddsDesc($oddsDesc)
    {
        if (strlen($oddsDesc) > 4) {
            $oddsDesc = str_replace(['Evens', '100/30', '30/100'], ['Evs', '10/3', '3/10'], $oddsDesc);
        }
        return $oddsDesc;
    }

    /**
     * Re-adjusts RPR for all races
     */
    protected function adjustRpr(): void
    {
        $dataProvider = $this->getDataProvider();
        $racesStats = $dataProvider->getRprRacesStats();

        if (empty($racesStats)) {
            return;
        }

        $races = $dataProvider->getRprRaces();

        foreach ($races as $id => $race) {
            $forceDeductWfa = 0;
            $wfaControlFlag = 0;

            $raceMonth = $racesStats[$id]->race_month;
            $raceMonthHalf = $racesStats[$id]->race_month_half;
            $furlong = $racesStats[$id]->furlong;
            $raceGroupCode = $racesStats[$id]->race_group_code;
            $maxAge = $racesStats[$id]->max_age;
            $minAge = $racesStats[$id]->min_age;
            $topAge = $racesStats[$id]->top_age;
            $raceType = $racesStats[$id]->race_type;

            if ($raceMonth == 2) {
                $raceMonthHalf = ($raceMonthHalf < 15) ? 1 : 2;
            } else {
                $raceMonthHalf = ($raceMonthHalf < 16) ? 1 : 2;
            }

            // Adjust furlong
            if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false) {
                if ($furlong < 6) {
                    $furlong = 5;
                } elseif ($furlong == 17) {
                    $furlong = 16;
                } elseif ($furlong == 19) {
                    $furlong = 18;
                } elseif ($furlong > 19) {
                    $furlong = 20;
                }
            } else {
                if ($furlong > 23) {
                    $furlong = 24;
                } elseif ($furlong > 19) {
                    $furlong = 20;
                } elseif ($furlong > 15) {
                    $furlong = 16;
                }
            }

            // Adjust top age
            if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false) {
                if ($topAge > 5) {
                    $topAge = 5;
                }
            } else {
                if (strpos(Constants::RACE_TYPE_HURDLE, $raceType) !== false) {
                    if ($topAge > 5) {
                        $topAge = 5;
                    }
                } else {
                    if ($topAge > 6) {
                        $topAge = 6;
                    }
                }
            }

            if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false) {
                if ($minAge != $maxAge) {
                    $wfaControlFlag = ($minAge >= 5) ? 1 : 2;
                }
            } else {
                if ($minAge != $maxAge && $minAge < $topAge) {
                    $wfaControlFlag = 2;
                    if ($raceGroupCode != self::HANDICAP_CODE) {
                        $forceDeductWfa = 1;
                    }
                }
            }

            $wfAges = [];

            if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false && $wfaControlFlag == 2 && !is_null($topAge)) {
                $wfAges = $dataProvider->getWfAges($furlong, $raceMonth, $raceMonthHalf);
            }

            foreach ($race as $i => $horse) {
                // Set top wfAge
                $wfAge = $horse->wfage;
                $adjustedAge = $horse->adjusted_age;
                $rating = $horse->rating;

                if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false) {
                    $wtAdjust = 140;

                    if ($adjustedAge > 5) {
                        $adjustedAge = 5;
                    }
                    if ($wfAge > 3 && $topAge == 3) {
                        $wfAge = 3;
                    } elseif ($wfAge > 4) {
                        $wfAge = 4;
                    }
                } else {
                    $wtAdjust = 168;
                    if ($adjustedAge > 6 && !strpos(Constants::RACE_TYPE_HURDLE, $raceType) !== false) {
                        $adjustedAge = 6;
                    } elseif ($adjustedAge > 5 && strpos(Constants::RACE_TYPE_HURDLE, $raceType) !== false) {
                        $adjustedAge = 5;
                    }
                    if (strpos(Constants::RACE_TYPE_HURDLE, $raceType) !== false) {
                        if ($wfAge <= 3 || ($wfAge > 3 && $topAge == 3)) {
                            $wfAge = 3;
                        } elseif ($wfAge > 3 && ($wfAge == 0 || $topAge != 3)) {
                            $wfAge = 4;
                        }
                    } elseif (strpos(Constants::RACE_TYPE_CHASE, $raceType) !== false) {
                        if ($wfAge <= 4 || ($wfAge > 4 && $topAge == 4)) {
                            $wfAge = 4;
                        } elseif ($wfAge > 5 && ($wfAge == 0 || $topAge != 4)) {
                            $wfAge = 5;
                        }
                    }
                }

                if ($rating > 0) {
                    $rating = $rating + ($wtAdjust - $horse->adj_weight_carried_lbs);
                }

                if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false && $wfaControlFlag == 2) {
                    if ($rating > 0
                        && $adjustedAge < $topAge
                        && $forceDeductWfa == 0
                        && array_key_exists($wfAge, $wfAges)
                        && !empty($wfAges[$wfAge][0]->age)
                    ) {
                        $rating = $rating - intval($wfAges[$wfAge][0]->wfa);
                    }
                }

                if ($rating == -1) {
                    $rating = 0;
                }

                $dataProvider->updateRPR($id, $horse->horse_uid, $rating);
            }
        }
    }


    /**
     * Gets median value
     *
     * @param array $list
     * @param int   $midPoint
     * @param int   $midPointNext
     *
     * @return int|null
     */
    protected function getMedian($list, $midPoint, $midPointNext)
    {
        if (!is_array($list) || empty($list)) {
            return null;
        }

        $median = 0;
        $i = 0;
        sort($list);
        foreach ($list as $k => $item) {
            $i++;
            if ($i == $midPoint) {
                $median = $item;
            } elseif ($i == $midPointNext) {
                $median = floor(round(($median + $item) / 2, 0));
            }
        }

        return (int)$median;
    }

    /**
     * Gets median value for starting price
     *
     * @param array $list
     * @param int   $midPoint
     * @param int   $midPointNext
     *
     * @return string|null
     */
    protected function getMedianSP($list, $midPoint, $midPointNext)
    {
        if (!is_array($list) || empty($list)) {
            return null;
        }
        $medianVal = 0.0;
        $median = '';

        uasort($list, ['self', 'cmpVal']);
        $i = 1;
        foreach ($list as $item) {
            if ($i == $midPoint) {
                $median = $item['desc'];
                if (in_array(substr($median, -1, 1), Constants::getConstantAsArray(Constants::FAVOURITE_FLAG_CODES))) {
                    $median = substr($median, 0, -1);
                }
                $medianVal = $item['val'];
            } elseif ($i == $midPointNext) {
                $medianVal = round(($medianVal + $item['val']) / 2.000, 3);
                $prevVal = 0.0;

                $oddsList = $this->getDataProvider()->getAllOddsList();

                foreach ($oddsList as $key => $odds) {
                    if ($odds->odds_value == $medianVal) {
                        $median = $odds->odds_desc;
                        break;
                    } elseif ($odds->odds_value > $medianVal) {
                        if (($odds->odds_value - $medianVal) <= ($medianVal - $prevVal)) {
                            $median = $odds->odds_desc;
                        }
                        break;
                    } else {
                        $median = $odds->odds_desc;
                        $prevVal = $odds->odds_value;
                    }
                }
            }
            $i++;
        }
        return $median;
    }

    /**
     * Gets market positions
     *
     * @param array $list
     * @param array $marketList
     *
     * @return array
     */
    protected function getMarketPositions($list, $marketList)
    {
        $positions = [];
        if (empty($list) || empty($marketList)) {
            return null;
        }

        foreach ($list as $id => $item) {
            if (array_key_exists($id, $marketList)) {
                foreach ($marketList[$id] as $pos => $market) {
                    if ($item[0] == $market->odds_value) {
                        $positions[] = $pos + 1;
                        break;
                    }
                }
            }
        }

        return $positions;
    }

    /**
     * Compares values of given arrays
     *
     * @param $a
     * @param $b
     *
     * @return int
     */
    protected function cmpVal($a, $b)
    {
        if ($a['val'] == $b['val']) {
            return 0;
        }
        return ($a['val'] > $b['val']) ? 1 : -1;
    }

    /**
     * Checks if a horse is a co-favorite
     *
     * @param $raceData array
     * @param $horseId  int
     * @param $oddsVal  float
     *
     * @return boolean
     */

    protected function isCoFavorite($raceData, $horseId, $oddsVal)
    {
        if (!empty($raceData)) {
            foreach ($raceData as $race) {
                if ($race->horse_uid != $horseId && $race->odds_value == $oddsVal) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Gets stats of previous run
     *
     * @return array|object
     * @throws ValidationError
     * @throws ResultsetException
     */
    protected function getPreviousRun()
    {
        $runs['wins'] = 0;
        $runs['placed'] = 0;
        $runs['lost'] = 0;
        $runs['debuts'] = 0;
        $runs = (object)$runs;

        $dataProvider = $this->getDataProvider();
        $raceGroupCode = $dataProvider->getRaceGroup();

        $data = $dataProvider->getPreviousRun();

        if (!empty($data)) {
            $runs = $data;
        }
        if ($raceGroupCode != self::HANDICAP_CODE) {
            $runs->debuts = $dataProvider->getFavoriteDebuts();
        }
        if ($runs->wins > 0 || $runs->placed > 0 || $runs->lost > 0 || $runs->debuts > 0) {
            return $runs;
        }
        return [];
    }
}
