<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/10/2015
 * Time: 4:29 PM
 */

namespace Models\Bo\OwnerProfile;

class Statistics extends \Models\Statistics
{
    protected function initLocalParams()
    {
        $this->setId($this->getRequest()->getOwnerId());
        $this->setEntityName('owner');
        $this->setKey('owner_uid');
        $this->setErrorCode(6107);
        $this->setMapper(new \Api\Row\OwnerProfile\Statistics());
    }

    /**
     * @return array|null
     */
    protected function getStatisticsResult()
    {
        switch ($this->getStatisticsTypeCode()) {
            case "distance":
                return $this->getStatisticsByDistance();
            case "course":
                return $this->getStatisticsByCourse();
            case "month":
                return $this->getStatisticsByMonth();
            case "jockey":
                return $this->getStatisticsByJockey();
            case "trainer":
                return $this->getStatisticsByTrainer();
            case "horse":
                return $this->getStatisticsByHorse();
            case "race-type":
                return $this->getStatisticsByRaceType();
            case "age-of-horse":
            case "race-category":
                return $this->getStatisticsByCategory();
            case "race-class":
                return $this->getStatisticsByRaceClass();
            default:
                return null;
        }
    }

    /**
     * @return array
     */
    private function getStatisticsByJockey()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --second>>category = es.category_name
                , group_id = es.jockey_uid
                , group_name = j.style_name
                , rides = SUM(rides)
                , wins = SUM(wins)
                , place_2nd_number = SUM(place_2nd_number)
                , place_3rd_number = SUM(place_3rd_number)
                , place_4th_number = SUM(place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stake)
                , placed = SUM(placed)
            FROM
                #{$this->getEntityStatsTmpTableName()} es
                , jockey j
            WHERE es.jockey_uid = j.jockey_uid
            GROUP BY
                --second>>es.category_name,
                es.jockey_uid,
                j.style_name
            ORDER BY 5 DESC, 4, 3
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * @return array
     */
    private function getStatisticsByTrainer()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --second>>category = es.category_name
                , group_id = es.trainer_uid
                , group_name = t.style_name
                , rides = SUM(rides)
                , wins = SUM(wins)
                , place_2nd_number = SUM(place_2nd_number)
                , place_3rd_number = SUM(place_3rd_number)
                , place_4th_number = SUM(place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stake)
                , placed = SUM(placed)
            FROM
                #{$this->getEntityStatsTmpTableName()} es
                , trainer t
            WHERE es.trainer_uid = t.trainer_uid
            GROUP BY
                --second>>es.category_name,
                es.trainer_uid,
                t.style_name
            ORDER BY 5 DESC, 4, 3
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * @return array
     */
    private function getStatisticsByHorse()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --second>>category = es.category_name
                , group_id = es.horse_uid
                , group_name = h.style_name
                , rides = SUM(rides)
                , wins = SUM(wins)
                , place_2nd_number = SUM(place_2nd_number)
                , place_3rd_number = SUM(place_3rd_number)
                , place_4th_number = SUM(place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stake)
                , placed = SUM(placed)
            FROM
                #{$this->getEntityStatsTmpTableName()} es
                , horse h
            WHERE es.horse_uid = h.horse_uid
            GROUP BY
                --second>>es.category_name,
                es.horse_uid,
                h.style_name
            ORDER BY 5 DESC, 4, 3
        ";

        return $this->aggregateQueries($sql);
    }
}
