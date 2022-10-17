<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Api\Constants\Horses as Constants;
use Models\Selectors;
use Phalcon\Mvc\DataProvider;
use Api\Input\Request\HorsesRequest;

class ProgenyStatisticsTop extends DataProvider
{
    /**
     * @param string $sql
     * @param int    $top
     *
     * @return string
     */
    protected function findTopProgenySetTop($sql, $top)
    {
        return str_replace('{{TOP}}', (int)$top, $sql);
    }

    /**
     * @param string $sql
     * @param bool   $isNeedProgenySire
     *
     * @return string
     */
    protected function findTopProgenySetFields($sql, $isNeedProgenySire)
    {
        $sqlFields = $isNeedProgenySire
            ? ' ,sire_uid = h3.horse_uid
                ,sire_style_name = h3.style_name
                ,sire_country_origin_code = h3.country_origin_code'
            : '';

        return str_replace('{{FIELDS}}', $sqlFields, $sql);
    }

    /**
     * @param string $sql
     * @param bool   $isNeedProgenySire
     * @param string $category
     *
     * @return string
     */
    protected function findTopProgenySetJoin($sql, $isNeedProgenySire, $category)
    {
        $sqlFrom = "";
        if ($isNeedProgenySire) {
            $sqlFrom .= " INNER JOIN horse h3 ON h3.horse_uid = h.sire_uid";
        }

        $goTypes = ['Heavy' => 1, 'Soft' => 2, 'Gd-sft' => 3, 'Good' => 4, 'Gd-fm' => 5, 'Firm' => 6];
        if ($category == '2yo') {
            $sqlFrom .= " INNER JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
                AND aa.rp_ages_allowed_desc = '2yo'";
        } elseif (array_key_exists($category, $goTypes)) {
            $sqlFrom .= " INNER JOIN going_type gt ON ri.going_type_code = gt.going_type_code
                AND gt.rp_going_type_value = {$goTypes[$category]}";
        }

        return str_replace('{{JOIN}}', $sqlFrom, $sql);
    }

    /**
     * @param string $sql
     * @param bool   $isBroodmareSireId
     *
     * @return string
     */
    protected function findTopProgenySetKey($sql, $isBroodmareSireId)
    {
        return str_replace('{{KEY}}', $isBroodmareSireId ? 'h2.horse_uid' : 'h.sire_uid', $sql);
    }

    /**
     * @param string    $sql
     * @param string    $category
     * @param Selectors $selectors
     * @param array     $params
     *
     * @return string
     */
    protected function findTopProgenySetWhere($sql, $category, Selectors $selectors, &$params)
    {
        $distance = $selectors->getDistance();
        $legacyDistanceSelector = $distance->getDistanceByRaceType('bloodstock');

        $sqlWhereAnd = '';
        if ($category == 'First Crop') {
            $sqlWhereAnd = " AND YEAR(h.horse_date_of_birth) = (
                SELECT
                    YEAR(MIN(h.horse_date_of_birth))
                FROM
                    horse h
                JOIN
                    horse_race hr ON hr.horse_uid = h.horse_uid
                JOIN
                    race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                        AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                        AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                JOIN
                    course c ON ri.course_uid = c.course_uid
                WHERE
                    h.sire_uid = :horseUid:
                    AND ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                    AND ri.race_datetime BETWEEN :dateBegin: AND :dateEnd:
                    AND c.country_code IN ('GB' , 'IRE')
             )
            ";
        }

        if (isset($legacyDistanceSelector[$category])) {
            $val = $legacyDistanceSelector[$category];
            if ($val['from'] && $val['to']) {
                $sqlWhereAnd = "AND ri.distance_yard BETWEEN :from: AND :to:";
                $params['from'] = $val['from'];
                $params['to'] = $val['to'];
            } elseif ($val['from']) {
                $sqlWhereAnd = "AND ri.distance_yard >= :from:";
                $params['from'] = $val['from'];
            } else {
                $sqlWhereAnd = "AND ri.distance_yard <= :to:";
                $params['to'] = $val['to'];
            }
        }

        return str_replace('{{WHERE}}', $sqlWhereAnd, $sql);
    }

    /**
     * @param string $sql
     * @param bool   $isNeedProgenySire
     *
     * @return string
     */
    protected function findTopProgenySetGroupBy($sql, $isNeedProgenySire)
    {
        $sqlGroupBy = $isNeedProgenySire
            ? ' ,h3.horse_uid
                ,h3.style_name
                ,h3.country_origin_code'
            : '';

        return str_replace('{{GROUP BY}}', $sqlGroupBy, $sql);
    }

    /**
     * @param string $category
     *
     * @return array
     */
    protected function findTopProgenyGetCountryCode($category)
    {
        return $category === '2yo'
            ? ['GB', 'IRE', 'FR', 'GER', 'ITY', 'SWE', 'NOR', 'DEN', 'TUR', 'SPA']
            : ['GB', 'IRE'];
    }

    /**
     * @param string    $category
     * @param Selectors $selectors
     *
     * @return array
     */
    protected function findTopProgenyGetRaceTypeCode($category, Selectors $selectors)
    {
        $category = strtolower($category);
        switch ($category) {
            case 'all-weather':
                $raceType = 'flat';
                $type = 'aw';
                break;
            case 'turf':
                $raceType = 'flat';
                $type = $category;
                break;
            case 'jumps':
                $raceType = $category;
                $type = null;
                break;
            case 'hurdle':
            case 'chase':
            case 'nhf':
                $raceType = 'jumps';
                $type = $category;
                break;
            default:
                $raceType = 'flat';
                $type = null;
        }
        return $selectors->getRaceTypeCode($raceType, $type);
    }

    /**
     * @param HorsesRequest $request
     *
     * @return \Phalcon\Mvc\Model\Row[]
     */
    public function getWorldwideG1Progeny(HorsesRequest $request)
    {
        $top = (int)$request->getStatisticsLimit();

        $sql = "
        SELECT TOP {$top}
            horse_style_name = h.style_name
            , horse_country_origin_code = h.country_origin_code
            , hr.horse_uid
            , dam_sire_uid = hds.horse_uid
            , dam_sire_style_name = hds.style_name
            , dam_sire_country_origin_code = hds.country_origin_code
            , rp_postmark = MAX(hr.rp_postmark)
            , runs =  COUNT(ro.race_outcome_position)
            , wins = ISNULL(SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),0)
            , total_prize_money = SUM(rip.prize_sterling)
        FROM
            horse_race hr,
            horse h,
            horse hd,
            horse hds,
            race_instance ri,
            race_group rg,
            race_outcome ro
            LEFT JOIN race_instance_prize rip ON
                rip.race_instance_uid = ri.race_instance_uid
                AND rip.position_no = ro.race_outcome_position
        WHERE
            ri.race_datetime between :dateBegin: and :dateEnd:
            AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            AND ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
            AND rg.race_group_uid = ri.race_group_uid
            AND (case when isnull(rg.race_group_desc,'N') = 'N' then char(63) else rg.race_group_desc end)
                in ('Group 1','Grade 1','Grade 1 Handicap')
            AND hr.race_instance_uid = ri.race_instance_uid
            AND ro.race_outcome_uid = hr.final_race_outcome_uid
            AND h.horse_uid = hr.horse_uid
            AND h.sire_uid = :horseUid:
            AND hd.horse_uid = h.dam_uid
            AND hds.horse_uid = hd.sire_uid
            AND h.dam_uid is not null
        GROUP BY
            h.style_name
            , h.country_origin_code
            , hr.horse_uid
            , hds.style_name
            , hds.country_origin_code
            , hds.horse_uid
        ORDER BY
            rp_postmark DESC
            , h.style_name
        ";

        $result = $this->query(
            $sql,
            [
                'horseUid' => $request->getStallionId(),
                'dateBegin' => $request->getStartDate(),
                'dateEnd' => $request->getEndDate()
            ]
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param HorsesRequest $request
     *
     * @return \Phalcon\Mvc\Model\Row[]
     */
    public function getEuroStakesProgeny(HorsesRequest $request)
    {
        $top = (int)$request->getStatisticsLimit();

        $sql = "
            SELECT TOP {$top}
                horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , h.horse_uid
                , dam_sire_uid = ds.horse_uid
                , dam_sire_style_name = ds.style_name
                , dam_sire_country_origin_code = ds.country_origin_code
                , rp_postmark = MAX(hr.rp_postmark)
                , runs = COUNT(ro.race_outcome_position)
                , wins = ISNULL(SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),0)
                , total_prize_money = SUM(rip.prize_sterling)
            FROM
                horse_race hr,
                horse h,
                horse d,
                horse ds,
                race_instance ri,
                course c,
                race_outcome ro
                LEFT JOIN race_instance_prize rip ON
                    rip.race_instance_uid = ri.race_instance_uid
                    AND rip.position_no = ro.race_outcome_position
            WHERE
                h.sire_uid = :horseUid:
                AND ri.race_datetime between :dateBegin: and :dateEnd:
                AND d.horse_uid = h.dam_uid
                AND ds.horse_uid = d.sire_uid
                AND h.horse_uid = hr.horse_uid
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND hr.race_instance_uid = ri.race_instance_uid
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                AND c.course_uid = ri.course_uid
                AND c.country_code in (:countryCodes)
                AND ri.race_group_uid not in (0, 6)
            GROUP BY
                h.horse_uid
                , h.style_name
                , h.country_origin_code
                , ds.horse_uid
                , ds.style_name
                , ds.country_origin_code
            ORDER BY
                rp_postmark DESC
                , h.style_name
        ";

        $result = $this->query(
            $sql,
            [
                'horseUid' => $request->getStallionId(),
                'dateBegin' => $request->getStartDate(),
                'dateEnd' => $request->getEndDate(),
                'countryCodes' => $this->findTopProgenyGetCountryCode('2yo')
            ]
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param HorsesRequest $request
     * @param Selectors     $selectors
     * @param string|null   $category
     *
     * @return \Phalcon\Mvc\Model\Row[]
     */
    public function findTopProgeny(HorsesRequest $request, Selectors $selectors, $category = null)
    {
        $sql = "
            SELECT TOP {{TOP}}
                 h.horse_uid
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , dam_sire_uid = h2.horse_uid
                , dam_sire_style_name = h2.style_name
                , dam_sire_country_origin_code = h2.country_origin_code
                , rp_postmark = MAX(hr.rp_postmark)
                , runs = COUNT(ro.race_outcome_position)
                , wins = ISNULL(SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),0)
                , total_prize_money = SUM(rip.prize_sterling)
                {{FIELDS}}
            FROM horse h
                INNER JOIN horse_race hr ON hr.horse_uid = h.horse_uid
                INNER JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                INNER JOIN horse h1 ON h1.horse_uid = h.dam_uid
                INNER JOIN horse h2 ON h2.horse_uid = h1.sire_uid
                LEFT JOIN race_outcome ro ON ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                    AND ro.race_outcome_uid = hr.final_race_outcome_uid
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid
                    AND rip.position_no = ro.race_outcome_position
                {{JOIN}}
                INNER JOIN course c ON ri.course_uid = c.course_uid
            WHERE {{KEY}} = :horseUid:
                {{WHERE}}
                AND c.country_code IN (:countryCode:)
                AND ri.race_type_code IN (:raceTypeCode:)
                AND ri.race_datetime BETWEEN :dateBegin: AND :dateEnd:
            GROUP BY
                 h.horse_uid
                ,h.style_name
                ,h.country_origin_code
                ,h2.horse_uid
                ,h2.style_name
                ,h2.country_origin_code
                {{GROUP BY}}
            ORDER BY
                rp_postmark DESC,
                h.style_name ASC
        ";

        $params = [];
        $isNeedProgenySire = $category == 'broodmare-sires';

        $sql = $this->findTopProgenySetTop($sql, $request->getStatisticsLimit());
        $sql = $this->findTopProgenySetFields($sql, $isNeedProgenySire);
        $sql = $this->findTopProgenySetJoin($sql, $isNeedProgenySire, $category);
        $sql = $this->findTopProgenySetKey($sql, $isNeedProgenySire);
        $sql = $this->findTopProgenySetWhere($sql, $category, $selectors, $params);
        $sql = $this->findTopProgenySetGroupBy($sql, $isNeedProgenySire);

        $result = $this->query(
            $sql,
            array_merge(
                $params,
                [
                    'horseUid' => $request->getStallionId(),
                    'dateBegin' => $request->getStartDate(),
                    'dateEnd' => $request->getEndDate(),
                    'countryCode' => $this->findTopProgenyGetCountryCode($category),
                    'raceTypeCode' => $this->findTopProgenyGetRaceTypeCode($category, $selectors),
                ]
            )
        );

        return $result->toArrayWithRows();
    }
}
