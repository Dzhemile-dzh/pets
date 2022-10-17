<?php

namespace Models\Bo\Bloodstock\StallionBook;

use Api\Constants\Horses as Constants;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\Bloodstock\StallionBook
 */
class RaceInstance extends \Models\RaceInstance
{
    const STUD_COND_PRIVATE = 'PRIVATE';
    const STUD_COND_ON_APP = 'ON APPLICATION';
    const STUD_COND_PRICE_ON_APP = 'PRICE ON APPLICATION';
    const STUD_COND_POA = 'POA';

    /**
     * @param string $searchName
     *
     * @return mixed
     */
    private function getCleanName($searchName)
    {
        return str_replace([' ', '.', '´', '\'', '-', ','], '', $searchName);
    }

    /**
     * @param string $table_suffix
     *
     * @return string
     */
    private function getPrivateStudCondSQL($table_suffix = "")
    {
        return
            "(
                UPPER( " . $table_suffix . ".stud_fee_condition) LIKE '" . RaceInstance::STUD_COND_PRIVATE . "'
                OR UPPER( " . $table_suffix . ".stud_fee_condition) LIKE '" . RaceInstance::STUD_COND_ON_APP . "%'
                OR UPPER( " . $table_suffix . ".stud_fee_condition) LIKE '" . RaceInstance::STUD_COND_PRICE_ON_APP . "%'
                OR UPPER( " . $table_suffix . ".stud_fee_condition) LIKE '" . RaceInstance::STUD_COND_POA . "%'
            )
        ";
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param \Models\Selectors                $selectors
     *
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getSearchResult($request, $selectors)
    {

        $filters = $this->getFilters($request, $selectors);

        $sql = "
            SELECT TOP 5000
                h.horse_uid
                , h.style_name
                , h.country_origin_code
                , sire_uid = s.horse_uid
                , sire_style_name = s.style_name
                , sire_country_origin_code = s.country_origin_code
                , sire_line_uid = ss.horse_uid
                , sire_line_style_name = ss.style_name
                , sire_line_country_origin_code= ss.country_origin_code
                , st.stud_name
                , stud_country_code = rtrim(st.country_code)
                , stud_fee = snf.nomination_fee
                , year_to_stud = (SELECT MIN(snf2.year)
                                    FROM stallion_nomination_fees snf2
                                    WHERE snf2.horse_uid = snf.horse_uid)
                , snf.stud_fee_condition
                , fee_cur_code = cur.cur_code
                , exchange_rate = ccur.exchange_rate
                , ws.weatherbys_uid
                , weatherbys_api_uid = convert(INT, ws.weatherbys_uid)
                , private_flag = CASE WHEN (%s) THEN 1 ELSE 0 END
            FROM
                horse h
                %s
                LEFT JOIN horse s ON s.horse_uid = h.sire_uid
                LEFT JOIN horse ss ON ss.horse_uid = s.sire_uid
                LEFT JOIN stud st ON st.stud_uid = snf.stud_uid
                LEFT JOIN country_currencies ccur ON ccur.year = YEAR(getdate()) AND ccur.cur_uid = snf.cur_uid
                LEFT JOIN currencies cur ON cur.cur_uid = snf.cur_uid
                LEFT JOIN weatherbys_stallions ws ON ws.year = YEAR(getdate()) AND ws.sire_uid = h.horse_uid

            WHERE
                h.searchname NOT LIKE '00%%'
                AND h.horse_sex_code != '" . Constants::HORSE_SEX_CODE_GELDING . "'
                AND snf.horse_uid IS NOT NULL
                AND h.country_origin_code != :excludeCountry
                %s
            ORDER BY h.horse_uid
            PLAN '(use optgoal allrows_dss)"
            . "( join  ( i_scan ( table ( h horse ) ) ) ( i_scan ( table ( snf stallion_nomination_fees ))))'
        ";

        $sql = sprintf(
            $sql,
            $this->getPrivateStudCondSQL('snf'),
            $filters['tables'],
            $filters['cond']
        );

        $bindParams = [
            'excludeCountry' => 'ZIM',
        ];

        $res = $this->getReadConnection()->query(
            $sql,
            array_merge($bindParams, $filters['params'])
        );

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Bloodstock\StallionBook\SearchResult(),
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
    private function getFilters($request, $selectors)
    {
        $tables = '';
        $cond = '';
        $params = [];

        // Type
        if ($request->isParameterExists('type')) {
            switch ($request->getType()) {
                case 'weatherbys':
                    $tables .= "
                        JOIN stallion_nomination_fees snf ON snf.horse_uid = h.horse_uid
                             AND snf.year = (year(getdate()) + CASE WHEN month(getdate()) = 12 then 1 ELSE 0 END)
                    ";
                    $cond .= " AND ws.weatherbys_uid IS NOT NULL
                               AND (
                                    char_length(h.sire_comment) > 0
                                    OR (SELECT SUM(no_of_runs) FROM ss_stal_ssn WHERE horse_uid = s.horse_uid) > 0
                               )";
                    break;
                case 'inactive':
                    $tables .= " LEFT JOIN stallion_nomination_fees snf ON snf.horse_uid = h.horse_uid
                                    AND snf.year = (SELECT MAX(snf2.year)
                                                    FROM stallion_nomination_fees snf2
                                                    WHERE snf2.horse_uid = snf.horse_uid
                                                   )";
                    $cond .= "AND snf.year < (year(getdate()) + CASE WHEN month(getdate()) = 12 then 1 ELSE 0 END)";
                    break;
                default:
                    // active
                    $tables .= "
                        JOIN stallion_nomination_fees snf ON snf.horse_uid = h.horse_uid
                             AND snf.year = (year(getdate()) + CASE WHEN month(getdate()) = 12 then 1 ELSE 0 END)
                    ";
                    $cond .= " AND (
                                    snf.nomination_fee > 0
                                    OR " . $this->getPrivateStudCondSQL('snf') . "
                               )
                               AND (
                                    char_length(h.sire_comment) > 0
                                    OR (SELECT SUM(no_of_runs) FROM ss_stal_ssn WHERE horse_uid = s.horse_uid) > 0
                               )";
            }
        }

        // Stallion name
        if ($request->isParameterSet('stallion')) {
            $cond .= " AND h.searchname LIKE '%' + UPPER(:stallion:) + '%'";
            $params['stallion'] = $this->getCleanName($request->getStallion());
        }
        // Sire name (father of the stallion)
        if ($request->isParameterSet('sire')) {
            $cond .= " AND s.searchname " . (($request->getSireFlag() == 'include')
                    ? 'LIKE'
                    : 'NOT LIKE') . " '%' + UPPER(:sire:) + '%'";
            $params['sire'] = $this->getCleanName($request->getSire());
        }
        // Sire line (grand father of the stallion)
        if ($request->isParameterSet('sireLine') && $request->isParameterExists('sireLineFlag')) {
            $cond .= " AND ss.searchname " . (($request->getSireLineFlag() == 'include')
                    ? 'LIKE'
                    : 'NOT LIKE') . " '%' + UPPER(:sireLine:) + '%'";
            $params['sireLine'] = $this->getCleanName($request->getSireLine());
        }
        // Sire type ('All', 'First Crop Sires', etc - stallions with year to stud = current year)
        // If first fee in nomination table = 2013 then First Crop y.o.b = 2014
        // So, the first crop is a year from the second row in stallion_nomination_fees
        if ($request->isParameterSet('sireType') && $request->getSireType() != 'all') {
            switch ($request->getSireType()) {
                case 'firstCrop':
                    $cropNumber = 2;
                    break;
                case 'secondCrop':
                    $cropNumber = 3;
                    break;
                case 'thirdCrop':
                    $cropNumber = 4;
                    break;
            }
            $cond .= " AND :cropNumber: = (
                        SELECT COUNT(*)
                        FROM stallion_nomination_fees
                        WHERE
                            horse_uid = snf.horse_uid
                            AND year <= snf.year
                      ) ";
            $params['cropNumber'] = $cropNumber;
        }

        // Country code
        if ($request->isParameterSet('studCountryCode')) {
            $cond .= " AND st.country_code in (:studCountryCode:)";
            $params['studCountryCode'] = $request->getStudCountryCode();
        }
        // Stud farm name
        if ($request->isParameterSet('studFarm')) {
            $cond .= " AND UPPER(st.stud_name)  LIKE '%' + UPPER(:studFarm:) + '%'";
            $params['studFarm'] = $request->getStudFarm();
        }
        // Year to stud
        if ($request->isParameterSet('yearToStud')) {
            $cond .= " AND :yearToStud: = (
                            SELECT MIN(year)
                            FROM stallion_nomination_fees
                            WHERE horse_uid = snf.horse_uid
                       )";
            $params['yearToStud'] = $request->getYearToStud();
        }

        // Min/Max prices  (GBP)
        if ($request->isParameterSet('minPrice') || $request->isParameterSet('maxPrice')) {
            $minPrice = $request->isParameterSet('minPrice') ? $request->getMinPrice() : null;
            $maxPrice = $request->isParameterSet('maxPrice') ? $request->getMaxPrice() : null;
            $cond .= " AND (snf.nomination_fee / ccur.exchange_rate) ";

            if ($minPrice == $maxPrice) {
                $cond .= " = :maxPrice: ";
                $params['maxPrice'] = $maxPrice;
            } elseif ($minPrice && !$maxPrice) {
                $cond .= " >= :minPrice: ";
                $params['minPrice'] = $minPrice;
            } elseif ($maxPrice && !$minPrice) {
                $cond .= " <= :maxPrice: ";
                $params['maxPrice'] = $maxPrice;
            } else {
                $cond .= " BETWEEN :minPrice: AND :maxPrice: ";
                $params['minPrice'] = $minPrice;
                $params['maxPrice'] = $maxPrice;
            }
        }

        // Win distance
        if ($request->isParameterSet('distance')) {
            $selectors->getDistance()->setRaceType('legacy_alt'); // set legacy alternative distance list
            $dist = $selectors->getDistanceGroup($request->getDistance());

            $cond .= " AND  EXISTS (
                            SELECT 1
                            FROM race_instance ri
                                JOIN horse p ON p.sire_uid = h.horse_uid
                                JOIN horse_race hr ON
                                    hr.horse_uid = p.horse_uid
                                    AND ri.race_instance_uid = hr.race_instance_uid
                                    AND hr.final_race_outcome_uid IN (1, 71)
                                    AND ri.race_status_code =  " . Constants::RACE_STATUS_RESULTS . "
                                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                                    AND ri.distance_yard BETWEEN :distFrom: AND :distTo:
                     )";

            $params['distFrom'] = (empty($dist['from'])) ? 0 : $dist['from'];
            $params['distTo'] = (empty($dist['to'])) ? 32767 : $dist['to'];
        }

        // Progeny Success
        $filterSurfaces = [];
        if ($request->isParameterSet('turfWinners') && $request->getTurfWinners()) {
            $filterSurfaces = array_merge(
                $filterSurfaces,
                $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS, 'turf')
            );
        }
        if ($request->isParameterSet('allWeatherWinners') && $request->getAllWeatherWinners()) {
            $filterSurfaces = array_merge(
                $filterSurfaces,
                $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS, 'aw')
            );
        }
        if ($request->isParameterSet('chaseWinners') && $request->getChaseWinners()) {
            $filterSurfaces = array_merge($filterSurfaces, $selectors->getJumpsTypeCodes('chase'));
        }
        if ($request->isParameterSet('hurdleWinners') && $request->getHurdleWinners()) {
            $filterSurfaces = array_merge($filterSurfaces, $selectors->getJumpsTypeCodes('hurdle'));
        }
        if (!empty($filterSurfaces)) {
            $cond .= " AND EXISTS (
                            SELECT 1 FROM ss_stal_ssn
                            WHERE horse_uid = h.horse_uid
                            AND surface IN (:surfaces:) AND no_of_wins > 0
                       )";
            $params['surfaces'] = $filterSurfaces;
        }

        if ($request->isParameterSet('g1Winner') && $request->getG1Winner()
            || $request->isParameterSet('g2Winner') && $request->getG2Winner()
            || $request->isParameterSet('g3Winner') && $request->getG3Winner()
        ) {
            $attribIDs = [];
            $groupCodes = [];
            $eCond = '';

            $addCond = " AND EXISTS (
                            SELECT 1
                            FROM race_instance ri
                                LEFT JOIN race_attrib_join raj ON raj.race_instance_uid = ri.race_instance_uid
                                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                                JOIN horse p ON p.sire_uid = h.horse_uid
                                JOIN horse_race hr ON
                                    hr.horse_uid = p.horse_uid
                                    AND ri.race_instance_uid = hr.race_instance_uid
                                    AND hr.final_race_outcome_uid IN (1, 71)
                            WHERE
                                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                                %s
                       )";
            if ($request->isParameterSet('g1Winner') && $request->getG1Winner()) {
                $attribIDs[] = 210;
                $groupCodes[] = 1;
            }
            if ($request->isParameterSet('g2Winner') && $request->getG2Winner()) {
                $attribIDs[] = 211;
                $groupCodes[] = 2;
            }
            if ($request->isParameterSet('g3Winner') && $request->getG3Winner()) {
                $attribIDs[] = 212;
                $groupCodes[] = 3;
            }

            if (!empty($attribIDs) & !empty($groupCodes)) {
                $eCond = 'AND (raj.race_attrib_uid IN (:attibId) OR rg.race_group_code LIKE \'[\' + :groupCode +\']\')';
                $params['attibId'] = $attribIDs;
                $params['groupCode'] = implode(',', $groupCodes);
            }

            $cond .= sprintf($addCond, $eCond);
        }

        if ($request->isParameterSet('blackTypeWinners') && $request->getBlackTypeWinners()) {
            $cond .= " AND EXISTS (
                            SELECT 1
                            FROM race_instance ri
                                LEFT JOIN race_attrib_join raj ON raj.race_instance_uid = ri.race_instance_uid
                                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                                JOIN horse p ON p.sire_uid = h.horse_uid
                                JOIN horse_race hr ON
                                    hr.horse_uid = p.horse_uid
                                    AND ri.race_instance_uid = hr.race_instance_uid
                                    AND hr.final_race_outcome_uid IN (2, 72, 3, 73)
                            WHERE
                                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                                AND (raj.race_attrib_uid IN (210, 211, 212, 216) OR rg.race_group_code LIKE '[1234]')
                       )";
        }

        if ($request->isParameterSet('gradeWinners') && $request->getGradeWinners()) {
            $cond .= " AND EXISTS (
                            SELECT 1
                            FROM race_instance ri
                                JOIN horse p ON p.sire_uid = h.horse_uid
                                JOIN horse_race hr ON
                                    hr.horse_uid = p.horse_uid
                                    AND ri.race_instance_uid = hr.race_instance_uid
                                    AND hr.final_race_outcome_uid IN (1, 71)
                                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                                    AND ri.race_group_uid in (7, 8, 9, 11, 12, 13)
                       )";
        }

        return [
            'tables' => $tables,
            'cond' => $cond,
            'params' => $params,
        ];
    }
}
