<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.10.2014
 * Time: 13:52
 */

namespace Models\Bo\TrainerProfile;

class Statistics extends \Models\Statistics
{
    protected function initLocalParams()
    {
        $this->setId($this->getRequest()->getTrainerId());
        $this->setEntityName('trainer');
        $this->setKey('trainer_uid');
        $this->setErrorCode(6107);
        $this->setMapper(new \Api\Row\TrainerProfile\Statistics());
    }

    /**
     * @return array|null
     */
    protected function getStatisticsResult()
    {
        switch ($this->getStatisticsTypeCode()) {
            case "distance":
                return  $this->getStatisticsByDistance();
            case "course":
                return  $this->getStatisticsByCourse();
            case "month":
                return  $this->getStatisticsByMonth();
            case "jockey":
                return  $this->getStatisticsByJockey();
            case "race-type":
                return  $this->getStatisticsByRaceType();
            case "age-of-horse":
            case "race-category":
                return  $this->getStatisticsByCategory();
            case "race-class":
                return  $this->getStatisticsByRaceClass();
            default:
                return  null;
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
                , stake = SUM(stake)
                , total_prize = SUM(total_prize)
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
}
