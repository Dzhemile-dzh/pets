<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;

/**
 * Class SeasonsAvailable
 *
 * @package Api\DataProvider\Bo\Bloodstock\Stallion
 */
class SeasonsAvailable extends Stallion
{
    /**
     * @return \Api\Row\Bloodstock\Stallion\ProgenyHorses[]|null
     */
    public function getSeasonsAvailable()
    {
        $seasons = $this->seasonsAvailableWithCondition(false);

        return $seasons;
    }

    /**
     * @param bool $onlyGbIre
     *
     * @return \Api\Row\Bloodstock\Stallion\ProgenyHorses[]|null
     */
    protected function seasonsAvailableWithCondition($onlyGbIre = true)
    {
        $request = $this->getRequest();
        $builder = new Builder();
        $builder->setRequest($request);
        if ($onlyGbIre) {
            $builder->innerJoin(
                "course c ON c.course_uid = tmp.course_uid AND c.country_code IN ('GB', 'IRE')"
            );
        } else {
            $builder->innerJoin(
                "course c ON c.course_uid = tmp.course_uid"
            );
        }

        $builder->setSqlTemplate("
            SELECT
                season_type =
                    CASE
                        WHEN tmp.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                        ELSE '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                    END
                , s.season_start_date
                , s.season_end_date
                , s.season_desc
            FROM
                /*{EXPRESSION(tmpTableStallionCommonData)}*/ tmp
            INNER JOIN
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
                " . Builder::TEMPLATE_JOINS . "
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
            ORDER BY
                1, 2 DESC
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan c)(t_scan tmp))'
        ");
        $builder->expression(
            "tmpTableStallionCommonData",
            $this->getTmpTableStallionCommonData()->getTemporaryTable()
        );

        if ($request->isParameterSet('activeSeasons')) {
            $builder->where("s.current_season_yn = 'Y' AND s.season_end_date > getdate()");
        }

        $builder->setRow(
            new \Api\Row\Bloodstock\Stallion\ProgenyHorses()
        );

        $result = $this->queryBuilder($builder);

        return $result->toArrayWithRows('season_type', null, true) ?: null;
    }
}
