<?php

namespace Bo\RaceCards;

use Api\Constants\Horses as Constants;
use Bo\Standart;
use \Api\DataProvider\Bo\RaceCards\RaceWFA as DataProvider;

/**
 * Class RaceWFA
 *
 * @package Bo\RaceCards
 */
class RaceWFA extends Standart
{
    private $raceId = null;
    private $dataProvider = null;

    const TYPE_HURDLE = 'H';
    const TYPE_CHASE = 'C';

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
        $this->dataProvider = $this->getDataProvider();
    }

    /**
     * @param int|null|string $raceId
     */
    public function setRaceId($raceId)
    {
        $this->raceId = intval($raceId);
    }

    /**
     * @param DataProvider $dataProvider
     */
    public function setDataProvider($dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Gets race instance id
     *
     * @return int|null
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
        return (is_null($this->dataProvider)) ? new DataProvider() : $this->dataProvider;
    }

    /**
     * Retrieves WFA (Weight For Age) allowances that are applicable in a race
     *
     * @return string|null
     */
    public function getRaceWFA()
    {
        $raceUid = $this->getRaceId();
        $provider = $this->getDataProvider();
        $race = $provider->getRaceInfo($raceUid);
        if ($race === false) {
            return null;
        }

        $raceStatusCode = ($race->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_RESULTS))
            ? Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)
            : $race->race_status_code;
        $raceType = $race->race_type_code;
        $raceDateTime = $race->race_datetime;
        $distFurlong = intval(($race->distance_yard + 109) / 220);
        $race->furlong = $this->adjustFurlong($distFurlong, $raceType);

        $race->hurdleOrChase = (false !== strpos(Constants::RACE_TYPE_HURDLE, $raceType))
            ? RaceWFA::TYPE_HURDLE
            : RaceWFA::TYPE_CHASE;
        $race->hurdleOrChase2 = (false !== strpos(Constants::RACE_TYPE_HURDLE, $raceType))
            ? RaceWFA::TYPE_CHASE
            : RaceWFA::TYPE_HURDLE;

        list($raceMonth, $raceMonthHalf) = $this->getRaceMonthData($race);

        $topStats = $provider->getTopStats($raceUid, $raceStatusCode, $raceDateTime);
        if ($topStats === false) {
            return null;
        }

        $race->minAge = $topStats->min_age;
        $race->maxAge = $topStats->max_age;
        $race->topAge = $this->adjustTopAge($topStats->top_age, $raceType);

        $raceHorses = $provider->getRaceHorses(
            $raceUid,
            $raceStatusCode,
            $raceDateTime,
            $raceType,
            $race->topAge
        );
        if (empty($raceHorses)) {
            return null;
        }

        if (false !== strpos(Constants::RACE_TYPE_FLAT, $raceType)) {
            $wfAges = $provider->getWfAgesFlat($race, $raceMonth, $raceMonthHalf);
        } else {
            $wfAges = $provider->getWfAgesJumps($race, $raceMonth);
        }

        $wfaText = '';

        // For `B` and `W` we don`t need WFA and if we use current logic the information is misleading so it is safe
        // to exclude wfa for these race types
        if (!in_array($raceType, Constants::RACE_TYPE_NHF_ARRAY)) {
            $wfaText = $this->getWfaText(
                $this->getHorsesWfaAllowances($race, $raceHorses, $wfAges),
                $race->maxAge
            );
        }

        return (strlen($wfaText) > 0) ? $wfaText : null;
    }

    /**
     * @param \Api\Row\RaceInstance $race
     * @param array                 $raceHorses
     * @param array                 $wfAges
     *
     * @return array
     */
    private function getHorsesWfaAllowances($race, $raceHorses, $wfAges)
    {
        $result = [];
        foreach ($raceHorses as $horse) {
            $wfaAllow = 0;

            if ($race->topAge <= 0) {
                continue;
            }

            if (false !== strpos(Constants::RACE_TYPE_FLAT, $race->race_type_code)
                && $race->minAge != $race->maxAge) {
                // FLAT
                if ($race->topAge == 3 || $race->topAge == 4) {
                    $wfAgeItem = $this->getWfAgeItem($wfAges, $horse->age);
                    $wfaAllow = (!is_null($wfAgeItem)) ? $wfAgeItem->wfa : 0;
                } else {
                    $wfAgeItem = $this->getWfAgeItem($wfAges, $horse->wfage);
                    $wfaAllow = (!is_null($wfAgeItem) && $wfAgeItem->age < $race->topAge && $race->topAge > 4)
                        ? $wfAgeItem->wfa
                        : 0;
                }
            } elseif ($race->furlong > 15) {
                // JUMPS
                $wfAgeItem = $this->getWfAgeItem($wfAges, $horse->wfage, $race->hurdleOrChase);
                if (!is_null($wfAgeItem)) {
                    $wfaAllow = ($wfAgeItem->age < $race->topAge) ? $wfAgeItem->wfa : 0;
                } else {
                    $wfAgeItem = $this->getWfAgeItem($wfAges, $horse->wfage, $race->hurdleOrChase2);
                    $wfaAllow = (!is_null($wfAgeItem) && ($horse->currhp2 > 0 || $horse->lsnum2 > 0))
                        ? $wfAgeItem->wfa
                        : 0;
                }
            }
            if (!isset($result[$horse->adjusted_age])) {
                $result[$horse->adjusted_age] = (object)[
                    'age' => $horse->age,
                    'wfa_allow' => ($horse->age == $horse->wfage) ? $wfaAllow : 0
                ];
            }
        }
        return $result;
    }

    /**
     * @param array  $wfAges
     * @param int    $age
     * @param string $raceType
     *
     * @return \Phalcon\Mvc\Model\Row|null
     */
    private function getWfAgeItem(array $wfAges, int $age, string $raceType = '')
    {
        if (array_key_exists($age, $wfAges) && !empty($wfAges[$age])) {
            if (!empty($raceType)) {
                foreach ($wfAges[$age] as $item) {
                    if ($item->race_type_code == $raceType) {
                        return $item;
                    }
                }
            } else {
                return $wfAges[$age][0];
            }
        }
        return null;
    }

    /**
     * @param \Api\Row\RaceInstance $race
     *
     * @return array
     */
    private function getRaceMonthData($race)
    {
        $raceDate = new \DateTime($race->race_datetime);
        $raceMonth = intval($raceDate->format('m'));
        $raceMonthHalf = intval($raceDate->format('d'));

        if ($raceMonth == 2) {
            $raceMonthHalf = ($raceMonthHalf < 15) ? 1 : 2;
        } else {
            $raceMonthHalf = ($raceMonthHalf < 16) ? 1 : 2;
        }

        return [
            $raceMonth,
            $raceMonthHalf
        ];
    }

    /**
     * @param array $horses
     * @param int   $maxAge
     *
     * @return string
     */
    protected function getWfaText($horses, $maxAge)
    {
        ksort($horses);

        $wfaText = '';
        $count = 0;
        $prevAge = 0;
        $prevWfaAllow = 0;

        foreach ($horses as $horse) {
            if ($count > 0) {
                $wfaText .= ((strlen($wfaText) > 0) ? ' ' : '')
                    . $prevAge
                    . 'yo'
                    . ' from '
                    . $horse->age
                    . 'yo'
                    . (($horse->wfa_allow == 0 && $maxAge > $horse->age) ? '+' : '')
                    . ' '
                    . $prevWfaAllow . 'lb';
            }

            if ($horse->wfa_allow == 0) {
                break;
            }

            $prevAge = $horse->age;
            $prevWfaAllow = $horse->wfa_allow;
            $count++;
        }
        return $wfaText;
    }

    /**
     * @param int    $furlong
     * @param string $raceType
     *
     * @return int
     */
    public function adjustFurlong($furlong, $raceType)
    {
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
            if ($furlong >= 23) {
                $furlong = 24;
            } elseif ($furlong >= 19) {
                $furlong = 20;
            } elseif ($furlong >= 15) {
                $furlong = 16;
            }
        }

        return $furlong;
    }

    /**
     * @param int    $topAge
     * @param string $raceType
     *
     * @return int
     */
    public function adjustTopAge($topAge, $raceType)
    {
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

        return $topAge;
    }
}
