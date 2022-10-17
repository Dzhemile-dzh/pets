<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;

class ProgenyResults extends Stallion
{
    /**
     * @return \Api\Row\Bloodstock\Stallion\ProgenyResults[]|null
     * @throws \Exception
     */
    public function getProgenyResults()
    {
        $request = $this->getRequest();

        $builder = new Builder($request);
        $builder->setSqlTemplate(
            "
            SELECT
                tmp.horse_uid
                , tmp.country_origin_code
                , tmp.style_name
                , tmp.rp_postmark
                , tmp.rp_topspeed
                , tmp.official_rating_ran_off
                , tmp.race_instance_uid
                , tmp.race_datetime
                , tmp.race_instance_title
                , tmp.distance_yard
                , tmp.race_type_code
                , tmp.going_type_code
                , tmp.no_of_runners
                , rg.race_group_desc
                , rg.race_group_code
                , tmp.race_outcome_position
                , ro.race_outcome_code
                , c.country_code
                , c.course_uid
                , c.style_name AS course_name
                , prize_money = rip.prize_sterling
                , prize_money_euro = (CASE WHEN cc.exchange_rate != NULL THEN rip.prize_sterling * cc.exchange_rate ELSE NULL END)
                , actual_race_class = (
                    SELECT race_attrib_lookup.race_attrib_desc
                    FROM race_attrib_join
                    LEFT JOIN race_attrib_lookup ON
                        race_attrib_join.race_attrib_uid = race_attrib_lookup.race_attrib_uid
                        AND (
                          c.country_code = 'GB'
                            AND race_attrib_lookup.race_attrib_code = " . Constants::RACE_CLASS_SUB . "
                          OR c.country_code != 'GB'
                            AND race_attrib_lookup.race_attrib_code = " . Constants::RACE_CLASS. "
                        )
                    WHERE
                        race_attrib_join.race_instance_uid = tmp.race_instance_uid
                        AND race_attrib_lookup.race_attrib_desc IS NOT NULL
                )
                , (
                    SELECT COUNT(*)
                    FROM horse_race hr1
                    WHERE hr1.race_instance_uid = tmp.race_instance_uid
                        AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                ) AS no_of_runners_calculated
                , aa.rp_ages_allowed_desc
                , c.rp_abbrev_3 AS course_rp_abbrev_3
            FROM
                /*{EXPRESSION(tmpTableStallionCommonData)}*/  tmp
            LEFT JOIN
                race_group rg ON rg.race_group_uid = tmp.race_group_uid
            LEFT JOIN
                race_instance_prize rip ON rip.race_instance_uid = tmp.race_instance_uid
            JOIN
                ages_allowed aa ON aa.ages_allowed_uid = tmp.ages_allowed_uid
            JOIN
                race_outcome ro ON ro.race_outcome_uid = tmp.final_race_outcome_uid
            JOIN
                course c ON c.course_uid = tmp.course_uid
            LEFT JOIN
                country_currencies cc ON cc.country_code = 'EUR' AND cc.year = YEAR(tmp.race_datetime)
            WHERE
                tmp.race_type_code IN (:raceTypeCodes)
                AND tmp.race_datetime BETWEEN :dateFrom AND :dateTo
                AND rip.position_no = 1
                AND c.country_code = :countryCode
                " . Builder::TEMPLATE_WHERE . "
            ORDER BY
                tmp.race_datetime DESC
            "
        );
        $builder->expression("tmpTableStallionCommonData", $this->getTmpTableStallionCommonData()->getTemporaryTable());
        $builder->setParam('dateFrom', $request->getSeasonDateBegin())
            ->setParam('dateTo', $request->getSeasonDateEnd())
            ->setParam('countryCode', $request->getCountryCode())
            ->setParam('raceTypeCodes', $request->getRaceTypeCodes());

        if ($request->isParameterSet('month')) {
            $builder->where(
                "datepart(month, tmp.race_datetime) = :month"
            );
            $builder->setParam('month', $request->getMonth());

            if ($request->getSeasonYearEnd() > $request->getSeasonYearBegin()) {
                $begin = (new \DateTime($request->getSeasonDateBegin()))->modify('first day of this month');
                $end = (new \DateTime($request->getSeasonDateEnd()))->modify('first day of this month');
                $daterange = new \DatePeriod($begin, new \DateInterval('P1M'), $end);

                $countParticularSeasonMonth = 0;
                foreach ($daterange as $date) {
                    if (intval($date->format("m")) == intval($request->getMonth())) {
                        $countParticularSeasonMonth += 1;
                    }
                    if ($countParticularSeasonMonth > 1) {
                        $builder->where(
                            "YEAR(tmp.race_datetime) = YEAR(:dateTo)"
                        );
                        break;
                    }
                }
            }
        }

        if ($request->getGraded()) {
            $builder->where(
                "rg.race_group_uid IN (:big_race_groups)"
            );
            $builder->setParam('big_race_groups', Constants::$bigRaceGroups);
        }

        $builder->setRow(new \Api\Row\Bloodstock\Stallion\ProgenyResults());
        $result = $this->queryBuilder($builder);
        return $result->toArrayWithRows() ?: null;
    }
}
