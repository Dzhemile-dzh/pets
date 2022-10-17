<?php

namespace Api\DataProvider\Bo;

use Api\DataProvider\HorsesDataProvider;
use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model\Row\General as General;

/**
 * Class Rpr
 *
 * @package Api\DataProvider\Bo
 */
class Rpr extends HorsesDataProvider
{
    const CODE_PULLED_UP = 63;
    const LAST_400_DAYS = 400;
    const LAST_200_DAYS = 200;

    const RPR_TURF = 'current_official_turf_rating';
    const RPR_AW = 'current_official_aw_rating';
    const RPR_HURDLE = 'current_official_rating_hurdle';
    const RPR_CHASE = 'current_official_rating_chase';

    const RACE_GROUP_CHASE = 'chase';
    const RACE_GROUP_HURDLE = 'hurdle';
    const RACE_GROUP_NHF = 'nhf';

    private $race;
    private $runners;
    private $runnersIds;
    private $selectors;
    private $builder;

    /**
     * Rpr constructor.
     *
     * @param object $race
     * @param array  $runners
     */
    public function __construct(General $race, array $runners)
    {
        $this->race = $race;
        $this->runners = $runners;
        $this->runnersIds = array_keys($this->runners);
    }

    /**
     * @return Builder
     */
    private function getBuilder(): Builder
    {
        if (!isset($this->builder)) {
            $this->builder = new Builder();
        }

        return $this->builder;
    }

    /**
     * @return Selectors
     */
    private function getSelectors(): Selectors
    {
        if (!isset($this->selectors)) {
            $this->selectors = $this->getDI()->getShared('selectors');
        }

        return $this->selectors;
    }

    /*
     * @return array
     */
    private function getRunnerIds(): array
    {
        return $this->runnersIds;
    }

    /**
     * @return array
     */
    public function getRprStatistics(): array
    {
        $builder = $this->getBuilder();

        $builder->setSqlTemplate("
            SELECT
                hr.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.distance_yard
                , hr.horse_uid
                , hr.trainer_uid
                , hr.final_race_outcome_uid
                , hr.rp_postmark
                , rh.current_official_turf_rating
                , rh.current_official_aw_rating
                , rh.current_official_rating_hurdle
                , rh.current_official_rating_chase
            FROM
                horse_race hr
                JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
                JOIN racing_horse rh ON rh.horse_uid = hr.horse_uid
            WHERE
                hr.horse_uid IN (:horses_ids)
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND datediff(day, ri.race_datetime, getdate()) <= " . self::LAST_400_DAYS . "
            ORDER BY ri.race_datetime DESC
        ");


        $builder
            ->setParam('horses_ids', $this->getRunnerIds());

        $builder->build();

        $result = $this->query(
            $builder->getSql(),
            $builder->getParams(),
            new General()
        )->getGroupedResult([
                                    'horse_uid',
                                    'records' => [
                                        'race_instance_uid',
                                        'race_datetime',
                                        'race_type_code',
                                        'distance_yard',
                                        'trainer_uid',
                                        'final_race_outcome_uid',
                                        'rp_postmark',
                                        'current_official_turf_rating',
                                        'current_official_aw_rating',
                                        'current_official_rating_hurdle',
                                        'current_official_rating_chase'
                                    ]
                                ], ['horse_uid']);
        

        return $result;
    }


    public function addRatingForRace($horsesRating, &$runners, $race)
    {
        $selectors = $this->getSelectors();
        $raceTypeSubGroup = $selectors->getRaceTypeGroupNameByRaceType($race->race_type_code);

        if (isset($horsesRating) && count($horsesRating) > 0) {
            if ($raceTypeSubGroup == Constants::RACE_TYPE_FLAT_ALIAS) {
                $this->calculateRprFlat($horsesRating, $race->race_type_code, $runners);
            } else {
                $this->calculateRprJumps($horsesRating, $raceTypeSubGroup, $race->country_code, $runners);
            }
        }
    }

    /**
     * @param array $horsesRating
     * @param string $raceTypeCode
     * @param array $runners
     */
    public function calculateRprFlat(array $horsesRating, string $raceTypeCode, array &$runners): void
    {
        $adjustment = $raceTypeCode == Constants::COUNTRY_HK ? 10 : 5;
        $official_rating = strpos(Constants::RACE_TYPE_FLAT_TURF, $raceTypeCode) !== false
            ? self::RPR_TURF : self::RPR_AW;
        foreach ($horsesRating as $id => $horse) {
            if (isset($horse[$official_rating])) {
                $rpr = $this->searchNearest(
                    $horse[$official_rating] + $adjustment + $this->runners[$horse['horse_uid']]->extra_weight_lbs,
                    $this->getRprArray($horse)
                );
            } else {
                $rpr = max($this->getRprArray($horse));
            }
            $runners[$horse['horse_uid']]->rp_postmark = $rpr;
        }
    }

    /**
     * @param array $horsesRating
     * @param string $raceTypeSubGroup
     * @param string $country
     * @param array $runners
     */
    public function calculateRprJumps(array $horsesRating, string $raceTypeSubGroup, string $country, array &$runners)
    {
        $adjustment = 0;
        $official_rating = 'undefined_rating_field';
        if ($country == Constants::COUNTRY_GB) {
            $type = 1;
            if ($raceTypeSubGroup == self::RACE_GROUP_HURDLE) {
                $adjustment = 0;
                $official_rating = self::RPR_HURDLE;
            } elseif ($raceTypeSubGroup == self::RACE_GROUP_CHASE) {
                $adjustment = 5;
                $official_rating = self::RPR_CHASE;
            }
        } elseif ($country == Constants::COUNTRY_IRE) {
            $type = 1;
            if ($raceTypeSubGroup == self::RACE_GROUP_HURDLE) {
                $adjustment = 12;
                $official_rating = self::RPR_HURDLE;
            } elseif ($raceTypeSubGroup == self::RACE_GROUP_CHASE) {
                $adjustment = 6;
                $official_rating = self::RPR_CHASE;
            }
        } else {
            $type = 2;
        }

        foreach ($horsesRating as $horse) {
            if (isset($horse[$official_rating]) && $raceTypeSubGroup != self::RACE_GROUP_NHF) {
                switch ($type) {
                    case 1:
                        $rpr = $this->searchNearest(
                            $horse[$official_rating] + $adjustment
                            + $this->runners[$horse['horse_uid']]->extra_weight_lbs,
                            $this->getRprArray($horse)
                        );
                        $this->runners[$horse['horse_uid']]->rp_postmark = $rpr;
                        break;
                    case 2:
                        $this->runners[$horse['horse_uid']]->rp_postmark = $horse['rpr_max_400'];
                        break;
                }
            } else {
                $runners[$horse['horse_uid']]->rp_postmark = max($this->getRprArray($horse));
            }
        }
    }

    /**
     * Retrieves RPRs as array from the runner object
     *
     * @param array $runnerArr
     * @param string  $pattern
     *
     * @return array
     */
    private function getRprArray(array $runnerArr, string $pattern = 'rpr_'): array
    {
        $scores = null;
        array_walk(
            $runnerArr,
            function ($value, $key) use (&$scores, $pattern) {
                if (strpos($key, $pattern) === 0) {
                    $scores[] = $value;
                }
            }
        );

        return $scores;
    }

    /**
     * Searches for the value in RPR array closest to OR
     *
     * @param int   $needle
     * @param array $haystack
     *
     * @return int
     */
    private function searchNearest(int $needle, array $haystack): int
    {
        $nearest = 0;
        $minDiff = PHP_INT_MAX;
        foreach ($haystack as $rpr) {
            if (is_null($rpr)) {
                continue;
            }
            $diff = abs($needle - $rpr);
            if ($minDiff >= $diff) {
                $minDiff = $diff;
                $nearest = $rpr;
            }
        }

        return $nearest;
    }
}
