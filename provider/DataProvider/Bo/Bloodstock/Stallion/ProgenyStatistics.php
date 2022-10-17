<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Phalcon\DI;
use Phalcon\Mvc\DataProvider;
use Api\Input\Request\HorsesRequest;
use Bo\Bloodstock\Stallion\ProgenyStatistics as Bo;
use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;

/**
 * Class ProgenyStatistics
 * @package Api\DataProvider\Bo\Bloodstock\Stallion
 */
class ProgenyStatistics extends DataProvider
{
    /**
     * @param HorsesRequest $request
     * @return array
     */
    public function getProgenyStatistics(HorsesRequest $request)
    {
        $builder = new Builder($request);
        $workHorseDb = DI::getDefault()->getShared('selectors')->getDb()->getWorkHorseDb();

        $builder->setSqlTemplate("
            SELECT
                category
                , no_of_wins
                , no_of_runs
                , no_of_2nds
                , no_of_3rds
                , no_of_winners
                , no_of_runners
                , win_prize_money
                , total_prize_money
                , section_name
            FROM (
                    SELECT
                        category
                        , no_of_wins
                        , no_of_runs
                        , no_of_2nds
                        , no_of_3rds
                        , no_of_winners
                        , no_of_runners
                        , win_prize_money
                        , total_prize_money
                        , 'current_year' section_name
                    FROM ss_stal_proj ht
                    WHERE horse_uid = :horseUid
                      AND category IN (:categoriesProgeny)
                      AND season = YEAR(getdate())

                UNION ALL

                    SELECT
                        ht.category
                        , ht.no_of_wins
                        , ht.no_of_runs
                        , ht.no_of_2nds
                        , ht.no_of_3rds
                        , ht.no_of_winners
                        , ht.no_of_runners
                        , win_prize_money
                        , total_prize_money
                        , (CASE
                                WHEN ht.category = 'Euro Stakes' THEN '2000_to_date'
                                WHEN ht.category = 'Worldwide G1' THEN '2000_to_date'
                                ELSE '1988_to_date'
                          END) section_name
                    FROM ss_stal_proj_summary ht
                    WHERE ht.horse_uid = :horseUid
                      AND ht.category IN (:categoriesProgenySummary)

                UNION ALL

                    SELECT
                        category = ss.going_type_code 
                        , no_of_wins = ISNULL(SUM(ss.wins), 0)
                        , no_of_runs = COUNT(ss.runs)
                        , no_of_2nds = ISNULL(SUM(ss.second_place), 0)
                        , no_of_3rds = ISNULL(SUM(ss.third_place), 0)
                        , no_of_winners = (
                            SELECT
                                COUNT(DISTINCT (ss2.horse_uid))
                            FROM
                                {$workHorseDb}..sstats_horse_own_jock_train ss2
                            WHERE
                                ss2.sire_uid = :horseUid
                                AND ss2.going_type_code = ss.going_type_code
                                AND ss2.country_code IN (:country)
                                AND ss2.wins = 1
                            )
                        , no_of_runners = COUNT(DISTINCT(ss.horse_uid))
                        , win_prize_money = ISNULL(SUM(ss.winnings_sterling), 0)
                        , total_prize_money = ISNULL(SUM(ss.earnings), 0)
                        , '1988_to_date' section_name
                    FROM {$workHorseDb}..sstats_horse_own_jock_train ss
                    WHERE 
                        ss.sire_uid = :horseUid
                        AND ss.going_type_code IN (:categoriesGoingType)
                        AND ss.country_code IN (:country)
                    GROUP BY ss.going_type_code
            ) union_table
            ORDER BY section_name DESC, category DESC
        ");

        $builder
            ->setParam('horseUid', $request->getStallionId())
            ->setParam('categoriesProgeny', Bo::getCategoriesProgeny())
            ->setParam('categoriesProgenySummary', Bo::getCategoriesProgenySummary())
            ->setParam('categoriesGoingType', Bo::getCategoriesGoingType())
            ->setParam('country', [Constants::COUNTRY_GB, Constants::COUNTRY_IRE]);

        $builder->build();

        $result = $this->query(
            $builder->getSql(),
            $builder->getParams(),
            new \Api\Row\Bloodstock\ProgenyStatistics(),
            false
        );

        return $result->toArrayWithRows();
    }
}
