<?php

namespace Models\Bo\RaceCards;

use Api\Constants\Horses as Constants;

class HorseRace extends \Models\HorseRace
{
    /**
     * @param array $horseIds
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getTopspeedLastYear(array $horseIds, array $raceTypeCodes)
    {
        $sql ="
            select
                hr.horse_uid
                , hr.rp_postmark
                , hr.rp_topspeed
                , c.course_uid
                , c.course_name
                , c.style_name course_style_name
                , c.rp_abbrev_4
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , ro.race_outcome_code
                , gt.services_desc
                , race_group_code = case when isnull(rg.race_group_code,'0') = '0' then null else rg.race_group_code end
                , no_runners = (
                    select count(hr3.race_instance_uid)
                    from horse_race hr3
                    where hr3.race_instance_uid = ri.race_instance_uid
                    and hr3.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                )
            from
                horse_race hr
                , race_outcome ro
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
                , race_group rg
                , (
                    select
                        hr.horse_uid
                        , race_datetime = max(ri.race_datetime)
                        , rp_postmark = max(hr.rp_postmark)
                    from
                        horse_race hr
                        , race_instance ri
                    where hr.horse_uid in (:horseIds:)
                        and hr.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                        and ri.race_instance_uid = hr.race_instance_uid
                        and ri.race_datetime > dateadd(yy, -1, getdate())
                        and ri.race_type_code like :raceTypeCodes:
                        and hr.rp_topspeed = (
                            select max(hr2.rp_topspeed)
                            from horse_race hr2, race_instance ri2
                            where hr2.horse_uid = hr.horse_uid
                                and hr2.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                                and ri2.race_instance_uid = hr2.race_instance_uid
                                and ri2.race_datetime > dateadd(yy, -1, getdate())
                                and ri2.race_type_code like :raceTypeCodes:
                        )
                    group by hr.horse_uid
                ) m
            where
                hr.horse_uid = m.horse_uid
                and hr.rp_postmark = m.rp_postmark
                and ri.race_datetime = m.race_datetime
                and ro.race_outcome_uid = hr.final_race_outcome_uid
                and hr.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                and ri.race_instance_uid = hr.race_instance_uid
                and ri.race_type_code like :raceTypeCodes:
                and c.course_uid = ri.course_uid
                and hrc.race_instance_uid =* hr.race_instance_uid
                and hrc.horse_uid =* hr.horse_uid
                and gt.going_type_code =* ri.going_type_code
                and ri.race_group_uid *= rg.race_group_uid
            order by ri.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIds' => $horseIds,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }


    /**
     * @param array $horseIds
     * @param string $rpGoingTypeDesc
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getTopspeedGoing(array $horseIds, $rpGoingTypeDesc, array $raceTypeCodes)
    {
        $sql ="
            select
                  hr.horse_uid
                , hr.rp_postmark
                , hr.rp_topspeed
                , c.course_uid
                , c.course_name
                , c.style_name course_style_name
                , c.rp_abbrev_4
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , ro.race_outcome_code
                , gt.services_desc
                , race_group_code = case when isnull(rg.race_group_code,'0') = '0' then null else rg.race_group_code end
                , no_runners = (select count(hr3.race_instance_uid)
                     from horse_race hr3
                     where hr3.race_instance_uid = ri.race_instance_uid
                     and hr3.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . "))
            from
                horse_race hr
                , race_outcome ro
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
                , race_group rg
            where
                hr.horse_uid in (:horseIds:)
                and hr.rp_topspeed =
                    (select max(hr2.rp_topspeed)
                     from horse_race hr2, race_instance ri2, going_type gt2
                     where
                         hr2.horse_uid = hr.horse_uid
                         and hr2.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                         and ri2.race_instance_uid = hr2.race_instance_uid
                         and ri2.race_type_code like :raceTypeCodes:
                         and gt2.going_type_code = ri2.going_type_code
                         and upper(gt2.rp_going_type_desc) = upper(:rpGoingTypeDesc:)
                    )
                and ro.race_outcome_uid = hr.final_race_outcome_uid
                and hr.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                and ri.race_instance_uid = hr.race_instance_uid
                and ri.race_type_code like :raceTypeCodes:
                and c.course_uid = ri.course_uid
                and hrc.race_instance_uid =* hr.race_instance_uid
                and hrc.horse_uid =* hr.horse_uid
                and gt.going_type_code = ri.going_type_code
                and upper(gt.rp_going_type_desc) = upper(:rpGoingTypeDesc:)
                and ri.race_group_uid *= rg.race_group_uid
            order by ri.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIds' => $horseIds,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
                'rpGoingTypeDesc' => $rpGoingTypeDesc
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param array $horseIds
     * @param array $raceTypeCodes
     * @param string $minDistance
     * @param string $maxDistance
     *
     * @return array
     */
    public function getTopspeedDistance(array $horseIds, array $raceTypeCodes, $minDistance, $maxDistance)
    {
        $sql ="
            select
                hr.horse_uid
                , hr.rp_postmark
                , hr.rp_topspeed
                , c.course_uid
                , c.course_name
                , c.style_name course_style_name
                , c.rp_abbrev_4
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , ro.race_outcome_code
                , gt.services_desc
                , race_group_code = case when isnull(rg.race_group_code,'0') = '0' then null else rg.race_group_code end
                , no_runners = (select count(hr3.race_instance_uid)
                     from horse_race hr3
                     where hr3.race_instance_uid = ri.race_instance_uid
                     and hr3.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                 )
            from
                horse_race hr
                , race_outcome ro
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
                , race_group rg
            where
                hr.horse_uid in (:horseIds:)
                and hr.rp_topspeed =
                    (
                        select max(hr2.rp_topspeed)
                        from horse_race hr2, race_instance ri2, going_type gt2
                        where
                            hr2.horse_uid = hr.horse_uid
                            and hr2.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                            and ri2.race_instance_uid = hr2.race_instance_uid
                            and ri2.race_type_code like :raceTypeCodes:
                            and gt2.going_type_code = ri2.going_type_code
                            and ri2.distance_yard between :minDistance: and :maxDistance:
                    )
                and ro.race_outcome_uid = hr.final_race_outcome_uid
                and hr.final_race_outcome_uid not in (" . Constants::NON_RUNNER_IDS . ")
                and ri.race_instance_uid = hr.race_instance_uid
                and ri.race_type_code like :raceTypeCodes:
                and c.course_uid = ri.course_uid
                and hrc.race_instance_uid =* hr.race_instance_uid
                and hrc.horse_uid =* hr.horse_uid
                and gt.going_type_code =* ri.going_type_code
                and ri.distance_yard between :minDistance: and :maxDistance:
                and ri.race_group_uid *= rg.race_group_uid
            order by ri.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIds' => $horseIds,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
                'minDistance' => $minDistance,
                'maxDistance' => $maxDistance,
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }


    /**
     * @param array $horseIds
     * @param array $raceTypeCodes
     * @param int $courseId
     *
     * @return array
     */
    public function getTopspeedCourse(array $horseIds, array $raceTypeCodes, $courseId)
    {
        $sql ="
            SELECT
                mts.horse_uid
                , mts.rp_postmark
                , mts.rp_topspeed
                , mts.course_uid
                , c.course_name
                , c.style_name AS course_style_name
                , c.rp_abbrev_4
                , mts.race_instance_uid
                , mts.race_datetime
                , mts.race_type_code
                , mts.race_instance_title
                , mts.distance_yard
                , hrc.rp_close_up_comment
                , ro.race_outcome_code
                , gt.services_desc
                , race_group_code = CASE
                    WHEN isnull(rg.race_group_code, '0') = '0'
                    THEN NULL ELSE rg.race_group_code END
                , no_runners = (SELECT COUNT(hr3.race_instance_uid)
                    FROM horse_race hr3
                    WHERE hr3.race_instance_uid = mts.race_instance_uid
                        AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            FROM
                (
                SELECT
                    hr.horse_uid
                    , hr.rp_postmark
                    , hr.rp_topspeed
                    , hr.final_race_outcome_uid
                    , ri.race_instance_uid
                    , ri.race_datetime
                    , ri.race_type_code
                    , ri.race_instance_title
                    , ri.distance_yard
                    , ri.going_type_code
                    , ri.race_group_uid
                    , ri.course_uid
                FROM
                    horse_race hr
                , race_instance ri
                WHERE
                    hr.horse_uid IN (:horseIds:)
                    AND hr.rp_topspeed =
                        (SELECT MAX(hr2.rp_topspeed)
                        FROM horse_race hr2, race_instance ri2, going_type gt2
                        WHERE
                            hr2.horse_uid = hr.horse_uid
                            AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                            AND ri2.race_instance_uid = hr2.race_instance_uid
                            AND ri2.race_type_code LIKE :raceTypeCodes:
                            AND gt2.going_type_code = ri2.going_type_code
                            AND ri2.course_uid = :courseId:
                        )
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND ri.race_instance_uid = hr.race_instance_uid
                    AND ri.race_type_code LIKE :raceTypeCodes:
                    AND ri.course_uid = :courseId:
                ) mts
                LEFT JOIN race_outcome ro ON ro.race_outcome_uid = mts.final_race_outcome_uid
                LEFT JOIN horse_race_comments hrc ON hrc.race_instance_uid = mts.race_instance_uid
                    AND hrc.horse_uid = mts.horse_uid
                LEFT JOIN going_type gt ON gt.going_type_code = mts.going_type_code
                LEFT JOIN race_group rg ON rg.race_group_uid = mts.race_group_uid
                LEFT JOIN course c ON mts.course_uid = c.course_uid
            order by mts.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIds' => $horseIds,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
                'courseId' => $courseId,
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param int $horseId
     * @param array $raceTypeCodes
     * @param string $raceDate
     *
     * @return array
     */
    public function getLast6HorseRacesTopspeeds($horseId, array $raceTypeCodes, $raceDate)
    {
        $sql = "
            SELECT TOP 6
                race_instance.race_instance_uid,
                race_instance.race_datetime,
                horse_race.rp_topspeed,
                race_instance.race_type_code,
                course.course_uid,
                course.course_name,
                course.rp_abbrev_4,
                course.style_name course_style_name,
                race_instance.distance_yard,
                going_type.services_desc,
                race_outcome.race_outcome_position,
                race_outcome.race_outcome_code,
                horse_race.rp_postmark,
                horse_race_comments.rp_close_up_comment,
                race_group_code = case
                    when isnull(race_group.race_group_code,'0') = '0'
                    then null else race_group.race_group_code
                end,
                (
                    SELECT COUNT(hr.race_instance_uid)
                    FROM horse_race hr
                    WHERE
                        hr.race_instance_uid = race_instance.race_instance_uid
                        AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                ) AS no_runners

            FROM horse_race
            JOIN race_instance ON horse_race.race_instance_uid = race_instance.race_instance_uid
            JOIN course ON course.course_uid = race_instance.course_uid
            JOIN going_type ON going_type.going_type_code = race_instance.going_type_code
            JOIN race_outcome ON
                race_outcome.race_outcome_uid = horse_race.final_race_outcome_uid
                AND race_outcome.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            LEFT JOIN horse_race_comments ON
                horse_race_comments.race_instance_uid = horse_race.race_instance_uid
                AND horse_race_comments.horse_uid = horse_race.horse_uid
            LEFT JOIN race_group ON
                race_instance.race_group_uid = race_group.race_group_uid
            WHERE
                horse_race.horse_uid = :horseId:
                AND race_instance.race_datetime < :raceDate:
                AND race_instance.race_type_code LIKE :raceTypeCodes:

            ORDER BY race_instance.race_datetime DESC
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseId' => $horseId,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
                'raceDate' => $raceDate,
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $collection->toArrayWithRows();
    }
}
