<?php

namespace Models\Bo\Bloodstock\StallionStatistics;

use Api\Constants\Horses as Constants;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\Bloodstock\StallionStatistics
 */
class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param \Models\Selectors                $selectors
     *
     * @return array
     */
    public function getRatingStatistic($request, $selectors)
    {
        $workHorseDbName = $selectors->getDb()->getWorkHorseDb();
        $euroExchange = $selectors->getDb()->getEuroRateByYear(
            (new \DateTime($request->getSeasonDateBegin()))->format('Y')
        );

        $filters = $this->getRatingStatisticFilters($request, $selectors);
        $numberParam = $request->getNumber();
        $numberOfEntries = !is_null($numberParam) && !is_infinite($numberParam) ? (int)$numberParam : 5000;

        $sql = "
            SELECT TOP $numberOfEntries
                rt.*,
                sss.wins,
                sss.runs,
                sss.winnings_pound,
                sss.earnings_pound,
                sss.winnings_euro,
                sss.earnings_euro,
                sss.stake
            FROM (
                SELECT
                    h.style_name
                    , country_code = h.country_origin_code
                    , h.horse_uid
                    , horse_sex = h.horse_sex_code
                    , horse_age =  %s
                    , h.sire_uid
                    , sire_style_name = s.style_name
                    , sire_country_origin_code = s.country_origin_code
                    , thr.rpr
                    , best_or = CASE
                        WHEN thr.current_official_rating < thr.max_official_rating_ran_off
                        THEN thr.max_official_rating_ran_off
                        ELSE thr.current_official_rating
                    END
                    , thr.current_official_rating
                    , thr.trainer_uid
                    , trainer_style_name = (SELECT t.style_name FROM trainer t WHERE t.trainer_uid = thr.trainer_uid)
                FROM (
                    SELECT
                        hr.horse_uid
                        , hr.trainer_uid
                        , max_official_rating_ran_off = MAX(hr.official_rating_ran_off)
                        , rpr = MAX(hr.rp_postmark)
                        , current_official_rating = (
                            SELECT %s FROM racing_horse rh WHERE rh.horse_uid = hr.horse_uid
                        )
                    FROM
                        horse_race hr
                    WHERE
                        EXISTS (
                            SELECT 1
                            FROM
                                race_instance ri
                            WHERE
                                hr.race_instance_uid = ri.race_instance_uid
                                AND ri.race_datetime BETWEEN :seasonDateBegin: AND :seasonDateEnd:
                                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                AND ri.race_type_code IN (:raceTypeCodes:)
                                %s
                                AND EXISTS (
                                    SELECT 1 FROM course c WHERE c.course_uid = ri.course_uid
                                        %s
                                    )
                            )
                        AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        AND hr.rp_postmark > 0
                    GROUP BY
                        hr.horse_uid
                        , hr.trainer_uid
                ) AS thr
                JOIN horse h ON h.horse_uid = thr.horse_uid
                LEFT JOIN horse s ON s.horse_uid = h.sire_uid
                WHERE 1 = 1
                %s
            ) rt
            LEFT JOIN (
                SELECT
                    t.horse_uid
                    , t.trainer_uid
                    , wins = ISNULL(SUM(t.wins), 0)
                    , runs = COUNT(t.runs)
                    , winnings_pound = ISNULL(SUM(CASE WHEN t.country_code != 'IRE' THEN t.winnings ELSE t.winnings / {$euroExchange} END), 0)
                    , earnings_pound = ISNULL(SUM(CASE WHEN t.country_code != 'IRE' THEN t.earnings ELSE t.earnings / {$euroExchange} END), 0)
                    , winnings_euro = ISNULL(SUM(CASE WHEN t.country_code = 'IRE' THEN t.winnings ELSE t.winnings * {$euroExchange} END), 0)
                    , earnings_euro = ISNULL(SUM(CASE WHEN t.country_code = 'IRE' THEN t.earnings ELSE t.earnings * {$euroExchange} END), 0)
                    , stake = ISNULL(SUM(t.stake), 0)
                FROM (
                    SELECT
                        ri.horse_uid
                        , ri.country_code
                        , wins = ISNULL(ri.wins, 0)
                        , ri.runs
                        , ri.trainer_uid
                        , winnings = ISNULL(ri.winnings, 0)
                        , earnings = ISNULL(ri.earnings, 0)
                        , stake = ISNULL(ri.stake, 0)
                    FROM
                        {$workHorseDbName}..sstats_horse_own_jock_train ri
                    WHERE
                        ri.race_datetime BETWEEN :seasonDateBegin: AND :seasonDateEnd:
                        AND ri.race_type_code IN (:raceTypeCodes:)
                        %s
                    UNION
                    SELECT
                        ri.horse_uid
                        , ri.country_code
                        , wins = ISNULL(ri.wins, 0)
                        , ri.runs
                        , ri.trainer_uid
                        , winnings = ISNULL(ri.winnings, 0)
                        , earnings = ISNULL(ri.earnings, 0)
                        , stake = ISNULL(ri.stake, 0)
                    FROM
                        {$workHorseDbName}..sstats_int_ratings ri
                    WHERE
                        ri.race_datetime BETWEEN :seasonDateBegin: AND :seasonDateEnd:
                        AND ri.race_type_code IN (:raceTypeCodes:)
                        %s
                    ) t
                GROUP BY
                    t.horse_uid,
                    t.trainer_uid
            ) sss ON sss.horse_uid = rt.horse_uid AND sss.trainer_uid = rt.trainer_uid
            ORDER BY
                rt.rpr DESC
        ";
        $sql = sprintf(
            $sql,
            $selectors->getHorseAgeSql(
                'h.horse_date_of_birth',
                'h.country_origin_code',
                "'" . $request->getSeasonDateBegin() . "'"
            ),
            $this->getOfficialRatingField($request, $selectors),
            $filters['raceFilter'],
            $filters['countryFilter'],
            $filters['horseFilter'],
            $filters['raceFilter'],
            $filters['raceFilter']
        );

        $bindParams = [
            'raceTypeCodes' => $request->getRaceTypeCodes(),
            'seasonDateBegin' => $request->getSeasonDateBegin(),
            'seasonDateEnd' => $request->getSeasonDateEnd(),
        ];

        $res = $this->getReadConnection()->query(
            $sql,
            array_merge($bindParams, $filters['params'])
        );

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Bloodstock\Statistic\RatingStatistic(),
            $res
        );

        return $resultCollection->toArrayWithRows();
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param \Models\Selectors                $selectors
     *
     * @return array
     */
    private function getRatingStatisticFilters($request, $selectors)
    {
        $raceFilter = '';
        $horseFilter = '';
        $countryFilter = '';
        $params = [];

        if ($request->isParameterSet('countryFlag')) {
            switch ($request->getCountryFlag()) {
                case 'Europe':
                    $countryFilter .= " AND c.country_code IN ('GB','IRE','FR','GER','ITY','SWE','NOR','DEN','TUR','SPA')";
                    break;
                case 'GB':
                    $countryFilter .= " AND c.country_code = 'GB'";
                    break;
                case 'GB-IRE':
                    $countryFilter .= " AND c.country_code IN ('GB', 'IRE')";
                    break;
            }
        }

        if ($request->isParameterSet('distance')) {
            $distance = $request->getDistance();
            if (!empty($distance)) {
                $distance = preg_split("/-/", $distance);
                $raceFilter .= ' AND ri.distance_yard BETWEEN :distanceStart AND :distanceEnd';
                $params['distanceStart'] = (int)((!empty($distance[0])) ? $distance[0] : 0);
                $params['distanceEnd'] = (int)(($distance[1] > 0) ? $distance[1] : 9999);
            }
        }

        if ($request->isParameterSet('age')) {
            $age = $request->getAge();
            $horseAgeSql = $selectors->getHorseAgeSql(
                'h.horse_date_of_birth',
                'h.country_origin_code',
                "'{$request->getSeasonDateBegin()}'"
            );
            $horseFilter .= ' AND '
                . $horseAgeSql
                . ((strpos($age, '+') > 0) ? '>=' : '=')
                . ':age';
            $params['age'] = intval($age);
        }

        return [
            'raceFilter' => $raceFilter,
            'countryFilter' => $countryFilter,
            'horseFilter' => $horseFilter,
            'params' => $params,
        ];
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param \Models\Selectors                $selectors
     *
     * @return string
     */
    private function getOfficialRatingField($request, $selectors)
    {
        if ($request->getRaceType() == Constants::RACE_TYPE_FLAT_ALIAS) {
            switch ($request->getSurface()) {
                case 'aw':
                    $currentOr = "rh.current_official_aw_rating";
                    break;
                default:
                    $currentOr = "rh.current_official_turf_rating";
            }
        } else {
            $currentOr = "CASE
                              WHEN rh.current_official_rating_chase > rh.current_official_rating_hurdle
                                OR rh.current_official_rating_hurdle IS NULL
                              THEN rh.current_official_rating_chase
                              ELSE rh.current_official_rating_hurdle
                          END";
        }

        return $currentOr;
    }
}
