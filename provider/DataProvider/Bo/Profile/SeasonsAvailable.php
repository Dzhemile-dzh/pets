<?php

namespace Api\DataProvider\Bo\Profile;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\TmpTable;
use Api\Input\Request\HorsesRequest as Request;
use Phalcon\Db\Sql\Builder;

/**
 * Class SeasonsAvailable
 *
 * @package Api\DataProvider\Bo\Profile
 */
abstract class SeasonsAvailable extends TmpTable
{
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
                season s ON season_type_code =
                    CASE WHEN tmp.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                        ELSE CASE
                            WHEN tmp.country_code = 'IRE'
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
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}
