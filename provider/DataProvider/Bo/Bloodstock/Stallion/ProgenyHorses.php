<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;
use Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyHorses as Request;
use Api\Input\Request\Horses\Bloodstock\Stallion\DamSireProgenyHorses as DamSireProgenyHorsesRequest;

/**
 * Class ProgenyHorses
 *
 * @package Api\DataProvider\Bo\Bloodstock\Stallion
 */
class ProgenyHorses extends HorsesDataProvider
{
    const TABLE_PROGENY_HORSES = 'progeny_horses';

    /**
     * Temporary table object
     *
     * @var TmpBuilder|null
     */
    private static $tmpTable = null;

    /**
     * @var Request
     */
    private $request;

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return TmpBuilder
     * @throws \Exception
     */
    public function getTmpTableProgenyHorses(): TmpBuilder
    {
        if (is_null(self::$tmpTable)) {
            self::$tmpTable = $this->createTemporaryTable();
        }

        return self::$tmpTable;
    }

    /**
     * @return TmpBuilder
     * @throws \Exception
     */
    protected function createTemporaryTable()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                h.horse_uid
                , h.style_name
                , h.horse_sex_code
                , h.horse_date_of_birth
                , country_origin_code = ltrim(rtrim(h.country_origin_code))
                , c.country_code
                , h.sire_uid
                , h.dam_uid
                , hr.final_race_outcome_uid
                , hr.rp_postmark
                , hr.rp_topspeed
                , hr.official_rating_ran_off
                , ri.race_instance_uid
                , ri.race_group_uid
                , ri.race_type_code
                , ri.race_datetime
                , ri.ages_allowed_uid
                , ri.race_instance_title
                , ri.distance_yard
                , ri.going_type_code
                , ri.no_of_runners
                , ri.course_uid
                , race_outcome_position = CASE
                    WHEN
                        hr.final_race_outcome_uid IN (51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 121)
                    THEN
                        0
                    ELSE
                        CASE
                            WHEN hr.final_race_outcome_uid > 70
                            THEN hr.final_race_outcome_uid - 70
                            ELSE hr.final_race_outcome_uid
                        END
                END
                , current_official_rating = (
                    SELECT
                    CASE
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . "
                            THEN rh.current_official_turf_rating
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . "
                            THEN rh.current_official_aw_rating
                        ELSE CASE
                            WHEN rh.current_official_rating_chase > rh.current_official_rating_hurdle
                              OR rh.current_official_rating_hurdle IS NULL
                            THEN rh.current_official_rating_chase
                            ELSE rh.current_official_rating_hurdle
                        END
                    END
                    FROM racing_horse rh WHERE rh.horse_uid = hr.horse_uid
                )
            INTO
                 " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM
                horse h
            INNER JOIN
                horse_race hr ON hr.horse_uid = h.horse_uid
            INNER JOIN
                race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
            INNER JOIN
                course c ON c.course_uid = ri.course_uid
            /*{EXPRESSION(damSireProgenyHorses)}*/
            WHERE
                /*{WHERE}*/
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_AND_VOID_IDS . ")
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            PLAN '(use optgoal allrows_dss)(use merge_join off)'
        ");

        if ($this->getRequest() instanceof DamSireProgenyHorsesRequest) {
            $damSireProgenyHorsesSql = '
                INNER JOIN
                    horse d ON d.horse_uid = h.dam_uid
                INNER JOIN
                    horse ds ON ds.horse_uid = d.sire_uid
            ';
            $builder->expression('damSireProgenyHorses', $damSireProgenyHorsesSql);
            $builder->where('ds.horse_uid = :horseId');
        } else {
            $builder->where('h.sire_uid = :horseId');
        }

        $builder->where('ri.race_type_code IN (:raceTypeCodes)');
        $builder->setParam('raceTypeCodes', $this->getRequest()->getRaceTypeCodes());

        $builder->where('ri.race_datetime BETWEEN :dateFrom AND :dateTo');
        $builder->setParam('dateFrom', $this->getRequest()->getSeasonDateBegin());
        $builder->setParam('dateTo', $this->getRequest()->getSeasonDateEnd());

        $builder->setParam('horseId', $this->getRequest()->getStallionId());

        return new TmpBuilder($builder, static::TABLE_PROGENY_HORSES);
    }


    /**
     * @param Request $request
     * @param bool $orderByBestOr
     * @return array
     * @throws \Exception
     */
    public function getProgenyHorses(Request $request, bool $orderByBestOr)
    {
        $this->setRequest($request);

        /** @var Selectors $selectors */
        $selectors = $this->getDI()->getShared('selectors');
        $numberParam = $request->getNumber();

        $builder = new Builder();
        $builder->setRequest($request);
        $builder->setSqlTemplate("
            SELECT
                /*{EXPRESSION(limitNumber)}*/
                t.horse_uid
                , t.style_name
                , t.horse_date_of_birth
                , t.horse_sex_code
                , horse_age = /*{EXPRESSION(horseAge)}*/
                , t.country_origin_code
                , t.runs
                , t.wins
                , t.places
                , t.total_prize_money
                 /*{EXPRESSION(sirefields)}*/
                , dam_sire_uid = ds.horse_uid
                , dam_sire_style_name = ds.style_name
                , dam_sire_country_origin_code = ds.country_origin_code
                , t.rp_postmark
                , best_or = CASE
                    WHEN t.max_current_official_rating < t.max_official_rating
                    THEN t.max_official_rating
                    ELSE t.max_current_official_rating
                END
            FROM (
                SELECT
                    tmp.horse_uid
                    , tmp.style_name
                    , tmp.horse_sex_code
                    , tmp.horse_date_of_birth
                    , tmp.country_origin_code
                    , tmp.sire_uid
                    , tmp.dam_uid
                    , runs = COUNT(*)
                    , wins = SUM(CASE WHEN tmp.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END)
                    , places = SUM(CASE WHEN tmp.final_race_outcome_uid IN (2, 3, 72, 73) THEN 1 ELSE 0 END)
                    , total_prize_money = SUM(rip.prize_sterling)
                    , rp_postmark = MAX(tmp.rp_postmark)
                    , max_official_rating = MAX(tmp.official_rating_ran_off)
                    , max_current_official_rating = MAX(tmp.current_official_rating)
                FROM
                    /*{EXPRESSION(tmpTableProgenyHorses)}*/ tmp
                    LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = tmp.race_instance_uid
                        AND rip.position_no = tmp.race_outcome_position
                WHERE
                    tmp.race_type_code IN ( :raceTypeCodes)
                    AND tmp.race_datetime BETWEEN :dateFrom AND :dateTo
                GROUP BY
                    tmp.horse_uid
                    , tmp.style_name
                    , tmp.horse_sex_code
                    , tmp.horse_date_of_birth
                    , tmp.country_origin_code
                    , tmp.sire_uid
                    , tmp.dam_uid
                ) t
                /*{EXPRESSION(sireJoin)}*/
                INNER JOIN horse d ON d.horse_uid = t.dam_uid
                INNER JOIN horse ds ON ds.horse_uid = d.sire_uid
            /*{WHERE}*/
            /*{ORDER}*/
        ");

        $builder->expression(
            "tmpTableProgenyHorses",
            $this->getTmpTableProgenyHorses()->getTemporaryTable()
        );

        if ($this->getRequest() instanceof DamSireProgenyHorsesRequest) {
            $sirefields = '
                , sire_uid = s.horse_uid
                , sire_style_name = s.style_name
                , sire_country_origin_code = s.country_origin_code
            ';
            $builder->expression('sirefields', $sirefields);
            $builder->expression('sireJoin', ' INNER JOIN horse s ON s.horse_uid = t.sire_uid');
        }

        if ($orderByBestOr) {
            $builder->orderBy('ORDER BY best_or DESC');
        }

        if (!is_infinite($numberParam)) {
            $builder->expression('limitNumber', ' TOP ' . ($numberParam + 1));
        }

        $horseAgeSql = $selectors->getHorseAgeSql(
            't.horse_date_of_birth',
            't.country_origin_code',
            '\'' . $request->getSeasonDateEnd() . '\''
        );
        $builder->expression("horseAge", $horseAgeSql);

        if ($request->isParameterSet('age')) {
            $age = $request->getAge();
            $grSign = '';
            if ((strpos($age, '+') > 0)) {
                $age = substr($age, 0, -1);
                $grSign = '>';
            }
            $builder->where($horseAgeSql . $grSign . '= :age:');
            $builder->setParam('age', intval($age));
        }

        $builder->setParam('dateFrom', $request->getSeasonDateBegin());
        $builder->setParam('dateTo', $request->getSeasonDateEnd());
        $builder->setParam('raceTypeCodes', $request->getRaceTypeCodes());

        $builder->setRow(new \Api\Row\Bloodstock\Stallion\ProgenyHorses());
        $arrayRows = $this->queryBuilder($builder)->toArrayWithRows();

        $availableMore = false;

        if (count($arrayRows) === $numberParam + 1) {
            $availableMore = true;
            array_pop($arrayRows);
        } elseif (empty($arrayRows)) {
            $arrayRows = null;
        }

        return [$arrayRows, $availableMore];
    }

    /**
     * Clear static tmp table
     */
    public static function clear()
    {
        self::$tmpTable = null;
    }
}
