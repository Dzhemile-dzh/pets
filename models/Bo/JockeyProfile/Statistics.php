<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.10.2014
 * Time: 13:52
 */

namespace Models\Bo\JockeyProfile;

class Statistics extends \Models\Statistics
{
    protected function initLocalParams()
    {
        $this->setId($this->getRequest()->getJockeyId());
        $this->setEntityName('jockey');
        $this->setKey('jockey_uid');
        $this->setErrorCode(6107);
        $this->setMapper(new \Api\Row\JockeyProfile\Statistics());
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
            case "trainer":
                return $this->getStatisticsByTrainer();
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
                , place_2nd_number = SUM(es.place_2nd_number)
                , place_3rd_number = SUM(es.place_3rd_number)
                , place_4th_number = SUM(es.place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stake)
                , placed = SUM(es.placed)
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
}
