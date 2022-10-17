<?php

namespace Models\Bo\CourseProfile;

use Api\Result\Results\PastWinners;
use Phalcon\DI;
use Api\Constants\Horses as Constants;
use Api\Input\Request\Horses\Profile\Course as Request;
use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\DateTime;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row\General as Row;
use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as ConstantsHorses;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Phalcon\Mvc\ModelInterface;

/**
 * Class Course
 *
 * @package Models\Bo\CourseProfile
 */
class Course extends \Models\Course
{

    /**
     * Directions type codes
     */
    const DIRECTION_TYPE_AIR = 'A';
    const DIRECTION_TYPE_BUS = 'B';
    const DIRECTION_TYPE_ROAD = 'R';
    const DIRECTION_TYPE_RAIL = 'T';
    const DIRECTION_TYPE_RIVERBUS = 'W';

    /**
     * @param integer $courseId
     *
     * @return ModelInterface
     * @throws ResultsetException
     */
    public function getProfile($courseId)
    {
        $sql = "
            SELECT
                c.course_name,
                c.style_name AS course_style_name,
                cd.course_clerk,
                cd.course_tel,
                cd.course_scales_clerk,
                cd.course_judge,
                cd.course_stewards,
                cd.course_starters,
                c.course_type_code,
                country_code = rtrim(c.country_code)
            FROM course c
            LEFT JOIN course_details cd ON cd.course_uid = c.course_uid
            WHERE c.course_uid = :courseId:
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $courseId,
            ]
        );

        $courseProfile = (new ResultSet(null, new Row(), $res))->getFirst();

        return empty($courseProfile) ? null : $courseProfile;
    }

    /**
     * @param integer $courseId
     *
     * @return array
     */
    public function getUpcomingRaces($courseId)
    {
        $sql = "
            SELECT
                race_date,
                race_datetime_first,
                race_datetime_last,
                (SELECT race_instance_uid
                    FROM race_instance ri
                    WHERE ri.race_datetime = t.race_datetime_first
                        AND ri.course_uid = :courseId:) AS race_instance_uid_first,
                (SELECT race_instance_uid
                    FROM race_instance ri
                        WHERE ri.race_datetime = t.race_datetime_last
                        AND ri.course_uid = :courseId:) AS race_instance_uid_last

            FROM
            (
                SELECT
                    CONVERT(VARCHAR, race_instance.race_datetime, 101) AS race_date,
                    MIN(race_instance.race_datetime) AS race_datetime_first,
                    MAX(race_instance.race_datetime) AS race_datetime_last
                FROM course
                JOIN race_instance ON course.course_uid = race_instance.course_uid
                LEFT JOIN race_group rg1 ON rg1.race_group_uid = race_instance.race_group_uid
                WHERE
                    course.course_uid = :courseId
                    AND race_instance.race_datetime BETWEEN :dateBegin AND :dateEnd
                    AND race_instance.race_status_code NOT IN (" . Constants::RACE_STATUS_RESULTS . " , "
            . Constants::RACE_STATUS_ABANDONED . ")
                    AND NOT EXISTS (
                        SELECT *
                        FROM race_attrib_join
                        WHERE
                            race_attrib_join.race_instance_uid = race_instance.race_instance_uid
                            AND race_attrib_join.race_attrib_uid IN (:exclude)
                    )
                GROUP BY CONVERT(VARCHAR, race_instance.race_datetime, 101)
            ) t
        ";

        $dateBegin = new \DateTime();
        $dateEnd = new \DateTime();
        $dateEnd->add(\DateInterval::createFromDateString('1 month'));

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $courseId,
                'dateBegin' => $dateBegin->format('Y-m-d 00:00:00'),
                'dateEnd' => $dateEnd->format('Y-m-d 23:59:59'),
                'exclude' => [Constants::INCOMPLETE_CARD_ATTRIBUTE_ID, Constants::INCOMPLETE_RACE_ATTRIBUTE_ID],
            ]
        );

        $upcomingRaces = new ResultSet(null, new Row(), $res);

        $result = $upcomingRaces->toArrayWithRows();

        return empty($result) ? null : $result;
    }

    /**
     * @param $courseId
     * @param $raceTypeCodes
     *
     * @return object
     */
    public function getRecordsForStandardTimes($courseId, $raceTypeCodes)
    {

        $sql = "
          SELECT
                cr.race_type_code,
                cr.distance_yards,
                cr.straight_round_jubilee_code,
                cr.race_date,
                h.style_name AS horse_name,
                cr.horse_name AS course_record_horse_name,
                h.horse_uid,
                h.country_origin_code,
                aa.rp_ages_allowed_desc,
                cr.time_secs winners_time,
                dat.no_of_fences,
                dat.average_time_sec,
                race_instance_uid = (
                    SELECT hr.race_instance_uid
                    FROM horse_race hr
                    INNER JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                                                    AND ri.race_type_code = cr.race_type_code
                                                    AND ri.distance_yard = cr.distance_yards
                                                    AND ri.course_uid = cr.course_uid
                    WHERE hr.horse_uid = h.horse_uid
                    AND CONVERT(DATE, ri.race_datetime) = CONVERT(DATE, cr.race_date)
                )
            FROM course c
            INNER JOIN course_records cr ON cr.course_uid = c.course_uid
                AND cr.race_type_code != " . Constants::RACE_TYPE_P2P . "
            --'LEFT JOIN' statement below adds to our results redundant horses which we will delete further
            LEFT JOIN horse h ON h.horse_name = upper(
                CASE  WHEN charindex(' (', cr.horse_name) > 0
                    THEN substring(cr.horse_name, 1, charindex(' (', cr.horse_name))
                    ELSE cr.horse_name
                END)
            INNER JOIN ages_allowed aa ON aa.ages_allowed_uid = cr.ages_allowed_uid
            LEFT JOIN dist_ave_time dat ON dat.course_uid = c.course_uid
                AND dat.race_type_code = (CASE
                    WHEN cr.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . "
                    THEN  " . Constants::RACE_TYPE_CHASE_TURF . " ELSE cr.race_type_code END)
                AND dat.distance_yard = cr.distance_yards
                AND isnull(dat.straight_round_jubilee_code, ' ') = isnull(cr.straight_round_jubilee_code, ' ')
                AND dat.distance_yard = cr.distance_yards
            WHERE c.course_uid = :courseId:
                AND EXISTS (
                            SELECT 1
                            FROM race_instance ri
                            WHERE ri.course_uid = cr.course_uid
                                AND ri.distance_yard = cr.distance_yards
                                AND ri.race_status_code IN (" . Constants::RACE_STATUS_RESULTS . " , "
            . Constants::RACE_STATUS_ABANDONED . ")
                                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                                AND DATEDIFF(DAY, ri.race_datetime, GETDATE()) < 750
                    )
            AND isnull(cr.straight_round_jubilee_code, 'keep') != 'Z'
            ORDER BY
                cr.distance_yards
                , cr.race_type_code
        ";

        $res = $this->getReadConnection()->query($sql, ['courseId' => $courseId,]);
        $result = new ResultSet(null, new Row(), $res);

        $result = $result->toArrayWithRows();

        $f = array_fill_keys($raceTypeCodes[Constants::RACE_TYPE_FLAT_ALIAS], Constants::RACE_TYPE_FLAT_ALIAS);
        $j = array_fill_keys($raceTypeCodes[Constants::RACE_TYPE_JUMPS_ALIAS], Constants::RACE_TYPE_JUMPS_ALIAS);
        $bridgeCodeToRace = $f + $j;

        // the increments for different types of races
        $i = [Constants::RACE_TYPE_FLAT_ALIAS => 0, Constants::RACE_TYPE_JUMPS_ALIAS => 0];
        $rtn = (Object)[Constants::RACE_TYPE_FLAT_ALIAS => null, Constants::RACE_TYPE_JUMPS_ALIAS => null];

        foreach ($result as $row) {
            if (isset($bridgeCodeToRace[$row->race_type_code])) {
                $raceType = $bridgeCodeToRace[$row->race_type_code];
                // A 'course_record_horse_name' is unique in context of this response, so we remove duplications
                // with inconsistent data (without of race_instance_uid)
                if (isset($lastRow) && $row->course_record_horse_name === $lastRow->course_record_horse_name) {
                    if (is_null($row->race_instance_uid)) {
                        continue;
                    } else {
                        // we decrement it to rewrite row
                        $i[$raceType]--;
                    }
                }
                $i[$raceType]++;
                $rtn->{$raceType}[$i[$raceType]] = $row;
                $lastRow = $row;
            }
        }
        return $rtn;
    }

    /**
     * @param Request\PrincipleRaceResults $request
     *
     * @return array|null
     * @throws \Api\Exception\ValidationError
     * @throws \Exception
     */
    public function getPrincipleRaceResults(Request\PrincipleRaceResults $request)
    {
        $queryTpl = "
                SELECT
                    -->>>>>>> The code in comments below will be uncommented by a special function, only needed pieces will remain <<<<<<<

                    ri.race_instance_uid,
                    ri.race_instance_title,
                    ri.race_group_uid,
                    ri.race_datetime,
                    h.horse_uid,
                    h.style_name horse_style_name,
                    h.country_origin_code,
                    t.trainer_uid,
                    t.style_name trainer_style_name,
                    t.ptp_type_code,
                    rip.prize_sterling
                FROM
                    race_instance ri
                    INNER JOIN horse_race hr ON (hr.race_instance_uid = ri.race_instance_uid)
                    INNER JOIN horse h ON (hr.horse_uid = h.horse_uid)
                    INNER JOIN trainer t ON (t.trainer_uid = hr.trainer_uid)
                    INNER JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid
                        AND rip.position_no = 1
                WHERE
                    ri.course_uid = :courseId
                    AND ri.race_type_code IN (:raceTypeCodes)

                    -->>>>>>> The code in comments below will be uncommented by a special function, only needed pieces will remain <<<<<<<

                    --big-race>>AND (ri.race_group_uid in (1,2,3,4,7,8,9) OR rip.prize_sterling >= 60000.00)
                    AND ri.race_datetime BETWEEN :seasonBegin AND :seasonEnd
                    AND hr.final_race_outcome_uid IN (1, 71)
                    AND NOT EXISTS(
                        SELECT 1
                        FROM race_attrib_join raj
                        WHERE
                            raj.race_instance_uid = ri.race_instance_uid
                            AND raj.race_attrib_uid IN (:incompleteCard)
                    )
                ORDER BY rip.prize_sterling DESC, ri.race_datetime DESC
        ";

        $queryParam = [
            'courseId' => $request->getCourseId(),
            'seasonBegin' => (new \DateTime($request->getSeasonDateBegin()))->format('Y-m-d H:i:s'),
            'seasonEnd' => (new \DateTime($request->getSeasonDateEnd()))->format('Y-m-d H:i:s'),
            'raceTypeCodes' => $request->getRaceTypeCodes(),
            'incompleteCard' => ConstantsHorses::INCOMPLETE_CARD_ATTRIBUTE_ID
        ];

        $query = Selectors::purgeQuery($queryTpl, $request->getRaceStatusType());
        $queryRes = $this->getReadConnection()->query($query, $queryParam);
        $resultSet = new ResultSet(null, new Row(), $queryRes);
        $result = $resultSet->toArrayWithRows('race_instance_uid');

        return empty($result) ? null : $result;
    }

    /**
     * @param Request\PrincipleRaceResults $request
     * @param string                       $seasonDateBegin
     * @param string                       $seasonDateEnd
     *
     * @return bool
     * @throws \Exception
     * @throws ResultsetException
     */
    public function checkExistenceOfBigRaces(Request\PrincipleRaceResults $request, $seasonDateBegin, $seasonDateEnd)
    {
        $query = "
            SELECT
                bigRaceExist = (
                    CASE WHEN EXISTS (
                        SELECT ri.race_instance_uid
                        FROM
                            race_instance ri
                            INNER JOIN horse_race hr ON (hr.race_instance_uid = ri.race_instance_uid)
                            INNER JOIN trainer t ON (t.trainer_uid = hr.trainer_uid)
                            INNER JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid
                                AND rip.position_no = 1
                        WHERE
                            ri.course_uid = :courseId:
                            AND ri.race_type_code IN (:raceTypeCodes)
                            AND (ri.race_group_uid IN (1,2,3,4,7,8,9) OR rip.prize_sterling >= 60000.00)
                            AND ri.race_datetime BETWEEN :seasonBegin AND :seasonEnd
                            AND hr.final_race_outcome_uid IN (1, 71)
                    )
                    THEN 'Y'
                    ELSE 'N'
                    END
                )
        ";

        $res = $this->getReadConnection()->query(
            $query,
            [
                'courseId' => $request->getCourseId(),
                'seasonBegin' => $seasonDateBegin,
                'seasonEnd' => $seasonDateEnd,
                'raceTypeCodes' => $request->getRaceTypeCodes()
            ]
        );
        $result = new ResultSet(null, new Row(), $res);
        return $result->getFirst()->bigRaceExist == 'Y';
    }

    /**
     * @param HorsesRequest $request
     *
     * @return ModelInterface
     * @throws ResultsetException
     */
    public function getAdmission(HorsesRequest $request)
    {
        $sql = "
            SELECT
                cc.rp_admission_prices,
                cc.rp_children
            FROM
                course_comments cc
            WHERE
                cc.course_uid = :courseId";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $request->getCourseId()
            ]
        );

        $courseResult = (new ResultSet(null, new Row(), $res))->getFirst();

        return empty($courseResult) ? null : $courseResult;
    }

    /**
     * @param HorsesRequest $request
     *
     * @return ModelInterface
     * @throws ResultsetException
     */
    public function getDirections(HorsesRequest $request)
    {
        $sql = "
            SELECT
                cd.course_address,
                cc.rp_parking,
                cc.rp_disabled,
                v_road = (
                  SELECT direction
                  FROM course_directions cd
                  WHERE cd.course_uid = :courseId AND cd.direction_type_code = '" . self::DIRECTION_TYPE_ROAD . "'
                ),
                v_rail = (
                  SELECT direction
                  FROM course_directions cd
                  WHERE cd.course_uid = :courseId AND cd.direction_type_code = '" . self::DIRECTION_TYPE_RAIL . "'
                ),
                v_air = (
                  SELECT direction
                  FROM course_directions cd
                  WHERE cd.course_uid = :courseId AND cd.direction_type_code = '" . self::DIRECTION_TYPE_AIR . "'
                ),
                v_bus = (
                  SELECT direction
                  FROM course_directions cd
                  WHERE cd.course_uid = :courseId AND cd.direction_type_code = '" . self::DIRECTION_TYPE_BUS . "'
                ),
                v_riverbus = (
                  SELECT direction
                  FROM course_directions cd
                  WHERE cd.course_uid = :courseId AND cd.direction_type_code = '" . self::DIRECTION_TYPE_RIVERBUS . "'
                )
            FROM
                course_details cd
            JOIN
                course_comments cc ON cc.course_uid = cd.course_uid
            WHERE
                cd.course_uid = :courseId";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $request->getCourseId()
            ]
        );

        $courseResult = (new ResultSet(null, new Row(), $res))->getFirst();

        return empty($courseResult) ? null : $courseResult;
    }

    /**
     * @param int $courseId
     * @param int|null $raceTypeCode
     * @return array
     * @throws ResultsetException
     */
    public function getCourseMap($courseId, $raceTypeCode = null)
    {
        $builder = new Builder();
        // C and B race_type_code were excluded from the jump_comment condition
        // because they never will happen because of other query conditions
        $builder->setSqlTemplate("
            SELECT t.*,
            (CASE WHEN t.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN cc.rp_flat_course_comment ELSE (
              CASE WHEN t.race_type_code IN (" . Constants::RACE_TYPE_HURDLE_TURF . ",
                " . Constants::RACE_TYPE_HUNTER_CHASE . ",
                " . Constants::RACE_TYPE_NH_FLAT_AW . ")
                THEN cc.rp_jump_course_comment ELSE '' END
            ) END) course_comment,
            cc.rp_detailed_flat_desc,
            cc.rp_detailed_aw_desc,
            cc.rp_detailed_jump_desc,
            cc.rp_detailed_hurdle_desc,
            cc.rp_detailed_chase_desc

            FROM (
                SELECT DISTINCT
                       c.course_uid,
                       c.course_name,
                       c.latitude,
                       c.longitude,
                       c.zoom,
                       c.country_code,
                       c.course_type_code,
                       (CASE WHEN ri.race_type_code = " . Constants::RACE_TYPE_CHASE_TURF . "
                            THEN  " . Constants::RACE_TYPE_HUNTER_CHASE . " ELSE ri.race_type_code END) race_type_code,
                       (CASE WHEN c.rp_abbrev_3 = 'NMK'
                            THEN LOWER(srj.rp_straight_round_jubilee_desc) ELSE NULL END) straight_round_jubilee
                FROM course c
                     JOIN race_instance ri ON c.course_uid = ri.course_uid
                     LEFT JOIN straight_round_jubilee srj
                        ON ri.straight_round_jubilee_code = srj.straight_round_jubilee_code
                WHERE c.course_uid = :courseId
                AND   ri.race_type_code NOT IN (
                    " . Constants::RACE_TYPE_P2P . ",
                    " . Constants::RACE_TYPE_NHF . ",
                    " . Constants::RACE_TYPE_HURDLE_AW . ",
                    " . Constants::RACE_TYPE_CHASE_AW . ")
                AND YEAR(ri.race_datetime) > YEAR(GETDATE()) - 10
                /*{WHERE}*/
                AND   c.country_code IN ('GB','IRE')
        ) t JOIN course_comments cc ON t.course_uid = cc.course_uid
        ORDER BY t.race_type_code

        PLAN '(use optgoal allrows_mix) (nl_join (scan c) (scan ri) (scan srj))'
        ");

        // for racecards endpoint we need to map the race_type_code according to which type of race it is (AW, Chase or flat)
        // and we use the below conditions to override what we get from the above query for profile/course endpoint.
        if (!is_null($raceTypeCode)) {
            if ($raceTypeCode == Constants::RACE_TYPE_NH_FLAT_STR) {
                $raceTypeCode = Constants::RACE_TYPE_HURDLE_TURF_STR;
            } else if (in_array($raceTypeCode, Constants::RACE_TYPE_AW_ARRAY)) {
                $raceTypeCode = Constants::RACE_TYPE_FLAT_AW_STR;
            }
            $builder->where("ri.race_type_code = '$raceTypeCode'");
        }

        $builder->setParam('courseId', $courseId);

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $courseResult = new ResultSet(null, new Row(), $res);

        return $courseResult->toArrayWithRows();
    }

    /**
     * @param HorsesRequest $request
     *
     * @return mixed
     */
    public function getDefaultValues(HorsesRequest $request)
    {
        $sql = "
                SELECT course_type_code
                FROM course
                WHERE course_uid = :courseUid
            ";

        $result = $this->getReadConnection()->query(
            $sql,
            ['courseUid' => $request->getCourseId()]
        );

        $result = new ResultSet(null, new Row(), $result);

        return $result->getFirst();
    }


    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param string                           $countryCode
     *
     * @return array
     */
    public function getSeasonsAvailable(HorsesRequest $request, $countryCode = 'GB')
    {
        $builder = new Builder();
        $builderPartOne = new Builder();
        $builderPartTwo = new Builder();

        $builderPartOne->setRequest($request);
        $builderPartTwo->setRequest($request);


        $builderPartOne->setSqlTemplate("
            SELECT
                season_type = '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                , s.season_start_date
                , s.season_end_date
                , s.season_desc
            FROM race_instance ri
                INNER JOIN season s ON season_type_code = '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                    AND ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                INNER JOIN course c ON c.course_uid = ri.course_uid
            WHERE ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                AND ri.course_uid = :courseId
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND c.course_type_code != '" . Constants::COURSE_TYPE_JUMPS_CODE . "'
                /*{WHERE}*/
            GROUP BY
                s.season_start_date
                , s.season_end_date
                , s.season_desc
        ");

        $builderPartTwo->setSqlTemplate("
            SELECT
                season_type = '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                , s.season_start_date
                , s.season_end_date
                , s.season_desc
            FROM race_instance ri
                INNER JOIN season s ON season_type_code = :seasonJumpsCode
                    AND ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
            WHERE ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ")
                AND ri.course_uid = :courseId
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                /*{WHERE}*/
            GROUP BY
                s.season_start_date
                , s.season_end_date
                , s.season_desc
            ORDER BY 1, 2 DESC
        ");

        if ($request->isParameterSet('activeSeasons')) {
            $condition = 's.current_season_yn = \'Y\' AND s.season_end_date > GETDATE()';
            $builderPartOne->where($condition);
            $builderPartTwo->where($condition);
        }

        $seasonCode = ($countryCode == 'IRE')
            ? Constants::getConstantValue(Constants::SEASON_TYPE_CODE_JUMPS_IRE)
            : Constants::getConstantValue(Constants::SEASON_TYPE_CODE_JUMPS);

        $builderPartOne->setParam('seasonJumpsCode', $seasonCode);
        $builderPartTwo->setParam('seasonJumpsCode', $seasonCode);

        $builder->unionAll([$builderPartOne, $builderPartTwo]);

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $courseResult = new ResultSet(null, new Row(), $res);

        $result = $courseResult->toArrayWithRows('season_type', null, true);

        return empty($result) ? null : $result;
    }

    /**
     *
     * We use this function to get the season's top trainers, owners or jockeys.
     * They are in three different endpoints: top-owners, top-trainers and top-jockeys.
     * The sql is completely the same, we must pass in only the kind of entity we wish
     * to get for the designated endpoint.
     *
     * @param $entity * The field and table name we wish to get
     * @return string
     */
    public function getTopEntitySql(string $entity)
    {
        $ageSql = DI::getDefault()
            ->getShared('selectors')
            ->getHorseAgeSQL('h.horse_date_of_birth', 'h.country_origin_code', 'ri.race_datetime');
        $sql = "
            SELECT
                hr.{$entity}_uid,
                hr.{$entity}_name,
                hr.style_name,
                hr.ptp_type_code,
                hr.course_uid,
                no_of_runs = COUNT(hr.race_outcome_position),
                no_of_wins = SUM(CASE WHEN hr.final_race_outcome_uid in (1, 71) THEN 1 ELSE 0 END),
                stake = " . DI::getDefault()->getShared('selectors')->getSqlForStake() . ",
                race_type
                /*{COLUMNS}*/
            FROM
                (SELECT  
                    main.{$entity}_uid,
                    main.{$entity}_name,
                    main.style_name,
                    main.ptp_type_code,
                    ri.race_type_code,
                    ri.course_uid,
                    ri.race_datetime,
                    ro.race_outcome_position,
                    h.horse_uid,
                    hr.final_race_outcome_uid,
                    hr.starting_price_odds_uid,
                    rg.race_group_code,
                    race_type = {$this->getSqlForRaceType()},
                    age = {$ageSql}
                FROM
                    race_instance ri
                    JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                        AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_AND_VOID_IDS . ")
                    JOIN horse h ON h.horse_uid = hr.horse_uid
                    JOIN course c ON ri.course_uid = c.course_uid
                    JOIN {$entity} main ON main.{$entity}_uid = hr.{$entity}_uid
                    JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid 
                    JOIN season s
                        ON ri.race_datetime BETWEEN s.season_start_date
                        AND s.season_end_date
                        AND s.season_type_code = CASE
                             WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                             THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                             ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                        END
                WHERE
                /*{WHERE}*/
                    YEAR(s.season_start_date) >= :dateStart: AND YEAR(s.season_end_date) <= :dateEnd:
                    AND c.course_uid IN (:courseUids:)
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                ) hr
                LEFT JOIN odds ON odds.odds_uid = hr.starting_price_odds_uid
                /*{JOINS}*/  
            GROUP BY
                hr.{$entity}_uid,
                hr.{$entity}_name,
                hr.style_name,
                hr.ptp_type_code,
                hr.race_type,
                hr.course_uid
            ORDER BY
                no_of_wins DESC,
                no_of_runs ASC
        ";
        return $sql;
    }

    /**
     * Name used to determine what column we need. Expected values are jockey or trainer
     * @param string $date
     * @param string $entityName
     * @param array $courseUids
     * @return array
     * @throws ResultsetException
     */
    private function getEntitiyIdsForDate(string $date, string $entityName, array $courseUids): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT 
                {$entityName}_uid as id
            FROM 
                pre_horse_race phr
                JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                    AND phr.race_status_code =
                         (CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN horse_trainer ht ON phr.horse_uid = ht.horse_uid
                    AND ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
            WHERE 
             ri.race_datetime BETWEEN :startDate AND :endDate
             AND c.course_uid IN (:courseUids:)
        ");

        $builder
            ->setParam('startDate', date("Y-m-d H:i:s", strtotime($date . " 00:00:01")))
            ->setParam('endDate', date("Y-m-d H:i:s", strtotime($date . " 23:59:59")))
            ->setParam('courseUids', $courseUids);

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new ResultSet(null, new \Phalcon\Mvc\Model\Row\General(), $res);

        $result =  $result->toArrayWithRows("id");

        return array_map(function ($entityObject) {
            return $entityObject->id;
        }, $result);
    }
    /**
     * This method is called by more than one endpoint and not all of them need the course_ride_since_win calculation,
     * e.g. /profile/course/{courseId}/top-jockeys/{startYear}/{endYear}/{raceDate}/{raceType}
     * @param HorsesRequest $request
     * @param array $courseUids
     * @param bool $incCourseRides
     * @return array
     * @throws ResultsetException
     */
    public function getTopJockeys(HorsesRequest $request, array $courseUids = [], bool $incCourseRides = true)
    {
        $extraColumnsInResult = [
            'jockey_uid',
            'jockey_name',
            'course_ride_since_win'
        ];

        $raceTypeCondition = '';

        if (empty($courseUids)) {
            $courseUids = [$request->getCourseId()];
        }

        $sql = $this->getTopEntitySql('jockey');

        $builder = new Builder();

        $builder->setSqlTemplate($sql);

        $builder
            ->setParam('courseUids', $courseUids)
            ->setParam('dateStart', $request->getStartYear())
            ->setParam('dateEnd', $request->getEndYear());

        if (!is_null($request->getRaceDate())) {
            $jockeyIds = $this->getEntitiyIdsForDate($request->getRaceDate(), 'jockey', $courseUids);
            if (empty($jockeyIds)) {
                return [];
            }

            $builder->where('hr.jockey_uid IN (:jockeyUids:)');
            $builder->setParam('jockeyUids', array_values($jockeyIds));
        }

        if (!is_null($request->getRaceType())) {
            if ($request->getRaceType() == Constants::RACE_TYPE_FLAT_ALIAS) {
                $raceTypeCondition = ' AND ri2.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ') ';
                $builder->where('ri.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')');
            } else {
                $raceTypeCondition = ' AND ri2.race_type_code NOT IN (' . Constants::RACE_TYPE_FLAT . ') ';
                $builder->where('ri.race_type_code NOT IN (' . Constants::RACE_TYPE_FLAT . ')');
            }
        }

        if ($incCourseRides === true) {
            $builder->columns("course_ride_since_win = sum(case when hr.race_datetime > (
                SELECT coalesce(MAX(ri2.race_datetime),'1970-01-01 00:00:00')
                FROM race_instance ri2
                    JOIN horse_race hr2 on hr2.race_instance_uid = ri2.race_instance_uid
                AND hr2.jockey_uid = hr.jockey_uid
                AND ri2.course_uid = hr.course_uid
                " . $raceTypeCondition . "
                AND hr2.final_race_outcome_uid IN (1, 71)
                AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            ) then 1 else 0 end)");
        } else {
            $builder->columns("course_ride_since_win = 0");
        }

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new ResultSet(null, new \Api\Row\CourseProfile\TopJockeys(), $res);

        $topJockeys = $this->prepareTopResult($result, $request, $extraColumnsInResult);

        // For each jockey within in each race type, go and get their best trainer partnerships at the course
        if (!empty($jockeyIds)) {
            foreach ($topJockeys as $courseId => $course) {
                // Grab trainer data for all the relevant jockeys
                $bestTrainers = $this->getJockeysBestTrainers(
                    $request,
                    $jockeyIds,
                    $courseId
                );

                foreach ($course->race_types as $raceType) {
                    // Some raceTypes are null so check to avoid PHP warning
                    if (!empty($raceType)) {
                        foreach ($raceType as $jockey) {
                            // Find the first trainer for the jockey with the given race type.
                            // The first trainer has the best record
                            if (isset($bestTrainers[$jockey->jockey_uid]->race_types[$jockey->race_type])) {
                                $jockey->no_trainer_jockey_wins =
                                    $bestTrainers[$jockey->jockey_uid]
                                        ->race_types[$jockey->race_type]
                                        ->trainers[0]
                                        ->no_trainer_jockey_wins;
                                $jockey->no_trainer_jockey_runs =
                                    $bestTrainers[$jockey->jockey_uid]
                                        ->race_types[$jockey->race_type]
                                        ->trainers[0]
                                        ->no_trainer_jockey_runs;
                                $jockey->trainer_name_most_wins =
                                    $bestTrainers[$jockey->jockey_uid]
                                        ->race_types[$jockey->race_type]
                                        ->trainers[0]
                                        ->trainer_name_most_wins;
                            } else {
                                $jockey->no_trainer_jockey_wins = null;
                                $jockey->no_trainer_jockey_runs = null;
                                $jockey->trainer_name_most_wins = null;
                            }
                        }
                    }
                }
            }
        }

        if (!is_null($request->getRaceType()) && $request->getRaceType() == Constants::RACE_TYPE_JUMPS_ALIAS) {
            $topJockeys = $this->addOverallToRaceTypesJockeys($topJockeys);
        }
        return $topJockeys;
    }

    /**
     * @param HorsesRequest $request
     * @param array $courseUids
     * @return array
     * @throws ResultsetException
     */
    public function getTopTrainers(HorsesRequest $request, array $courseUids = [])
    {
        $extraColumnsInResult = [
            'trainer_uid',
            'trainer_name'
        ];

        $sql = $this->getTopEntitySql('trainer');

        $builder = new Builder();

        $builder->setSqlTemplate($sql);

        if (empty($courseUids)) {
            $courseUids = [$request->getCourseId()];
        }

        $builder
            ->setParam('courseUids', $courseUids)
            ->setParam('dateStart', $request->getStartYear())
            ->setParam('dateEnd', $request->getEndYear());

        $raceTypeCondition = '';

        if (!is_null($request->getRaceType())) {
            if ($request->getRaceType() == Constants::RACE_TYPE_FLAT_ALIAS) {
                // Flat stats only
                $raceTypeCondition = ' AND ri2.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ') ';

                $builder->columns('two_year_old_wins = SUM ( CASE WHEN age = 2 AND  hr.final_race_outcome_uid in (1, 71) THEN 1 ELSE 0 END )');
                $builder->columns('two_year_old_runs = SUM ( CASE WHEN age = 2 THEN 1 ELSE 0 END )');
                $builder->columns('three_year_old_wins = SUM ( CASE WHEN age = 3 AND  hr.final_race_outcome_uid in (1, 71) THEN 1 ELSE 0 END )');
                $builder->columns('three_year_old_runs = SUM ( CASE WHEN age = 3 THEN 1 ELSE 0 END )');
                $builder->columns('four_year_old_plus_wins = SUM ( CASE WHEN age > 3 AND  hr.final_race_outcome_uid in (1, 71) THEN 1 ELSE 0 END )');
                $builder->columns('four_year_old_plus_runs = SUM ( CASE WHEN age > 3 THEN 1 ELSE 0 END )');
                $builder->columns('two_year_old_handicap_wins = SUM ( CASE WHEN age = 2 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');
                $builder->columns('two_year_old_handicap_runs = SUM ( CASE WHEN age = 2 AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');
                $builder->columns('two_year_old_non_handicap_wins = SUM ( CASE WHEN age = 2 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');
                $builder->columns('two_year_old_non_handicap_runs = SUM ( CASE WHEN age = 2 AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');
                $builder->columns('three_year_old_handicap_wins = SUM ( CASE WHEN age = 3 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');
                $builder->columns('three_year_old_handicap_runs = SUM ( CASE WHEN age = 3 AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');
                $builder->columns('three_year_old_non_handicap_wins = SUM ( CASE WHEN age = 3 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');
                $builder->columns('three_year_old_non_handicap_runs = SUM ( CASE WHEN age = 3 AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' THEN 1 ELSE 0 END )');

                $builder->where('ri.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')');

                $extraColumnsInResult = array_merge(
                    $extraColumnsInResult,
                    [
                        'two_year_old_wins',
                        'two_year_old_runs',
                        'three_year_old_wins',
                        'three_year_old_runs',
                        'four_year_old_plus_wins',
                        'four_year_old_plus_runs',
                        'course_run_since_win',
                        'two_year_old_handicap_wins',
                        'two_year_old_handicap_runs',
                        'two_year_old_non_handicap_wins',
                        'two_year_old_non_handicap_runs',
                        'three_year_old_handicap_wins',
                        'three_year_old_handicap_runs',
                        'three_year_old_non_handicap_wins',
                        'three_year_old_non_handicap_runs'
                    ]
                );
            } else {
                // Jumps stats only
                $raceTypeCondition = ' AND ri2.race_type_code NOT IN (' . Constants::RACE_TYPE_FLAT . ') ';

                $builder->columns('chase_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE . ') THEN 1 ELSE 0 END )');
                $builder->columns('chase_handicap_runs = SUM ( CASE WHEN hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE . ') THEN 1 ELSE 0 END )');
                $builder->columns('chase_non_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE. ') THEN 1 ELSE 0 END )');
                $builder->columns('chase_non_handicap_runs = SUM ( CASE WHEN hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE . ') THEN 1 ELSE 0 END )');
                $builder->columns('hurdle_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');
                $builder->columns('hurdle_handicap_runs = SUM ( CASE WHEN hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');
                $builder->columns('hurdle_non_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');
                $builder->columns('hurdle_non_handicap_runs = SUM ( CASE WHEN hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');

                $builder->where('ri.race_type_code NOT IN (' . Constants::RACE_TYPE_FLAT . ')');

                $extraColumnsInResult = array_merge(
                    $extraColumnsInResult,
                    [
                        'course_run_since_win',
                        'chase_handicap_wins',
                        'chase_handicap_runs',
                        'chase_non_handicap_wins',
                        'chase_non_handicap_runs',
                        'hurdle_handicap_wins',
                        'hurdle_handicap_runs',
                        'hurdle_non_handicap_wins',
                        'hurdle_non_handicap_runs'
                    ]
                );
            }
        } else {
            // With no race type request parameter we need to add columns for both flat & jumps stats.
            // The race_type_code values wiol determine whether and data is returned
            $builder->columns('two_year_old_wins = SUM ( CASE WHEN age = 2 AND hr.final_race_outcome_uid in (1, 71) AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('two_year_old_runs = SUM ( CASE WHEN age = 2 AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('three_year_old_wins = SUM ( CASE WHEN age = 3 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('three_year_old_runs = SUM ( CASE WHEN age = 3 AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('four_year_old_plus_wins = SUM ( CASE WHEN age > 3 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('four_year_old_plus_runs = SUM ( CASE WHEN age > 3 AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('two_year_old_handicap_wins = SUM ( CASE WHEN age = 2 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('two_year_old_handicap_runs = SUM ( CASE WHEN age = 2 AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('two_year_old_non_handicap_wins = SUM ( CASE WHEN age = 2 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('two_year_old_non_handicap_runs = SUM ( CASE WHEN age = 2 AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('three_year_old_handicap_wins = SUM ( CASE WHEN age = 3 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('three_year_old_handicap_runs = SUM ( CASE WHEN age = 3 AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('three_year_old_non_handicap_wins = SUM ( CASE WHEN age = 3 AND  hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('three_year_old_non_handicap_runs = SUM ( CASE WHEN age = 3 AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ')  THEN 1 ELSE 0 END )');
            $builder->columns('chase_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE . ') THEN 1 ELSE 0 END )');
            $builder->columns('chase_handicap_runs = SUM ( CASE WHEN hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE . ') THEN 1 ELSE 0 END )');
            $builder->columns('chase_non_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE. ') THEN 1 ELSE 0 END )');
            $builder->columns('chase_non_handicap_runs = SUM ( CASE WHEN hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_CHASE . ') THEN 1 ELSE 0 END )');
            $builder->columns('hurdle_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');
            $builder->columns('hurdle_handicap_runs = SUM ( CASE WHEN hr.race_group_code = ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');
            $builder->columns('hurdle_non_handicap_wins = SUM ( CASE WHEN hr.final_race_outcome_uid in (1, 71) AND hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');
            $builder->columns('hurdle_non_handicap_runs = SUM ( CASE WHEN hr.race_group_code != ' . Constants::RACE_GROUP_CODE_HANDICAP . ' AND hr.race_type_code IN (' . Constants::RACE_TYPE_HURDLE . ') THEN 1 ELSE 0 END )');

            $extraColumnsInResult = array_merge(
                $extraColumnsInResult,
                [
                    'two_year_old_wins',
                    'two_year_old_runs',
                    'three_year_old_wins',
                    'three_year_old_runs',
                    'four_year_old_plus_wins',
                    'four_year_old_plus_runs',
                    'course_run_since_win',
                    'two_year_old_handicap_wins',
                    'two_year_old_handicap_runs',
                    'two_year_old_non_handicap_wins',
                    'two_year_old_non_handicap_runs',
                    'three_year_old_handicap_wins',
                    'three_year_old_handicap_runs',
                    'three_year_old_non_handicap_wins',
                    'three_year_old_non_handicap_runs',
                    'course_run_since_win',
                    'chase_handicap_wins',
                    'chase_handicap_runs',
                    'chase_non_handicap_wins',
                    'chase_non_handicap_runs',
                    'hurdle_handicap_wins',
                    'hurdle_handicap_runs',
                    'hurdle_non_handicap_wins',
                    'hurdle_non_handicap_runs'
                ]
            );
        }

        if (!is_null($request->getRaceDate())) {
            $trainerIds = $this->getEntitiyIdsForDate($request->getRaceDate(), 'trainer', $courseUids);
            $builder->where('hr.trainer_uid IN (:trainerUids:)');

            if (empty($trainerIds)) {
                return [];
            }

            $builder->setParam('trainerUids', array_values($trainerIds));

            // course_run_since_win counts all the races each trainer's horses have had at the same course & race type
            // (flat/jumps) since their last winner at the same course & with the same race type.
            // The coalesce function is used in case no winning race_datetime is found
            $builder->columns("course_run_since_win = sum(case when hr.race_datetime > (
                SELECT coalesce(MAX(ri2.race_datetime),'1970-01-01 00:00:00')
                FROM race_instance ri2
                    JOIN horse_race hr2 on hr2.race_instance_uid = ri2.race_instance_uid
                AND hr2.trainer_uid = hr.trainer_uid
                AND ri2.course_uid IN (:courseUids:)
                " . $raceTypeCondition . "
                AND hr2.final_race_outcome_uid IN (1, 71)
                AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            ) then 1 else 0 end)");
        }

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new ResultSet(null, new \Api\Row\CourseProfile\TopTrainers(), $res);

        $topTrainers =  $this->prepareTopResult($result, $request, $extraColumnsInResult);
        // For jumps race types we want to add an 'overall' section
        if (!is_null($request->getRaceType()) && $request->getRaceType() == Constants::RACE_TYPE_JUMPS_ALIAS) {
            $topTrainers = $this->addOverallToRaceTypes($topTrainers);
        }
        return $topTrainers;
    }

    /**
     * @param HorsesRequest $request
     * @return array
     * @throws ResultsetException
     */
    public function getTopOwners(HorsesRequest $request)
    {
        $extraColumnsInResult = [
            'owner_uid',
            'owner_name'
        ];

        $sql = $this->getTopEntitySql('owner');

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseUids' => [$request->getCourseId()],
                'dateStart' => $request->getStartYear(),
                'dateEnd' => $request->getEndYear(),
            ]
        );

        $result = new ResultSet(null, new \Api\Row\CourseProfile\TopTrainers(), $res);

        return $this->prepareTopResult($result, $request, $extraColumnsInResult);
    }

    /**
     * @param Request\AverageTimes $request
     * @param Selectors            $selectors
     *
     * @return array
     * @throws \Exception
     */
    public function getAverageTimes(Request\AverageTimes $request, \Models\Selectors $selectors)
    {
        $sql = "
            SELECT
                course_type = '" . Constants::RACE_TYPE_FLAT_ALIAS . "'
                , dat.race_type_code
                , dat.distance_yard
                , dat.straight_round_jubilee_code
                , srj.straight_round_jubilee_desc
                , dat.no_of_fences
                , dat.average_time_sec
            FROM
                dist_ave_time dat
                LEFT JOIN straight_round_jubilee srj
                    ON srj.straight_round_jubilee_code = dat.straight_round_jubilee_code
            WHERE
                dat.course_uid = :course_uid:
                AND dat.race_type_code IN (:flatCodes:)
                AND dat.average_time_sec IS NOT NULL
            UNION ALL
            SELECT
                course_type = '" . Constants::RACE_TYPE_JUMPS_ALIAS . "'
                , dat.race_type_code
                , dat.distance_yard
                , dat.straight_round_jubilee_code
                , srj.straight_round_jubilee_desc
                , dat.no_of_fences
                , dat.average_time_sec
            FROM
                dist_ave_time dat
                LEFT JOIN straight_round_jubilee srj
                    ON srj.straight_round_jubilee_code = dat.straight_round_jubilee_code
            WHERE
                dat.course_uid = :course_uid:
                AND dat.race_type_code IN (:jumpsCodes:)
                AND dat.average_time_sec IS NOT NULL
            ORDER BY
                course_type
                , race_type_code
                , distance_yard
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'course_uid' => $request->getCourseId(),
                'flatCodes' => $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS),
                'jumpsCodes' => $selectors->getRaceTypeCode(Constants::RACE_TYPE_JUMPS_ALIAS),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Course(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * For each of the given jockey ids, get the trainers at a given course for each flat or jumps race type over a
     * given season range. Order by best trainer first.
     * @param HorsesRequest $request
     * @param array $jockeyIds
     * @param int $courseId
     * @return array
     * @throws ResultsetException
     */
    public function getJockeysBestTrainers(HorsesRequest $request, array $jockeyIds, int $courseId)
    {
        $raceTypeCondition = '';

        if (!empty($request->getRaceType())) {
            if ($request->getRaceType() == Constants::RACE_TYPE_FLAT_ALIAS) {
                $raceTypeCondition = ' AND ri.race_type_code IN (' . Constants::RACE_TYPE_FLAT . ') ';
            } else {
                $raceTypeCondition = ' AND ri.race_type_code NOT IN (' . Constants::RACE_TYPE_FLAT . ') ';
            }
        }

        $sql = "
            SELECT
                hr.jockey_uid,
                race_type = {$this->getSqlForRaceType()},
                no_trainer_jockey_wins = SUM (CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END),
                no_trainer_jockey_runs = COUNT(hr.final_race_outcome_uid),
                trainer_name_most_wins = t.trainer_name
            FROM
                race_instance ri
                JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_AND_VOID_IDS . ")
                JOIN season s ON ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                    AND s.season_type_code = CASE
                             WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                             THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                             ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                        END
                JOIN trainer t ON t.trainer_uid = hr.trainer_uid
            WHERE
                  hr.jockey_uid in (:jockeyUids:)
              AND YEAR(s.season_start_date) >= :dateStart: AND YEAR(s.season_end_date) <= :dateEnd:
              AND ri.course_uid = :courseUid:
              " . $raceTypeCondition . "
              AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            group by hr.jockey_uid, race_type_code, t.trainer_name
            HAVING SUM(CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END) > 0
            ORDER BY hr.jockey_uid, ri.race_type_code, no_trainer_jockey_wins desc, no_trainer_jockey_runs asc
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'jockeyUids' => $jockeyIds,
                'courseUid'  => $courseId,
                'dateStart'  => $request->getStartYear(),
                'dateEnd'    => $request->getEndYear()
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\CourseProfile\TopJockeys(),
            $res
        );

        $result = $result->getGroupedResult(
            [
                'jockey_uid',
                'race_types' => [
                    'race_type',
                    'trainers' => [
                        'no_trainer_jockey_wins',
                        'no_trainer_jockey_runs',
                        'trainer_name_most_wins',
                    ]
                ]
            ],
            ['jockey_uid', 'race_type']
        );

        return $result;
    }

    /**
     * @param $result
     * @param $request
     * @param $extraColumns
     * @return array
     */
    private function prepareTopResult($result, $request, $extraColumns)
    {
        $defaultResultFlatStructure = [
            'flat_turf' => null,
            'flat_aw' => null,
        ];

        $defaultResultJumpStructure = [
            'nh_flat' => null,
            'chase_turf' => null,
            'hurdle_turf' => null,
            'point_to_point' => null,
            'hunter_chase' => null,
            'nh_flat_aw' => null,
            'hurdle_aw' => null,
            'chase_aw' => null
        ];

        $defaultResultStructure = [
            'nh_flat' => null,
            'chase_turf' => null,
            'flat_turf' => null,
            'hurdle_turf' => null,
            'point_to_point' => null,
            'hunter_chase' => null,
            'nh_flat_aw' => null,
            'flat_aw' => null,
            'hurdle_aw' => null,
            'chase_aw' => null
        ];

        $defaultColumnsInResult = [
            'style_name',
            'ptp_type_code',
            'no_of_runs',
            'no_of_wins',
            'stake',
            'race_type'
        ];

        $columnsInResult = array_merge($defaultColumnsInResult, $extraColumns);

        if ($request->isParameterSet('raceType') && !is_null($request->getRaceType())) {
            if ($request->getRaceType() == Constants::RACE_TYPE_FLAT_ALIAS) {
                $defaultResultStructure = $defaultResultFlatStructure;
            } else {
                $defaultResultStructure = $defaultResultJumpStructure;
            }
        }

        $courses = $result->getGroupedResult([
            'course_uid',
            'race_types' => [
                'race_type',
                'records' => $columnsInResult
            ]
        ], ['course_uid', 'race_type']);

        foreach ($courses as &$course) {
            foreach ($course->race_types as &$races) {
                $races = $races->records;
            }
            $course->race_types = (Object)($course->race_types + $defaultResultStructure);
        }
        return $courses;
    }

    /**
     * @return string
     */
    private function getSqlForRaceType()
    {
        return "CASE
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_NH_FLAT . " THEN 'nh_flat'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_CHASE_TURF . " THEN 'chase_turf'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . " THEN 'hurdle_turf'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_P2P . " THEN 'point_to_point'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . " THEN 'hunter_chase'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_NH_FLAT_AW . " THEN 'nh_flat_aw'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . " THEN 'flat_aw'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_HURDLE_AW . " THEN 'hurdle_aw'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_CHASE_AW . " THEN 'chase_aw'
                    WHEN ri.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . " THEN 'flat_turf'
                END";
    }

    /**
     * Add overall stats based on parsing through existing race_types in the data
     * @param array $data
     * @return array
     */
    private function addOverallToRaceTypes(array $data)
    {
        foreach ($data as $courseId => $course) {
            $overall = array();
            foreach ($course->race_types as $raceType) {
                // Some raceTypes are null so check to avoid PHP warning
                if (!empty($raceType)) {
                    foreach ($raceType as $trainer) {
                        if (!isset($overall[$trainer->trainer_uid])) {
                            // $trainer is an object, so we want to clone it to avoid references to the original.
                            // Just doing $overall[$trainer->trainer_uid] = $trainer would cause both
                            // $overall[$trainer->trainer_uid] AND $trainer to be updated in the 'else' statement below
                            $overall[$trainer->trainer_uid] = clone $trainer;
                        } else {
                            $overall[$trainer->trainer_uid]->no_of_runs += $trainer->no_of_runs;
                            $overall[$trainer->trainer_uid]->no_of_wins += $trainer->no_of_wins;
                            $overall[$trainer->trainer_uid]->stake += $trainer->stake;
                            $overall[$trainer->trainer_uid]->course_run_since_win += $trainer->course_run_since_win;
                            $overall[$trainer->trainer_uid]->chase_handicap_wins += $trainer->chase_handicap_wins;
                            $overall[$trainer->trainer_uid]->chase_handicap_runs += $trainer->chase_handicap_runs;
                            $overall[$trainer->trainer_uid]->chase_non_handicap_wins += $trainer->chase_non_handicap_wins;
                            $overall[$trainer->trainer_uid]->chase_non_handicap_runs += $trainer->chase_non_handicap_runs;
                            $overall[$trainer->trainer_uid]->hurdle_handicap_wins += $trainer->hurdle_handicap_wins;
                            $overall[$trainer->trainer_uid]->hurdle_handicap_runs += $trainer->hurdle_handicap_runs;
                            $overall[$trainer->trainer_uid]->hurdle_non_handicap_wins += $trainer->hurdle_non_handicap_wins;
                            $overall[$trainer->trainer_uid]->hurdle_non_handicap_runs += $trainer->hurdle_non_handicap_runs;
                        }
                    }
                }
            }
            if (count($overall) > 0) {
                // We want to get rid of using trainer_uid values as the index
                usort($overall, function ($a, $b) {
                    if ($b->no_of_wins == $a->no_of_wins) {
                        return $a->no_of_runs <=> $b->no_of_runs;
                    }
                    return $b->no_of_wins <=> $a->no_of_wins;
                });
                $reindexedOverall = array_values($overall);
                //Add new 'overall' array to the race_types object
                $course->race_types->overall = $reindexedOverall;
            }
        }
        return $data;
    }

    private function addOverallToRaceTypesJockeys($data)
    {
        foreach ($data as $courseId => $course) {
            $overall = array();
            foreach ($course->race_types as $raceType) {
                if (!empty($raceType)) {
                    foreach ($raceType as $jockey) {
                        if (!isset($overall[$jockey->jockey_uid])) {
                            $overall[$jockey->jockey_uid] = clone $jockey;
                        } else {
                            $overall[$jockey->jockey_uid]->no_of_runs += $jockey->no_of_runs;
                            $overall[$jockey->jockey_uid]->no_of_wins += $jockey->no_of_wins;
                            $overall[$jockey->jockey_uid]->stake += $jockey->stake;
                            $overall[$jockey->jockey_uid]->no_trainer_jockey_wins += $jockey->no_trainer_jockey_wins;
                            $overall[$jockey->jockey_uid]->no_trainer_jockey_runs += $jockey->no_trainer_jockey_runs;
                            $overall[$jockey->jockey_uid]->course_ride_since_win += $jockey->course_ride_since_win;

                        }
                    }
                }
            }
            if (count($overall) > 0) {
                usort($overall, function ($a, $b) {
                    if ($b->no_of_wins == $a->no_of_wins) {
                        return $a->no_of_runs <=> $b->no_of_runs;
                    }
                    return $b->no_of_wins <=> $a->no_of_wins;
                });
                $reindexedOverall = array_values($overall);
                $course->race_types->overall = $reindexedOverall;
            }
        }
        return $data;
    }
}
