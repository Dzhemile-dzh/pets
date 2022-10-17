<?php

namespace Api\DataProvider\Bo\Profile\Owner;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\TmpTable;
use Api\Input\Request\Horses\Profile\Owner\SeasonsAvailable as Request;
use Phalcon\Db\Sql\Builder;

/**
 * Class SeasonsAvailable
 *
 * @package Api\DataProvider\Bo\OwnerProfile
 */
class SeasonsAvailable extends TmpTable
{
    /**
     *  Name of tmp table
     */
    const TMP_TABLE_NAME = 'tmp_seasons_available_owner';
    /**
     * @var Request
     */
    private $request;

    /**
     * We are using tmp table instead of plain sql due to 2 possible calls
     *
     * @param Request $request
     *
     * @return \Phalcon\Mvc\Model\Row\General[]|null
     */
    public function getSeasonsAvailableData(Request $request)
    {
        $seasons = $this->seasonsAvailableWithCondition($request);
        if (empty($seasons)) {
            $seasons = $this->seasonsAvailableWithCondition($request, false);
        }
        return $seasons;
    }

    /**
     * @param      $request
     * @param bool $onlyGbIre
     *
     * @return \Phalcon\Mvc\Model\Row\General[]|null
     */
    protected function seasonsAvailableWithCondition($request, $onlyGbIre = true)
    {
        $this->setRequest($request);
        $tmpTable = $this->getTmpTable();

        $builder = new Builder();
        $builder->setRequest($request);

        $builder->setSqlTemplate("
            SELECT
                season_type =
                    CASE WHEN tmp.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                        ELSE '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                    END
                , s.season_start_date
                , s.season_end_date
                , s.season_desc
                , c.country_code
            FROM
                {$tmpTable} tmp
            JOIN
                season s ON season_type_code = CASE
                    WHEN tmp.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                    THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                    ELSE
                        CASE WHEN tmp.country_code = 'IRE'
                            THEN '" . Constants::SEASON_TYPE_CODE_JUMPS_IRE . "'
                            ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                        END
                    END
                    AND tmp.race_datetime BETWEEN s.season_start_date AND s.season_end_date
            JOIN
                course c ON c.course_uid = tmp.course_uid /*{EXPRESSION(onlyGbIre)}*/
            WHERE
                c.course_type_code !=
                    CASE
                        WHEN tmp.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . Constants::COURSE_TYPE_JUMPS_CODE . "'
                        ELSE '" . Constants::COURSE_TYPE_FLAT_CODE . "'
                    END
                /*{WHERE}*/
            GROUP BY
                CASE WHEN tmp.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                    THEN '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                    ELSE '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                END
                , s.season_start_date
                , s.season_end_date
                , s.season_desc
                , c.country_code
            ORDER BY
                1, 2 DESC
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan c)(t_scan tmp))'
        ");

        if ($onlyGbIre) {
            $builder->expression("onlyGbIre", " AND c.country_code IN ('GB', 'IRE')");
        }

        $builder->setRow(
            new \Phalcon\Mvc\Model\Row\General()
        );

        $result = $this->queryBuilder($builder);

        return $result->toArrayWithRows('season_type', null, true) ?: null;
    }

    /**
     * @inheritdoc
     */
    protected function createTmpTable()
    {
        $this->execute(
            "SELECT
                c.country_code
                , ri.race_type_code
                , ri.race_datetime
                , ri.course_uid
            INTO
                #{$this->getTmpTableName()}
            FROM
                horse_race hr
            JOIN
                race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
            JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                hr.owner_uid = :ownerId:
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            ",
            [
                'ownerId' => $this->getRequest()->getOwnerId(),
            ],
            false
        );
    }

    /**
     * @return Request
     */
    private function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    private function setRequest($request)
    {
        $this->request = $request;
    }
}
