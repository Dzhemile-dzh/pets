<?php

namespace Api\DataProvider\Bo\Profile;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\HorsesRequest as Request;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;

/**
 * Class RecordByRaceType
 *
 * @package Api\DataProvider\Bo\Profile
 */
abstract class RecordByRaceType extends HorsesDataProvider
{
    const TABLE_RECORD_BY_RACE_TYPE = 'record_by_race_type';
    const TABLE_BEST_RPR = 'best_rpr';
    const FIELD_GROUP = 'group_name';

    private $request;

    /**
     * Temporary table object for today races
     *
     * @var TmpBuilder|null
     */
    private $tmpTableRecordByRaceType = null;

    /**
     * Temporary table object for Best RPR
     *
     * @var TmpBuilder|null
     */
    private $tmpTableBestsRpr = null;

    /**
     * @return \Phalcon\Mvc\Model\Row\General
     */
    abstract public function getRow();

    /**
     * @return string The string for WHERE clause
     */
    abstract protected function getWhereClause();

    /**
     * @return array An array that contains placeholders for WHERE clause
     */
    abstract protected function getPlaceHolders();

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTableRecordByRaceType(): TmpBuilder
    {
        if (!isset($this->tmpTableRecordByRaceType)) {
            $this->tmpTableRecordByRaceType = $this->createTmpTableRecordByRaceType();
        }

        return $this->tmpTableRecordByRaceType;
    }

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTableBestsRpr(): TmpBuilder
    {
        if (!isset($this->tmpTableBestsRpr)) {
            $this->tmpTableBestsRpr = $this->createTmpTableBestRpr();
        }

        return $this->tmpTableBestsRpr;
    }

    /**
     * @param Request $request
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     * @throws \Exception
     */
    public function getRecordByRaceType(Request $request)
    {
        $this->setRequest($request);
        return $this->retrieveResult();
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General[]
     * @throws \Exception
     */
    private function retrieveResult()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                rbrt." . static::FIELD_GROUP . ",
                brpr.best_rp_postmark,
                brpr.best_horse_uid,
                brpr.best_horse_name,
                brpr.best_horse_country_origin_code,
                placed = SUM(
                    CASE WHEN
                        (rbrt.race_outcome_position = 2 AND rbrt.total_runners > 4)
                        OR (rbrt.race_outcome_position = 3 AND rbrt.total_runners > 7)
                        OR (rbrt.race_outcome_position = 4 AND rbrt.total_runners > 15
                            AND rbrt.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . ")
                    THEN 1 ELSE 0 END
                ),
                horses = (
                    SELECT COUNT(DISTINCT horse_uid)
                    FROM /*{EXPRESSION(tmpTableRBRT)}*/
                    WHERE " . static::FIELD_GROUP . " = rbrt." . static::FIELD_GROUP . "
                ),
                winners = (
                    SELECT COUNT(DISTINCT horse_uid)
                    FROM /*{EXPRESSION(tmpTableRBRT)}*/
                    WHERE " . static::FIELD_GROUP . " = rbrt." . static::FIELD_GROUP . "
                        AND race_outcome_position = 1
                ),
                total_horses = (
                    SELECT COUNT(DISTINCT horse_uid)
                    FROM /*{EXPRESSION(tmpTableRBRT)}*/
                ),
                total_winners = (
                    SELECT COUNT(DISTINCT horse_uid)
                    FROM /*{EXPRESSION(tmpTableRBRT)}*/
                    WHERE race_outcome_position = 1
                ),
                races_number = COUNT(rbrt.race_instance_uid),
                place_1st_number = SUM(CASE WHEN rbrt.race_outcome_position = 1 THEN 1 ELSE 0 END),
                place_2nd_number = SUM(CASE WHEN rbrt.race_outcome_position = 2 THEN 1 ELSE 0 END),
                place_3rd_number = SUM(CASE WHEN rbrt.race_outcome_position = 3 THEN 1 ELSE 0 END),
                place_4th_number = SUM(CASE WHEN rbrt.race_outcome_position = 4 THEN 1 ELSE 0 END),
                win_prize = SUM(rbrt.win_prize),
                total_prize = SUM(rbrt.total_prize),
                euro_win_prize = SUM(rbrt.euro_win_prize),
                euro_total_prize = SUM(rbrt.euro_total_prize),
                net_win_prize_money = SUM(rbrt.net_win_prize_money),
                net_total_prize_money = SUM(rbrt.net_total_prize_money),
                stake = SUM(CASE WHEN rbrt.race_outcome_position = 1
                                    THEN    CASE WHEN rbrt.final_race_outcome_uid = 71
                                                THEN (rbrt.odds_value / 2) - 0.50
                                                ELSE rbrt.odds_value
                                            END
                                    ELSE -1
                             END)
            FROM /*{EXPRESSION(tmpTableRBRT)}*/ rbrt,
                 /*{EXPRESSION(tmpTableBestRpr)}*/ brpr
            WHERE
                rbrt." . static::FIELD_GROUP . " = brpr." . static::FIELD_GROUP . "
            GROUP BY
                rbrt." . static::FIELD_GROUP . ",
                brpr.best_rp_postmark,
                brpr.best_horse_uid,
                brpr.best_horse_name,
                brpr.best_horse_country_origin_code
        ");

        $builder->expression("tmpTableRBRT", $this->getTmpTableRecordByRaceType()->getTemporaryTable());
        $builder->expression("tmpTableBestRpr", $this->getTmpTableBestsRpr()->getTemporaryTable());
        $builder->setRow($this->getRow());
        $result = $this->queryBuilder($builder);

        return $result->toArrayWithRows(static::FIELD_GROUP);
    }

    protected function createTmpTableRecordByRaceType()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                " . static::FIELD_GROUP . " = {$this->getGroupName()},
                ri.race_instance_uid,
                rg.race_group_code,
                total_runners = (
                    SELECT COUNT(race_instance_uid)
                    FROM horse_race
                    WHERE race_instance_uid = hr.race_instance_uid
                ),
                win_prize = CONVERT(money, isnull(
                    CASE WHEN ro.race_outcome_position = 1
                        THEN CASE WHEN c.country_code = 'IRE'
                            THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                            ELSE rip.prize_sterling END
                        ELSE 0 END, 0)),
                total_prize = CONVERT(money, isnull(
                    CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                        ELSE rip.prize_sterling END, 0)),
                net_win_prize_money = isnull(
                    CASE WHEN ro.race_outcome_position = 1
                        THEN rip.prize_sterling
                    END, 0),
                net_total_prize_money = isnull(rip.prize_sterling, 0),
                euro_win_prize = isnull(
                    CASE WHEN c.country_code = 'IRE' AND ro.race_outcome_position = 1
                        THEN rip.prize_euro_gross
                        ELSE 0 END, 0),
                euro_total_prize = isnull(CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross END, 0),
                ro.race_outcome_position,
                ro.rp_race_outcome_desc,
                o.odds_value,
                ri.race_type_code,
                hr.rp_postmark,
                hr.horse_uid,
                hr.final_race_outcome_uid
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM horse_race hr
                JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                JOIN horse h ON h.horse_uid = hr.horse_uid
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_AND_VOID_CODES . ")
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid
                    AND rip.position_no = ro.race_outcome_position
                LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN country_currencies cc ON cc.country_code = 'EUR' AND year(ri.race_datetime) = cc.year
            WHERE /*{WHERE}*/

            PLAN '(use optgoal allrows_dss)'
        ");
        $builder->where($this->getWhereClause());

        $params = $this->getPlaceHolders();
        foreach ($params as $param => $val) {
            $builder->setParam($param, $val);
        }

        return new TmpBuilder($builder, static::TABLE_RECORD_BY_RACE_TYPE);
    }

    protected function createTmpTableBestRpr()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT DISTINCT
                a." . static::FIELD_GROUP . ",
                best_rp_postmark = a.rp_postmark,
                best_horse_uid = a.horse_uid,
                best_horse_name = h.style_name,
                best_horse_country_origin_code = h.country_origin_code
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM /*{EXPRESSION(tmpTableRBRT)}*/ a
                LEFT JOIN /*{EXPRESSION(tmpTableRBRT)}*/ b
                        ON a." . static::FIELD_GROUP . " = b." . static::FIELD_GROUP . "
                        AND (
                            isnull(a.rp_postmark, 0) < isnull(b.rp_postmark, 0)
                            OR
                            (a.rp_postmark = b.rp_postmark AND a.horse_uid > b.horse_uid)
                         )
                LEFT JOIN horse h ON h.horse_uid = a.horse_uid
            WHERE b." . static::FIELD_GROUP . " IS NULL
        ");
        $builder->expression("tmpTableRBRT", $this->getTmpTableRecordByRaceType()->getTemporaryTable());

        return new TmpBuilder($builder, static::TABLE_BEST_RPR);
    }

    /**
     * @method getGroupNameFlat
     * @method getGroupNameJumps
     */
    private function getGroupName()
    {
        $methodName = 'getGroupName' . ucfirst($this->getRequest()->getRaceType());
        return $this->{$methodName}();
    }

    /**
     * @return string
     */
    private function getGroupNameFlat()
    {
        $ageSql = $this->getSelectors()->getHorseAgeSQL(
            "h.horse_date_of_birth",
            "h.country_origin_code",
            "ri.race_datetime"
        );

        return "
                (
                    CASE
                        WHEN ({$ageSql}) = 2 THEN '2YO'
                        WHEN ({$ageSql}) = 3 THEN '3YO'
                        ELSE '4YO+'
                    END
                    +
                    CASE WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . " THEN ' TURF'
                         WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . " THEN ' AW'
                    END
                )
            ";
    }

    /**
     * @return string
     */
    private function getGroupNameJumps()
    {
        return "(
                    CASE
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_NHF . ") THEN 'NHF'
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_HURDLE . ") THEN 'HURDLE'
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_CHASE . ") THEN 'CHASE'
                    END
                )";
    }

    protected function getSelectors()
    {
        return \Phalcon\DI::getDefault()->getShared('selectors');
    }
}
