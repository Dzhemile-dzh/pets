<?php

namespace Models\Bo\RaceCards;

use Api\Constants\Horses as Constants;
use Api\Row\RaceCards;
use Models\Selectors;
use Phalcon\DI;
use Phalcon\Db\Column;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Row;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\RaceCards
 */
class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param int $raceInstanceUid
     *
     * @return \Api\Row\RaceInstance
     */
    public function getRaceInstance($raceInstanceUid)
    {
        $sql = "
            SELECT
                race_id = ri.race_instance_uid,
                ri.race_type_code,
                ri.race_datetime,
                ri.race_status_code,
                ri.distance_yard,
                rg.race_group_code,
                c.course_uid,
                c.rp_abbrev_3,
                country_code = rtrim(c.country_code),
                c.course_name,
                course_style_name = c.style_name,
                gt.going_type_code,
                gt.going_type_desc,
                declared_runners = pri.no_of_runners,
                no_of_runners = CASE
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_CALENDAR . " THEN
                        CASE WHEN rif.forfeit_number IS NULL THEN pri.no_of_runners ELSE rif.forfeit_number END
                    WHEN pri.race_status_code IN (" . Constants::RACE_STATUS_6DAYS . "," . Constants::RACE_STATUS_5DAYS
            . "," . Constants::RACE_STATUS_4DAYS . "," . Constants::RACE_STATUS_3DAYS . ") THEN
                        CASE WHEN pric.rp_confirmed IS NULL THEN pri.no_of_runners ELSE pric.rp_confirmed END
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN
                        (SELECT
                            COUNT(*)
                        FROM
                            pre_horse_race phr
                        WHERE phr.race_instance_uid = :race_instance_uid
                            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            AND (phr.doubtful_runner IS NULL OR phr.doubtful_runner != 'Y')
                            AND (phr.non_runner IS NULL OR phr.non_runner != 'Y')
                            AND (phr.irish_reserve_yn IS NULL OR phr.irish_reserve_yn != 'Y')
                        )
                    ELSE pri.no_of_runners
                END,
                pri.distance_yard,
                pric.rp_tv_text
            FROM race_instance ri
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN going_type gt ON ri.going_type_code = gt.going_type_code
                LEFT JOIN race_instance_forfeit rif ON rif.race_instance_uid = ri.race_instance_uid
                  AND stage = (
                    SELECT MAX(stage)
                    FROM race_instance_forfeit rif2
                    WHERE rif2.race_instance_uid = ri.race_instance_uid
                  )
            WHERE
                ri.race_instance_uid = :race_instance_uid
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['race_instance_uid' => $raceInstanceUid]
        );

        $raceInstances = new Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $res
        );

        return $raceInstances->getFirst();
    }

    /**
     * @param int    $horseIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param string $goingTypeCode
     *
     * @return Resultset\General
     */
    public function getHorseStatisticsByGoingType(
        $horseIds,
        $startDate,
        array $raceTypeCode,
        $goingTypeCode
    ) {
        $additionalConditions = ' AND race_instance.going_type_code = :goingTypeCode: ';
        $additionalPlaceholders['goingTypeCode'] = $goingTypeCode;

        return $this->getHorseStatistics(
            $horseIds,
            $startDate,
            $raceTypeCode,
            $additionalConditions,
            $additionalPlaceholders
        );
    }

    /**
     * @param int    $horseIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param int    $minDistance
     * @param int    $maxDistance
     *
     * @return Resultset\General
     */
    public function getHorseStatisticsByDistance(
        $horseIds,
        $startDate,
        array $raceTypeCode,
        $minDistance,
        $maxDistance
    ) {
        $additionalConditions = ' AND race_instance.distance_yard BETWEEN :minDistance: AND :maxDistance: ';
        $additionalPlaceholders['minDistance'] = $minDistance;
        $additionalPlaceholders['maxDistance'] = $maxDistance;

        return $this->getHorseStatistics(
            $horseIds,
            $startDate,
            $raceTypeCode,
            $additionalConditions,
            $additionalPlaceholders
        );
    }

    /**
     * @param int    $horseIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param int    $courseId
     *
     * @return Resultset\General
     */
    public function getHorseStatisticsByCourse(
        $horseIds,
        $startDate,
        array $raceTypeCode,
        $courseId
    ) {
        $additionalConditions = ' AND course.course_uid = :courseUid: ';
        $additionalPlaceholders['courseUid'] = $courseId;

        return $this->getHorseStatistics(
            $horseIds,
            $startDate,
            $raceTypeCode,
            $additionalConditions,
            $additionalPlaceholders
        );
    }

    /**
     * @param int    $horseIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param string $additionalConditions
     * @param array  $additionalPlaceholders
     *
     * @return Resultset\General
     */
    private function getHorseStatistics(
        $horseIds,
        $startDate,
        array $raceTypeCode,
        $additionalConditions,
        $additionalPlaceholders
    ) {

        $sql = "
            SELECT
                horse.horse_uid,
                COUNT(horse.horse_uid) runs,
                SUM(CASE WHEN race_outcome.race_outcome_position = 1 THEN 1 ELSE 0 END) wins

            FROM race_instance
            JOIN horse_race ON horse_race.race_instance_uid = race_instance.race_instance_uid
            JOIN horse ON horse.horse_uid = horse_race.horse_uid
            JOIN course ON course.course_uid = race_instance.course_uid
            JOIN race_outcome ON
                race_outcome.race_outcome_uid = horse_race.final_race_outcome_uid
                AND race_outcome.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            LEFT JOIN race_instance_prize ON
                race_instance_prize.race_instance_uid = race_instance.race_instance_uid
                AND race_instance_prize.position_no = race_outcome.race_outcome_position
            LEFT JOIN odds ON odds.odds_uid = horse_race.starting_price_odds_uid


            WHERE
                horse.horse_uid IN (:horseIds)
                AND race_instance.race_type_code IN (:raceTypeCode:)
                AND race_instance.race_datetime BETWEEN :startDate: AND GETDATE()

                {$additionalConditions}

            GROUP BY horse.horse_uid
        ";

        $placeholders = [
            'startDate' => $startDate,
            'raceTypeCode' => $raceTypeCode,
            'horseIds' => $horseIds,
        ];

        $placeholders = array_merge($placeholders, $additionalPlaceholders);

        $res = $this->getReadConnection()->query($sql, $placeholders);


        $statistics = new Resultset\General(
            null,
            new RaceCards\Stats(),
            $res
        );

        return $statistics->toArrayWithRows('horse_uid');
    }

    /**
     * @param $rpAbbrev3
     * @param $isFlatRace
     * @param $selectors
     *
     * @return string
     */
    private function getAdditionalFieldsForTrainerAndJockeyOverallStatistics($rpAbbrev3, $isFlatRace, $selectors)
    {
        $rpAbbrev3Escaped = $this->getReadConnection()->escapeString($rpAbbrev3);
        $statsGroups = $selectors->getRaceCardStatsGroups($isFlatRace);
        if ($isFlatRace) {
            $ageSql = $selectors->getHorseAgeSQL(
                'horse.horse_date_of_birth',
                'horse.country_origin_code',
                'race_instance.race_datetime'
            );
            $statsConditions = [
                "({$ageSql}) = 2",
                "({$ageSql}) = 3",
                "({$ageSql}) > 3",
            ];
        } else {
            $statsConditions = [
                "race_instance.race_type_code IN (" . Constants::RACE_TYPE_CHASE . ")", //chase
                "race_instance.race_type_code IN (" . Constants::RACE_TYPE_HURDLE . ")", // hurdle
                "race_instance.race_type_code IN (" . Constants::RACE_TYPE_NHF . ")", //nhf
            ];
        }

        $result = [];
        foreach ($statsConditions as $key => $condition) {
            $result[] = "

            SUM(
                CASE
                    WHEN {$condition}
                         AND course.rp_abbrev_3 = {$rpAbbrev3Escaped}
                         AND horse_race.final_race_outcome_uid IN (1,71)
                    THEN 1 ELSE 0
                END
            ) wins_{$statsGroups[$key]},
            SUM(
                CASE
                    WHEN {$condition}
                         AND course.rp_abbrev_3 = {$rpAbbrev3Escaped}
                    THEN 1 ELSE 0
                END
            ) runs_{$statsGroups[$key]},
            SUM(
                CASE
                    WHEN {$condition}
                         AND course.rp_abbrev_3 = {$rpAbbrev3Escaped}
                    THEN
                        CASE
                            WHEN horse_race.final_race_outcome_uid IN (1,71)
                            THEN
                                CASE
                                    WHEN horse_race.final_race_outcome_uid = 71
                                    THEN odds.odds_value / 2 - 0.5
                                    ELSE odds.odds_value
                                END
                            ELSE
                                -1
                        END
                    ELSE
                        0
                END
            ) profit_{$statsGroups[$key]}";
        }

        return "," . implode(",", $result);
    }

    /**
     * @param array $jockeyIds
     * @param       $startDate
     * @param array $raceTypeCode
     * @param       $courseId
     * @param       $rpAbbrev3
     * @param       $isFlatRace
     * @param       $selectors
     *
     * @return Resultset\General
     */
    public function getJockeyStatisticsOverall(
        array $jockeyIds,
        $startDate,
        array $raceTypeCode,
        $courseId,
        $rpAbbrev3,
        $isFlatRace,
        $selectors
    ) {

        $additionalFields = $this->getAdditionalFieldsForTrainerAndJockeyOverallStatistics(
            $rpAbbrev3,
            $isFlatRace,
            $selectors
        );

        $additionalConditions = 'AND course.course_uid = :courseId:';

        $additionalPlaceholders = [
            'courseId' => $courseId,
        ];

        return $this->getJockeyStatistics(
            $jockeyIds,
            $startDate,
            $raceTypeCode,
            $additionalFields,
            $additionalConditions,
            $additionalPlaceholders
        );
    }

    /**
     * @param array  $jockeyIds
     * @param string $startDate
     * @param array  $raceTypeCode
     *
     * @return Resultset\General
     */
    public function getJockeyStatisticsLast14Days(
        array $jockeyIds,
        $startDate,
        array $raceTypeCode
    ) {
        return $this->getJockeyStatistics(
            $jockeyIds,
            $startDate,
            $raceTypeCode
        );
    }


    /**
     * @param array  $jockeyIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param string $additionalFields
     * @param string $additionalConditions
     * @param array  $additionalPlaceholders
     *
     * @return Resultset\General
     */
    private function getJockeyStatistics(
        $jockeyIds,
        $startDate,
        array $raceTypeCode,
        $additionalFields = '',
        $additionalConditions = '',
        $additionalPlaceholders = []
    ) {
        $sql = "
            SELECT
                jockey.jockey_uid,
                SUM(CASE WHEN horse_race.final_race_outcome_uid IN (1,71) THEN 1 ELSE 0 END) wins,
                COUNT(trainer.trainer_uid) runs,
                SUM(CASE WHEN horse_race.final_race_outcome_uid IN (1,71) THEN odds.odds_value ELSE -1 END) profit
                {$additionalFields}

            FROM race_instance
            JOIN horse_race ON horse_race.race_instance_uid = race_instance.race_instance_uid
            JOIN horse ON horse.horse_uid = horse_race.horse_uid
            JOIN jockey ON jockey.jockey_uid = horse_race.jockey_uid
            JOIN course ON course.course_uid = race_instance.course_uid
            JOIN trainer ON trainer.trainer_uid = horse_race.trainer_uid
            LEFT JOIN odds ON odds.odds_uid = horse_race.starting_price_odds_uid

            WHERE
                horse_race.jockey_uid IN (:jockeyIds:)
                AND race_instance.race_type_code IN (:raceTypeCode:)
                AND race_instance.race_datetime BETWEEN :startDate: AND GETDATE()
                AND race_instance.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND horse_race.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                {$additionalConditions}

            GROUP BY jockey.jockey_uid
        ";

        $placeholders = [
            'startDate' => $startDate,
            'raceTypeCode' => $raceTypeCode,
            'jockeyIds' => $jockeyIds,
        ];

        $placeholders = array_merge($placeholders, $additionalPlaceholders);

        $res = $this->getReadConnection()->query($sql, $placeholders);


        $statistics = new Resultset\General(
            null,
            new RaceCards\Stats(),
            $res
        );

        return $statistics->toArrayWithRows('jockey_uid');
    }

    /**
     * @param array $trainerIds
     * @param       $startDate
     * @param array $raceTypeCode
     * @param       $courseId
     * @param       $rpAbbrev3
     * @param       $isFlatRace
     * @param       $selectors
     *
     * @return Resultset\General
     */
    public function getTrainerStatisticsOverall(
        array $trainerIds,
        $startDate,
        array $raceTypeCode,
        $courseId,
        $rpAbbrev3,
        $isFlatRace,
        $selectors
    ) {
        $additionalFields = $this->getAdditionalFieldsForTrainerAndJockeyOverallStatistics(
            $rpAbbrev3,
            $isFlatRace,
            $selectors
        );

        $additionalConditions = 'AND course.course_uid = :courseId:';

        $additionalPlaceholders = [
            'courseId' => $courseId,
        ];

        return $this->getTrainerStatistics(
            $trainerIds,
            $startDate,
            $raceTypeCode,
            $additionalFields,
            $additionalConditions,
            $additionalPlaceholders
        );
    }

    /**
     * @param array  $trainerIds
     * @param string $startDate
     * @param array  $raceTypeCode
     *
     * @return Resultset\General
     */
    public function getTrainerStatisticsLast14Days(
        $trainerIds,
        $startDate,
        array $raceTypeCode
    ) {
        return $this->getTrainerStatistics(
            $trainerIds,
            $startDate,
            $raceTypeCode
        );
    }

    /**
     * @param array  $trainerIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param string $additionalFields
     * @param string $additionalConditions
     * @param array  $additionalPlaceholders
     *
     * @return Resultset\General
     */
    private function getTrainerStatistics(
        array $trainerIds,
        $startDate,
        array $raceTypeCode,
        $additionalFields = '',
        $additionalConditions = '',
        array $additionalPlaceholders = []
    ) {
        $sql = "
            SELECT
                trainer.trainer_uid,
                SUM(CASE WHEN horse_race.final_race_outcome_uid IN (1,71) THEN 1 ELSE 0 END) wins,
                COUNT(trainer.trainer_uid) runs,
                SUM(CASE WHEN horse_race.final_race_outcome_uid IN (1,71) THEN odds.odds_value ELSE -1 END) profit
                {$additionalFields}

            FROM race_instance
            JOIN horse_race ON horse_race.race_instance_uid = race_instance.race_instance_uid
            JOIN horse ON horse.horse_uid = horse_race.horse_uid
            JOIN course ON course.course_uid = race_instance.course_uid
            JOIN trainer ON trainer.trainer_uid = horse_race.trainer_uid
            LEFT JOIN odds ON odds.odds_uid = horse_race.starting_price_odds_uid

            WHERE
                horse_race.trainer_uid IN (:trainerIds)
                AND race_instance.race_type_code IN (:raceTypeCode)
                AND race_instance.race_datetime BETWEEN :startDate AND GETDATE()
                AND race_instance.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND horse_race.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                {$additionalConditions}

            GROUP BY trainer.trainer_uid
        ";

        $placeholders = [
            'startDate' => $startDate,
            'raceTypeCode' => $raceTypeCode,
            'trainerIds' => $trainerIds,
        ];

        $placeholders = array_merge($placeholders, $additionalPlaceholders);

        $res = $this->getReadConnection()->query($sql, $placeholders);

        $statistics = new Resultset\General(
            null,
            new RaceCards\Stats(),
            $res
        );

        return $statistics->toArrayWithRows('trainer_uid');
    }


    /**
     * @param int $raceId
     *
     * @return null|\Phalcon\Mvc\ModelInterface
     * @throws Resultset\ResultsetException
     */
    public function getRaceCard(int $raceId)
    {
        /**
         * We need to get the horse age at the time of the race we want.
         */
        $ageSql = DI::getDefault()->getShared('selectors')->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'ri2.race_datetime'
        );

        $sql = "
            SELECT
                ri.race_instance_title,
                ri.race_instance_uid,
                aa.rp_ages_allowed_desc,
                official_rating_band_desc = rtrim(orb.official_rating_band_desc),
                ri.race_datetime,
                local_meeting_race_datetime =
                    dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime),
                clt.hours_difference,
                pri.three_yo_min_weight_lbs,
                pri.minimum_weight_lbs,
                ri.ages_allowed_uid,
                pri.no_of_runners declared_runners,
                no_of_runners = CASE
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_CALENDAR . " THEN
                        CASE WHEN rif.forfeit_number IS NULL
                            THEN pri.no_of_runners ELSE rif.forfeit_number END
                    WHEN pri.race_status_code IN (" . Constants::RACE_STATUS_6DAYS
            . "," . Constants::RACE_STATUS_5DAYS
            . "," . Constants::RACE_STATUS_4DAYS
            . "," . Constants::RACE_STATUS_3DAYS . ") THEN
                        CASE WHEN pric.rp_confirmed IS NULL
                            THEN pri.no_of_runners ELSE pric.rp_confirmed END
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN
                        (SELECT
                            COUNT(1)
                        FROM
                            pre_horse_race phr
                        WHERE phr.race_instance_uid = :raceId
                            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            AND (phr.doubtful_runner IS NULL OR phr.doubtful_runner != 'Y')
                            AND (phr.non_runner IS NULL OR phr.non_runner != 'Y')
                            AND (phr.irish_reserve_yn IS NULL OR phr.irish_reserve_yn != 'Y')
                        )
                    ELSE pri.no_of_runners
                END,
                pri.distance_yard,
                pric.rp_tv_text,
                pric.race_condition_desc,
                gt.going_type_desc,
                pric.rp_penalties,
                c.course_uid,
                CASE WHEN c2.course_uid IS NOT NULL AND c2.course_uid != c.course_uid
                    THEN c2.course_uid END mixed_course_uid,
                c.course_name,
                c.style_name course_style_name,
                pric.rp_horse_types,
                pric.rp_weights,
                pric.allowances,
                pri.entry_fee,
                pri.extra_fee,
                c.country_code,
                pric.rp_stakes,
                pric.rp_ag_indicator,
                pri.weights_raised_lbs,
                pric.rp_auction_min,
                pric.rp_claim_min,
                pric.rp_confirmed,
                ri.race_status_code,
                ri.race_type_code,
                ri.race_group_uid,
                ri.pool_prize_sterling,
                rt.race_type_desc,
                rg.race_group_desc,
                ri.going_type_code,
                dat.no_of_fences,
                no_of_entries =  pri1.no_of_runners,
                ri.rp_stalls_position,
                rif.stage,
                rif.forfeit_number,
                rif.forfeit_value,
                rg.race_group_code,
                pri.minimum_weight_lbs,
                pri.safety_factor_number,
                early_closing_race_yn = CASE WHEN upper(pri.early_closing_race_yn) = 'Y' 
                                             THEN 'Y'  ELSE 'n' 
                                        END,
                pri.reopened_yn,
                pri.division_preference,
                ri2.race_datetime AS prev_year_datetime,
                prev_runners = (
                    SELECT count(1)
                    FROM horse_race hr
                    LEFT JOIN  race_outcome ro ON hr.race_instance_uid = ri.lst_yr_race_instance_uid
                            AND ro.race_outcome_uid = hr.final_race_outcome_uid
                    WHERE ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                ),
                prev_horse_name = h.style_name,
                prev_draw = NULLIF(hr.draw, 0),
                prev_trainer = t.style_name,
                prev_horse_age = {$ageSql},
                prev_weight_carried = hr.weight_carried_lbs,
                prev_odds = o.odds_desc,
                prev_jockey = j.style_name,
                hr.weight_allowance_lbs,
                rig.int_1,
                rig.lookup_uid,
                prev_rating =
                    CASE WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                        THEN 'OR' + CONVERT(VARCHAR, hr.official_rating_ran_off)
                        ELSE 'RPR' + CONVERT(VARCHAR, hr.rp_postmark)
                     END,
                highest_official_rating = NULL,
                perform_race_uid_atr = (
                    SELECT MAX(perform_race_uid)
                    FROM perform_race
                    WHERE perform_race.race_instance_uid = ri.race_instance_uid AND isATR = 1
                ),
                perform_race_uid_ruk = (
                    SELECT MAX(perform_race_uid)
                    FROM perform_race
                    WHERE perform_race.race_instance_uid = ri.race_instance_uid AND isATR IS NULL
                ),
                stalls_position_desc = (
                    SELECT rig.varchar_255
                    FROM race_instance_genlkup rig
                    WHERE rig.race_instance_uid = ri.race_instance_uid
                        AND rig.lookup_uid = 8
                ),
                ri.straight_round_jubilee_code,
                live_tab = CASE
                    WHEN CONVERT(VARCHAR, ri.race_datetime, 101) = CONVERT(VARCHAR, getdate(), 101)
                        AND c.country_code IN ('GB','IRE') THEN 'Y'
                    WHEN CONVERT(VARCHAR, ri.race_datetime, 101) != CONVERT(VARCHAR, getdate(), 101)
                        AND c.country_code IN ('GB','IRE')
                        AND EXISTS(SELECT 1 FROM race_attrib_join raj
                            WHERE
                                raj.race_instance_uid = ri.race_instance_uid
                                AND raj.race_attrib_uid = 486) THEN 'Y'
                    WHEN c.country_code NOT IN ('GB','IRE')
                        AND EXISTS(SELECT 1 FROM race_attrib_join raj
                            WHERE
                                raj.race_instance_uid = ri.race_instance_uid
                                AND raj.race_attrib_uid = 486) THEN 'Y'
                     ELSE 'N'
                END,
                race_number = (
                    SELECT COUNT(1)
                    FROM race_instance ri1
                    WHERE
                      ri1.race_datetime BETWEEN CONVERT(VARCHAR, ri.race_datetime, 101) + ' 00:00:00' AND ri.race_datetime
                        AND ri1.course_uid = CASE WHEN c2.course_uid IS NOT NULL AND c2.course_uid != c.course_uid
                        THEN c2.course_uid ELSE ri.course_uid END
                ),
                pmd.weather_details
            FROM race_instance ri
            INNER JOIN course c ON ri.course_uid = c.course_uid
            INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
            LEFT JOIN course_local_time clt ON
                clt.course_uid = ri.course_uid AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
            LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
            LEFT JOIN official_rating_band orb ON orb.official_rating_band_uid = ri.official_rating_band_uid
            LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
            LEFT JOIN going_type gt ON gt.going_type_code = ri.going_type_code
            LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid AND ri.race_group_uid != 0
            LEFT JOIN race_type rt ON rt.race_type_code = ri.race_type_code
            LEFT JOIN race_instance_genlkup rig ON ri.race_instance_uid = rig.race_instance_uid
            LEFT JOIN dist_ave_time dat
                ON dat.course_uid = ri.course_uid
                AND dat.race_type_code = CASE
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . "
                        THEN " . Constants::RACE_TYPE_CHASE_TURF . " ELSE ri.race_type_code
                    END
                AND dat.distance_yard = ri.distance_yard
                AND
                (
                    dat.straight_round_jubilee_code = ri.straight_round_jubilee_code
                    OR (dat.straight_round_jubilee_code IS NULL
                        AND ri.straight_round_jubilee_code IS NULL)
                )
            LEFT JOIN race_instance_forfeit rif
                ON rif.race_instance_uid = ri.race_instance_uid
                    AND stage = (
                        SELECT MAX(stage)
                        FROM race_instance_forfeit rif2
                        WHERE rif2.race_instance_uid = ri.race_instance_uid
                    )
            LEFT JOIN course c2 ON -- Mixed meeting checking
                        c.rp_abbrev_3 = c2.rp_abbrev_3
                        AND c.country_code = c2.country_code
                        AND c2.course_uid = 31
                        AND EXISTS (
                            SELECT 1
                            FROM race_instance ri2
                            WHERE CONVERT(VARCHAR, ri2.race_datetime, 101) = CONVERT(VARCHAR, ri.race_datetime, 101)
                                AND ri2.course_uid != c.course_uid
                                AND ri2.course_uid = c2.course_uid
                                AND ri2.race_status_code = ri.race_status_code
                            )
            LEFT JOIN race_instance ri2 ON ri2.race_instance_uid = ri.lst_yr_race_instance_uid
            LEFT JOIN horse_race hr ON ri2.race_instance_uid = hr.race_instance_uid
            AND hr.race_outcome_uid IN (" . Constants::WINNER_IDS . ")
            LEFT JOIN horse h ON h.horse_uid = hr.horse_uid
            LEFT JOIN trainer t ON t.trainer_uid = hr.trainer_uid
            LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
            LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
            LEFT JOIN pre_race_instance pri1 ON pri1.race_instance_uid = :raceId
                AND pri1.race_status_code = " . Constants::RACE_STATUS_5DAYS . "
            LEFT JOIN pre_meeting_details pmd ON pmd.course_uid = ri.course_uid
                AND DATEDIFF(DD, pmd.meeting_date, ri.race_datetime) = 0
            WHERE
                ri.race_instance_uid = :raceId
                AND CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1' ELSE
                        CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN '0' ELSE pri.race_status_code END
                    END = (
                        SELECT MIN(CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1' ELSE
                            CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN '0' ELSE ipri.race_status_code END END)
                        FROM pre_race_instance ipri
                        WHERE ipri.race_instance_uid = ri.race_instance_uid
                        GROUP BY ipri.race_instance_uid
                )
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $result = new Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $res
        );

        $ret = $result->getFirst();

        return empty($ret) ? null : $ret;
    }

    /**
     * Finds only runners ids for selected race
     *
     * @return array
     * @throws \Exception
     */
    public function getRunnersIds()
    {
        $sql = "
            SELECT DISTINCT horse_uid
            FROM " . static::HORSES_ID_TABLE . "
        ";

        $res = $this->getReadConnection()->query($sql);

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->getField('horse_uid');
    }

    /**
     * Method to extract the race attribute info - grouping depends on where the method is invoked
     * @param array $raceIds
     * @param string $groupedFor
     * @return Resultset\General
     */
    public function getRaceAttributes(array $raceIds, $groupedFor = '')
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT
              race_attrib_desc,
              rtrim(race_attrib_code) as race_attrib_code,
              raj.race_attrib_uid,
              race_instance_uid
            FROM race_attrib_join raj
            JOIN race_attrib_lookup ral ON ral.race_attrib_uid = raj.race_attrib_uid
            WHERE race_instance_uid IN (:raceIds)
            "
        );

        $builder->setParam('raceIds', $raceIds);
        $builder->build();

        $res = $this->getReadConnection()->query($builder->getSql(), $builder->getParams());


        $result = new Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );
        // There is a difference in how we want the data supplied depending on the class invoking this method.
        switch ($groupedFor) {
            case 'form':
                $result = $result->getGroupedResult([
                    'race_instance_uid',
                    'attrib_codes' => [
                        'race_attrib_code',
                        'attrib_uids' => [
                            'race_attrib_desc',
                            'race_attrib_uid'
                        ]
                    ]
                ], ['race_instance_uid', 'race_attrib_code']);
                break;

            case 'races':
                $result = $result->getGroupedResult([
                    'race_instance_uid',
                    'attrib_uids' => [
                        'race_attrib_uid'
                    ]
                ], ['race_instance_uid', 'race_attrib_uid'], true);
                break;

            default:
                $result = $result->getGroupedResult([
                    'race_attrib_code',
                    'attrib_uids' => [
                        'race_attrib_desc',
                        'race_attrib_uid'
                    ]
                ], ['race_attrib_code', 'race_attrib_uid']);
        }
        return $result;
    }

    /**
     * Return forms for provided horseUids
     *
     * @param array    $horseUids
     * @param int      $raceId
     * @param bool     $isResults
     * @param string $raceDatetime
     * @param bool $ptpFlag
     * @param int|null $limit
     *
     * @return array
     */
    public function getForm(
        array $horseUids,
        int $raceId,
        bool $isResults,
        string $raceDatetime,
        bool $ptpFlag,
        $limit = null
    ) {
        $withPTPhorses = $this->getPtpGbHorses();
        $withoutPTPhorses = array_diff($horseUids, $withPTPhorses);
        $forms = [];
        if (!empty($withPTPhorses) && $ptpFlag) {
            $forms = $this->getFormOrWinsOrMyRatings(
                $raceId,
                'form',
                $ptpFlag,
                $limit,
                $isResults,
                $raceDatetime,
                $ptpFlag
            );
        }
        if (!empty($withoutPTPhorses)) {
            $forms += $this->getFormOrWinsOrMyRatings(
                $raceId,
                'form',
                false,
                $limit,
                $isResults,
                $raceDatetime,
                $ptpFlag
            );
        }

        return $forms;
    }

    /**
     * @param int $raceId
     *
     * @return Builder
     */
    protected function initCommonVerdictBuilder($raceId)
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT
                ri.race_instance_uid
                , ri.race_datetime
                , rp_verdict = /*{EXPRESSION(selectRpVerdict)}*/
                , pre_race_instance_comments = CASE WHEN EXISTS (
                        SELECT 1 FROM race_content_publish_time rcpt
                        WHERE rcpt.race_content_publish_race_uid = ri.race_instance_uid
                        AND rcpt.race_content_publish_time <= GETDATE()
                        AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
                    )
                    THEN prig.text_field ELSE NULL END
                , rhks.key_stats_str
                , rhks.horse_uid
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , c.course_uid
                , course_country_code = rtrim(c.country_code)
                , course_style_name = c.style_name
                , ho.owner_uid
                , phr.rp_owner_choice
                , phr.saddle_cloth_no
                , phr.non_runner
            FROM
                race_instance ri
            LEFT JOIN
                pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
            LEFT JOIN
                pre_race_instance_genlkup prig ON prig.race_instance_uid = ri.race_instance_uid
                /*{EXPRESSION(joinPostPointerVerdict)}*/
            LEFT JOIN
                rp_horse_key_stats rhks ON rhks.race_instance_uid = ri.race_instance_uid AND rhks.key_stats_mode = 1
            LEFT JOIN
                course c ON c.course_uid = ri.course_uid
            LEFT JOIN
                horse_owner ho ON ho.horse_uid = rhks.horse_uid
                AND ho.owner_change_date = ISNULL(
                        (SELECT MIN(t2.owner_change_date)
                        FROM horse_owner t2
                        WHERE
                            t2.horse_uid = rhks.horse_uid
                            AND t2.owner_change_date > ri.race_datetime
                        ),
                    '" . Constants::EMPTY_DATE_AND_TIME . "'
                )
            LEFT JOIN
                pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid AND phr.horse_uid = rhks.horse_uid
                AND phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code 
                    END
                )
            LEFT JOIN
                horse h ON h.horse_uid = rhks.horse_uid
            WHERE
                ri.race_instance_uid = :raceId
            "
        );

        $builder->setParam('raceId', $raceId);

        return $builder;
    }

    /**
     * @param int $raceId
     *
     * @return \Api\Row\Horse[]
     */
    public function fetchVerdict($raceId)
    {
        $builder = $this->initCommonVerdictBuilder($raceId);
        $builder->expression(
            'selectRpVerdict',
            'CASE
                WHEN EXISTS
                    (SELECT 1 FROM race_content_publish_time rcpt
                    WHERE rcpt.race_content_publish_race_uid = ri.race_instance_uid
                    AND rcpt.race_content_publish_time <= GETDATE()
                    AND rcpt.race_content_type_uid = ' . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . ' )
                THEN pric.rp_verdict ELSE NULL
            END'
        );
        $builder->build();

        $collection = new Resultset\General(
            null,
            new \Api\Row\Horse(),
            $this->getReadConnection()->query($builder->getSql(), $builder->getParams())
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param int $raceId
     *
     * @return \Api\Row\Horse[]
     */
    public function fetchPostPointerVerdict($raceId)
    {
        $builder = $this->initCommonVerdictBuilder($raceId);
        $builder->expression('selectRpVerdict', 'prig.text_field');
        $builder->expression(
            'joinPostPointerVerdict',
            ' AND prig.lookup_uid = ' . Constants::RACE_CONTENT_TYPE_LOOK_UP_VERDICT
        );

        $builder->build();
        $collection = new Resultset\General(
            null,
            new \Api\Row\Horse(),
            $this->getReadConnection()->query($builder->getSql(), $builder->getParams())
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param $raceId
     *
     * @return array
     */
    public function getTipsterVerdicts($raceId)
    {
        $sql = "
            SELECT
                prtv.race_instance_uid
                , prtv.verdict verdict
                , prtv.newspaper_uid newspaper_uid
                , newspaper_name = (SELECT newspaper_name FROM newspapers WHERE newspaper_uid = prtv.newspaper_uid)
                , prtv.tipster_uid tipster_uid
                , tipster_name = (SELECT tipster_name FROM rp_tipsters WHERE tipster_uid = prtv.tipster_uid)
                , prtv.expire_on expire_on
                , h.horse_uid
                , h.style_name horse_name
                , h.country_origin_code
                , ri.course_uid course_uid
                , c.style_name course_style_name
                , course_country_code = rtrim(c.country_code)
                , vs.selection_desc
                , owner_uid =   (SELECT owner_uid FROM horse_owner WHERE horse_uid = vs.horse_uid
                                        AND owner_change_date = ISNULL(
                                    (SELECT MIN(t2.owner_change_date)
                                        FROM horse_owner t2
                                        WHERE
                                            t2.horse_uid = vs.horse_uid
                                            AND t2.owner_change_date > ri.race_datetime
                                        ),
                                        '" . Constants::EMPTY_DATE_AND_TIME . "'
                                    )
                                )
                , phr.saddle_cloth_no
                , phr.non_runner
            FROM
                pre_race_tipster_verdicts prtv
                LEFT JOIN
                    race_instance ri
                        ON ri.race_instance_uid = prtv.race_instance_uid
                LEFT JOIN course c
                    ON c.course_uid = ri.course_uid
                LEFT JOIN verdict_selection vs
                    ON prtv.tipster_uid = vs.tipster_uid
                        AND vs.race_instance_uid = prtv.race_instance_uid
                        AND vs.newspaper_uid = prtv.newspaper_uid
                LEFT JOIN horse h
                    ON h.horse_uid = vs.horse_uid
                LEFT JOIN pre_horse_race phr
                    ON phr.race_instance_uid = ri.race_instance_uid
                    AND phr.horse_uid = vs.horse_uid
                    AND phr.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
                JOIN race_content_publish_time rcpt ON
                    rcpt.race_content_publish_race_uid = ri.race_instance_uid
                    AND rcpt.race_content_publish_time <= GETDATE()
                    AND rcpt.race_content_type_uid = CASE WHEN prtv.newspaper_uid = 56
                        THEN " . Constants::RACE_CONTENT_TYPE_PREMIUM_VERDICTS . "
                        ELSE " . Constants::RACE_CONTENT_TYPE_OTHER_VERDICTS . " END
            WHERE
                prtv.race_instance_uid = :raceId
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $collection = new Resultset\General(
            null,
            new \Api\Row\Horse(),
            $res
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param $raceId
     *
     * @return \StdClass
     */
    public function getComments($raceId)
    {
        $sql = "
            SELECT
                SUM(CASE WHEN ISNULL(CONVERT(VARCHAR(200), phrc.rp_current_spotlight), '') = '' THEN 0 ELSE 1 END) +
                SUM(CASE WHEN ISNULL(phrg.varchar_255, '') = '' THEN 0 ELSE 1 END) count_comments
            FROM race_instance ri
                JOIN pre_horse_race phr ON
                    phr.race_instance_uid = ri.race_instance_uid
                    AND phr.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
                JOIN horse h ON
                    h.horse_uid = phr.horse_uid
                LEFT JOIN pre_horse_race_comments phrc ON
                    phrc.race_instance_uid = phr.race_instance_uid
                    AND phrc.horse_uid = phr.horse_uid
                    AND phrc.race_instance_uid = phr.race_instance_uid
                LEFT JOIN pre_horse_race_genlkup phrg ON
                    phrg.race_instance_uid = ri.race_instance_uid
                    AND phrg.horse_uid = phr.horse_uid
                JOIN genlkup gl ON
                    gl.lookup_uid = phrg.lookup_uid
                    AND gl.source_table = 'PRE_RACE'
                    AND gl.description = 'DIOMED'
            WHERE ri.race_instance_uid = :raceId
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $collection->toArrayWithRows();

        $returnArray = null;
        $isCommentsAvailable = true;

        if (!empty($rtn) && $rtn[0]['count_comments'] > 0) {
            $sql = "
                SELECT
                    h.style_name horse_name,
                    h.country_origin_code,
                    h.horse_uid horse_id,
                    phrc.rp_current_spotlight spotlight,
                    ri.race_datetime,
                    phr.alt_silk_code,
                    phr.saddle_cloth_no,
                    phrg.varchar_255 diomed
                FROM race_instance ri
                    JOIN pre_horse_race phr ON
                        phr.race_instance_uid = ri.race_instance_uid
                        AND phr.race_status_code = (
                            CASE
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                ELSE ri.race_status_code
                            END)
                    JOIN horse h ON
                        h.horse_uid = phr.horse_uid
                    LEFT JOIN pre_horse_race_comments phrc ON
                        phrc.race_instance_uid = phr.race_instance_uid
                        AND phrc.horse_uid = phr.horse_uid
                        AND phrc.race_instance_uid = phr.race_instance_uid
                    LEFT JOIN pre_horse_race_genlkup phrg ON
                        phrg.race_instance_uid = ri.race_instance_uid
                        AND phrg.horse_uid = phr.horse_uid
                    JOIN genlkup gl ON
                        gl.lookup_uid = phrg.lookup_uid
                        AND gl.source_table = 'PRE_RACE'
                        AND gl.description = 'DIOMED'
                    JOIN race_content_publish_time rcpt ON
                        rcpt.race_content_publish_race_uid = ri.race_instance_uid
                        AND rcpt.race_content_publish_time <= GETDATE()
                        AND rcpt.race_content_type_uid = 1
                WHERE ri.race_instance_uid = :raceId
                ORDER BY h.style_name
            ";

            $res = $this->getReadConnection()->query(
                $sql,
                ['raceId' => $raceId]
            );

            $collection = new Resultset\General(
                null,
                new Row\General(),
                $res
            );

            $returnArray = $collection->toArrayWithRows();
            $isCommentsAvailable = !empty($returnArray);
        }

        $result = new \StdClass();
        $result->comments = $returnArray;
        $result->isCommentsAvailable = $isCommentsAvailable;

        return $result;
    }

    /**
     * @param int $raceId
     *
     * @return array|null
     * @throws Resultset\ResultsetException
     */
    public function getOtherDeclaration(int $raceId)
    {
        $sql = "
            SELECT
                h.style_name AS horse_name,
                h.country_origin_code,
                h.horse_uid,
                ri.race_instance_uid,
                ri.race_datetime,
                local_meeting_race_datetime =
                    dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime),
                clt.hours_difference,
                c.style_name AS course_name,
                c.course_uid
            FROM pre_horse_race phr
            INNER JOIN race_instance ri ON
                ri.race_instance_uid = phr.race_instance_uid
            INNER JOIN horse h ON
                h.horse_uid = phr.horse_uid
            LEFT JOIN course c ON
                c.course_uid = ri.course_uid
            LEFT JOIN course_local_time clt ON
                clt.course_uid = ri.course_uid AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
            WHERE phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND ri.race_status_code NOT IN (" . Constants::RACE_STATUS_RESULTS . ", "
            . Constants::RACE_STATUS_ABANDONED . ")
                AND phr.horse_uid IN (
                    SELECT
                        sub_phr.horse_uid
                    FROM pre_horse_race sub_phr
                    INNER JOIN race_instance sub_ri ON
                        sub_ri.race_instance_uid = sub_phr.race_instance_uid
                    WHERE sub_phr.race_instance_uid = :raceId AND sub_phr.race_status_code = "
            . Constants::RACE_STATUS_OVERNIGHT . "
                    AND ri.race_datetime BETWEEN
                        CONVERT(DATETIME, CONVERT(VARCHAR, dateadd(DD, -1, sub_ri.race_datetime), 101) + ' 00:00')
                        AND CONVERT(DATETIME, CONVERT(VARCHAR, dateadd(DD, 1, sub_ri.race_datetime), 101) + ' 23:59')
                )
                AND phr.race_instance_uid != :raceId
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $collection->toArrayWithRows();
        if (empty($rtn)) {
            return null;
        }

        return $rtn;
    }

    /**
     * @param $raceId int
     *
     * @return array
     */
    public function getForfeits($raceId)
    {
        $sql = "
            SELECT
                rif.stage,
                rif.forfeit_number,
                rif.forfeit_value
            FROM race_instance_forfeit rif
            WHERE race_instance_uid = :raceId
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $collection->toArrayWithRows();
        if (empty($rtn)) {
            return null;
        }

        return $rtn;
    }

    /**
     * @param $raceId int
     *
     * @return array
     */
    public function getClaimingPrices($raceId)
    {
        $sql = "
            SELECT DISTINCT
                h.style_name AS horse_name,
                h.country_origin_code,
                h.horse_uid,
                phr.saddle_cloth_no start_number,
                ehr.claim_value,
                ehr.currency_code,
                ehr.vat_percentage
            FROM ext_horse_race ehr
            INNER JOIN pre_horse_race phr ON
                phr.race_instance_uid = ehr.race_instance_uid
                AND phr.horse_uid = ehr.horse_uid
                AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            INNER JOIN horse h ON
                h.horse_uid = ehr.horse_uid
            WHERE ehr.race_instance_uid = :raceId
                AND ehr.claim_value > 0
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceId' => $raceId,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $collection->toArrayWithRows();

        return !empty($rtn) ? $rtn : null;
    }

    /**
     * @param      $raceId       int
     * @param      $countryCode  string
     * @param bool $withNonRunner
     *
     * @return RaceCards\Selections[]
     */
    public function getSelections($raceId, $countryCode, $withNonRunner = false)
    {
        $builder = new Builder();


        $builder->setSqlTemplate(
            "
                SELECT DISTINCT
                    np.newspaper_name
                    , np.newspaper_uid
                    , np.sort_order
                    , horse_name = h.style_name
                    , h.country_origin_code
                    , h.horse_uid
                    , phr.saddle_cloth_no
                    , phr.rp_owner_choice
                    , owner_uid = (
                        SELECT owner_uid
                        FROM horse_owner
                        WHERE horse_uid = phr.horse_uid
                            AND owner_change_date = ISNULL(
                            (SELECT MIN(t2.owner_change_date)
                                FROM horse_owner t2
                                WHERE
                                    t2.horse_uid = phr.horse_uid
                                    AND t2.owner_change_date > ri.race_datetime
                                ),
                                :owner_change_date_default:
                            )
                    )
                    , selection_type = st.selection_type_code
                    , st.selection_type_uid
                    , selection_cnt = -1
                    , nt.nap_today_count
                    , rpr_nap = (
                          SELECT count(1) FROM ss_nap_comp_today npc2 WHERE h.horse_uid = npc2.nap_horse_uid
                            AND npc2.tipster='RP Ratings'
                        )
                    , pd.going_output
                    , pd.distance_output
                    , pd.course_output
                    , pd.draw_output
                    , pd.ability_output
                    , pd.recent_form_output
                    , pd.trainer_form_output
                    , phr.rp_postmark
                    , non_runner = ISNULL(phr.non_runner, 'N')
                    , rpt.tipster_uid
                    , rpt.tipster_name
                FROM newspapers np
                    JOIN rp_tipsters rpt ON (np.newspaper_uid = rpt.newspaper_uid)
                    JOIN race_instance ri ON ri.race_instance_uid = :raceId:
                    JOIN tipster_selection_box tsb ON np.newspaper_uid = tsb.newspaper_uid
                        AND tsb.active_flag = 'Y'
                    JOIN tipster_selection ts ON (np.newspaper_uid = ts.newspaper_uid
                            AND ts.race_instance_uid = ri.race_instance_uid)
                    JOIN horse h ON (h.horse_uid = ts.horse_uid)
                    LEFT JOIN pre_horse_race phr ON phr.horse_uid = h.horse_uid
                        AND phr.race_instance_uid = ri.race_instance_uid
                        AND phr.race_status_code = (
                            CASE
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                ELSE ri.race_status_code
                            END)
                    LEFT JOIN selection_type st ON (st.selection_type_uid = ts.selection_type_uid)
                    LEFT JOIN postdata_results_new pd ON pd.race_instance_uid = ri.race_instance_uid
                        AND pd.horse_uid = h.horse_uid
                    LEFT JOIN (
                        SELECT
                            snc.nap_horse_uid
                            , nap_today_count = COUNT(*)
                        FROM
                            ss_nap_comp_today snc
                        GROUP BY
                            snc.nap_horse_uid
                        HAVING
                            COUNT(*) = MAX(COUNT(*))
                    ) nt ON h.horse_uid = nt.nap_horse_uid
                WHERE tsb.country_code = :country_code
                    AND np.sort_order IS NOT NULL
                    /*{WHERE}*/
                ORDER BY
                    np.sort_order
                    , newspaper_uid
            "
        );

        if (!$withNonRunner) {
            $builder->where(" AND ISNULL(phr.non_runner, '') != 'Y'");
        }

        $builder
            ->setParam('raceId', $raceId)
            ->setParam('country_code', $countryCode)
            ->setParam('owner_change_date_default', Constants::EMPTY_DATE_AND_TIME);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new Resultset\General(
            null,
            new RaceCards\Selections(),
            $result
        );

        $rows = $result->toArrayWithRows('newspaper_uid');

        return $rows;
    }

    /**
     * @param $raceDate
     *
     * @return array
     */
    public function getTopSelections($raceDate)
    {
        $this->dropTempTable("#s");
        $sql = "
            SELECT
                COUNT(1) selection_cnt,
                t.course_uid,
                t.course_style_name,
                h.horse_uid,
                h.style_name,
                h.country_origin_code,
                h.horse_name,
                t.race_instance_uid,
                t.race_datetime,
                t.race_instance_title,
                t.rp_owner_choice,
                t.jockey_uid
            INTO #s
            FROM
                (
                    SELECT DISTINCT
                        ri.course_uid,
                        c.course_uid,
                        course_style_name = c.style_name,
                        ri.race_instance_uid,
                        ri.race_datetime,
                        ri.race_instance_title,
                        ts.horse_uid,
                        phr.jockey_uid,
                        phr.rp_owner_choice,
                        np.newspaper_uid
                    FROM
                        race_instance ri
                        JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid 
                          AND pri.race_status_code = CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " 
                                                            THEN " . Constants::RACE_STATUS_OVERNIGHT . " ELSE ri.race_status_code END
                        JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid 
                          AND phr.race_status_code = pri.race_status_code
                        JOIN tipster_selection ts ON ts.race_instance_uid = ri.race_instance_uid AND ts.horse_uid = phr.horse_uid
                        JOIN newspapers np ON np.newspaper_uid = ts.newspaper_uid
                        JOIN rp_tipsters rpt ON np.newspaper_uid = rpt.newspaper_uid
                        JOIN tipster_selection_box tsb ON np.newspaper_uid = tsb.newspaper_uid
                            AND tsb.active_flag = 'Y' AND tsb.country_code IN ('GB', 'IRE')
                        JOIN course c ON ri.course_uid = c.course_uid AND c.country_code IN ('GB', 'IRE')

                    WHERE
                        ri.race_datetime BETWEEN :raceStartDate AND :raceEndDate
                        AND ri.race_status_code != " . Constants::RACE_STATUS_RESULTS . "
                        AND NOT EXISTS (SELECT 1 FROM race_attrib_join WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = 432)
                ) AS t
                JOIN horse h ON h.horse_uid = t.horse_uid
                WHERE t.jockey_uid IS NOT NULL
                GROUP BY
                    t.course_uid,
                    t.course_style_name,
                    h.horse_uid,
                    h.style_name,
                    h.horse_name,
                    h.country_origin_code,
                    t.race_instance_uid,
                    t.race_datetime,
                    t.race_instance_title,
                    t.rp_owner_choice,
                    t.jockey_uid
                ORDER BY selection_cnt DESC
        ";

        $this->getReadConnection()->query(
            $sql,
            [
                'raceStartDate' => $raceDate . ' 00:00:00.0',
                'raceEndDate' => $raceDate . ' 23:59:59.0',
            ],
            null,
            false
        );

        $sql = "
            SELECT
                s.selection_cnt,
                s.course_uid,
                s.course_style_name,
                s.horse_uid,
                horse_style_name = s.style_name,
                s.horse_name,
                horse_country_origin_code = s.country_origin_code,
                s.race_instance_uid,
                s.race_instance_title,
                s.race_datetime,
                o.owner_uid,
                o.owner_name,
                owner_style_name = o.style_name,
                s.rp_owner_choice,
                t.trainer_uid,
                t.trainer_name,
                trainer_style_name = t.style_name,
                j.jockey_uid,
                j.jockey_name,
                jockey_style_name = j.style_name
            FROM #s s
                LEFT JOIN jockey j ON j.jockey_uid = s.jockey_uid
                LEFT JOIN horse_owner ho ON ho.horse_uid = s.horse_uid AND ho.owner_change_date = isnull(
                                            (
                                                SELECT MIN(hoi.owner_change_date)
                                                FROM horse_owner hoi
                                                WHERE hoi.horse_uid = s.horse_uid
                                                    AND hoi.owner_change_date > s.race_datetime
                                            )
                                        , '" . Constants::EMPTY_DATE_AND_TIME . "')
                LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
                LEFT JOIN horse_trainer ht ON ht.horse_uid = s.horse_uid AND ht.trainer_change_date = isnull(
                                            (
                                                SELECT MIN(hti.trainer_change_date)
                                                FROM horse_trainer hti
                                                WHERE hti.horse_uid = ht.horse_uid
                                                    AND hti.trainer_change_date > s.race_datetime
                                            )
                                        , '" . Constants::EMPTY_DATE_AND_TIME . "')
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid

            WHERE s.selection_cnt = (SELECT MAX(selection_cnt) FROM #s)
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            null,
            null,
            false
        );

        $result = new Resultset\General(
            null,
            new RaceCards\Selections(),
            $result
        );

        $rows = $result->toArrayWithRows();
        $this->dropTempTable("#s");

        return $rows;
    }

    public function getOfficialRating($raceId)
    {

        $sql = "
            SELECT
                h.horse_uid,
                h.style_name horse_name,
                h.country_origin_code,
                phr.weight_carried_lbs,
                (CASE WHEN phr.extra_weight_lbs < 1 THEN NULL ELSE phr.extra_weight_lbs END) extra_weight,
                phr.official_rating official_rating,
                official_rating_today = NULL,
                prhs.adjustment,
                phr.jockey_uid jockey_id,
                last_races = NULL,
                lifetime_high = NULL,
                lifetime_low = NULL,
                annual_high = NULL,
                annual_low = NULL,
                current_official_rating = (
                    SELECT
                        CASE
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND ri.race_type_code = " . Constants::RACE_TYPE_NH_FLAT . " THEN 0
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND ri.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . " THEN rh2.current_official_aw_rating
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND ri.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . " THEN rh2.current_official_turf_rating
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND ri.race_type_code IN (" . Constants::RACE_TYPE_CHASE . " ) THEN rh2.current_official_rating_chase
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND ri.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . " THEN rh2.current_official_rating_hurdle
                        END
                      FROM
                          racing_horse rh2
                      WHERE
                          rh2.horse_uid = phr.horse_uid
                ),
                phr.saddle_cloth_no,
                lh_weight_carried_lbs = NULL,
                out_of_handicap = NULL
            FROM race_instance ri
            INNER JOIN pre_horse_race phr ON
                ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = CASE
                    WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                    ELSE ri.race_status_code
                    END
            INNER JOIN horse h ON
                h.horse_uid = phr.horse_uid
            LEFT JOIN pre_rfu_horse_stats prhs ON
                prhs.race_instance_uid = phr.race_instance_uid
                AND prhs.horse_uid = phr.horse_uid
            LEFT JOIN race_group rg ON
                rg.race_group_uid = ri.race_group_uid
            WHERE
                phr.race_instance_uid = :raceId
            ORDER BY phr.saddle_cloth_no
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $collection = new Resultset\General(
            null,
            new RaceCards\OfficialRating(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    public function getHighestOfficialRating($raceId)
    {

        $sql = "
            SELECT
                h.horse_uid,
                phr.saddle_cloth_no start_number,
                h.style_name horse_name,
                h.country_origin_code,
                official_rating = phr.official_rating +  ISNULL(phr.extra_weight_lbs, 0),
                phr.weight_carried_lbs
            FROM race_instance ri
            INNER JOIN pre_horse_race phr ON
                ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = CASE 
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END
            INNER JOIN horse h ON
                h.horse_uid = phr.horse_uid
            WHERE
                phr.race_instance_uid = :raceId
            ORDER BY phr.official_rating DESC
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $collection->toArrayWithRows();
        if (empty($rtn)) {
            return null;
        }

        return $rtn;
    }

    /**
     * @param int    $horseId
     * @param string $raceDate
     * @param array  $raceTypeCodes
     * @param string $adjustment
     * @param int    $limit
     *
     * @return array
     * @throws \Exception
     */
    public function getOfficialRatingLastRaces(
        $horseId,
        $raceDate,
        $raceTypeCodes,
        $adjustment,
        $limit
    ) {
        if (!is_numeric($limit)) {
            throw new \Exception('Parameter "limit" must be numeric');
        }

        $sql = "
            SELECT TOP  {$limit}
                       ri.race_instance_uid,
                       ri.race_datetime,
                       ri.race_type_code,
                       rp_postmark = isnull(
                          CASE
                            WHEN hr.rp_postmark < 1 THEN 0
                            ELSE hr.rp_postmark + CONVERT(INT, {$this->getReadConnection()->escapeString($adjustment)})
                          END, 0),
                       c.course_uid,
                       c.course_name,
                       course_style_name = c.style_name,
                       course_country = rtrim(c.country_code),
                       ri.distance_yard,
                       services_desc = rtrim(gt.services_desc),
                       race_outcome_code = rtrim(ro.race_outcome_code),
                       rp_topspeed = isnull(CASE WHEN hr.rp_topspeed < 1 THEN 0 ELSE hr.rp_topspeed END,0),
                       hrc.rp_close_up_comment comment,
                       (
                            SELECT count(1)
                            FROM horse_race hr1
                            INNER JOIN race_outcome ro1 ON (ro1.race_outcome_uid = hr1.final_race_outcome_uid
                                AND ro1.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . "))
                            WHERE hr1.race_instance_uid = ri.race_instance_uid
                        ) AS no_of_runners_calculated,
                       official_rating = isnull(CASE WHEN hr.official_rating_ran_off < 1 THEN 0 else hr.official_rating_ran_off END, 0),
                       rg.race_group_code
               FROM
                    race_instance ri
                    INNER JOIN horse_race hr ON
                        hr.race_instance_uid = ri.race_instance_uid
                    INNER JOIN course c ON
                        c.course_uid = ri.course_uid
                    LEFT JOIN going_type gt ON
                        gt.going_type_code = ri.going_type_code
                    INNER JOIN race_outcome ro ON
                        ro.race_outcome_uid = hr.final_race_outcome_uid
                        AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                    LEFT JOIN horse_race_comments hrc ON
                        hrc.race_instance_uid = hr.race_instance_uid
                        AND hrc.horse_uid = hr.horse_uid
                    LEFT JOIN race_group rg ON
                        rg.race_group_uid = ri.race_group_uid
               WHERE
                    ri.race_datetime < :raceDate
                    AND hr.horse_uid = :horseId
                    AND ri.race_type_code like :raceTypeCodes:

               ORDER BY ri.race_datetime DESC
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceDate' => $raceDate,
                'horseId' => $horseId,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows();

        return $returnArray;
    }


    /**
     * @autor Andriy Zubrytskyy
     *
     * @param int|array $horseUid
     * @param           $raceType
     * @param bool      $isMin
     *
     * @return array
     */
    public function getLifetime($horseUid, $raceType, $isMin = false)
    {
        if (!is_array($horseUid)) {
            $horseUid = [$horseUid];
        }

        $sql = "
        SELECT
            hr.horse_uid
            , hr.official_rating_ran_off
            , hr.rp_postmark
            , hr.rp_topspeed
            , ri.race_type_code
            , c.course_uid
            , course_style_name = c.style_name
            , c.course_name
            , ri.race_instance_uid
            , ri.race_datetime
            , ri.race_instance_title
            , ri.distance_yard
            , hrc.rp_close_up_comment
            , race_outcome_code = '1'
            , services_desc = rtrim(gt.services_desc)
            , rg.race_group_code
            , no_runners = (
                SELECT count(*) FROM horse_race hr3
                WHERE hr3.race_instance_uid = ri.race_instance_uid
                    AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            )
        FROM
            horse_race hr
            , course c
            , race_instance ri
            , horse_race_comments hrc
            , going_type gt
            , race_group rg
        WHERE
            hr.horse_uid IN (:horseUid)
            AND hr.official_rating_ran_off = (
                SELECT " . ($isMin ? 'MIN' : 'MAX') . " (hr2.official_rating_ran_off)
                FROM horse_race hr2,
                    race_instance ri2,
                    race_group rg2
                WHERE
                    hr2.horse_uid = hr.horse_uid " . ($isMin ? 'AND hr.official_rating_ran_off > 0' : null) . "
                    AND hr2.final_race_outcome_uid IN (1,71)
                    AND ri2.race_instance_uid = hr2.race_instance_uid
                    AND ri2.race_type_code = ri.race_type_code
                    AND rg2.race_group_uid = ri2.race_group_uid
                    AND rg2.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                )
            AND hr.final_race_outcome_uid IN (1,71)
            AND ri.race_instance_uid = hr.race_instance_uid
            AND ri.race_type_code = :raceType
            AND c.course_uid = ri.course_uid
            AND hrc.race_instance_uid =* hr.race_instance_uid
            AND hrc.horse_uid =* hr.horse_uid
            AND gt.going_type_code =* ri.going_type_code
            AND rg.race_group_uid = ri.race_group_uid
            AND rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceType' => $raceType,
                'horseUid' => $horseUid,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows('horse_uid');

        return $returnArray;
    }

    /**
     * @author Andriy Zubrytskyy
     *
     * @param int|array $horseUid
     * @param           $raceType
     * @param bool      $isMin
     *
     * @return array
     */
    public function getAnnual($horseUid, $raceType, $isMin = false)
    {
        $sql = "
            SELECT
                hr.horse_uid
                , hr.official_rating_ran_off
                , hr.rp_postmark
                , hr.rp_topspeed
                , ri.race_type_code
                , c.course_uid
                , c.course_name
                , course_style_name = c.style_name
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , race_outcome_code = '1'
                , services_desc = rtrim(gt.services_desc)
                , rg.race_group_code
                , no_runners = (SELECT count(*) FROM horse_race hr3
                   WHERE hr3.race_instance_uid = ri.race_instance_uid
                       AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            FROM
                horse_race hr
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
                , race_group rg
            WHERE
                hr.horse_uid IN (:horseUid:)
                AND hr.official_rating_ran_off =
                    (SELECT " . ($isMin ? 'MIN' : 'MAX') . "(hr2.official_rating_ran_off)
                    FROM horse_race hr2,
                        race_instance ri2,
                        race_group rg2
                    WHERE
                        hr2.horse_uid = hr.horse_uid
                        AND hr.official_rating_ran_off > 0
                        AND hr2.final_race_outcome_uid IN (1,71)
                        AND ri2.race_instance_uid = hr2.race_instance_uid
                        AND ri2.race_type_code = ri.race_type_code
                        AND ri2.race_datetime > DATEADD(DAY, -365, CONVERT(DATE, GETDATE()))
                        AND rg2.race_group_uid = ri2.race_group_uid
                        AND rg2.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                    )
                AND hr.final_race_outcome_uid IN (1,71)
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.race_type_code = :raceType
                AND ri.race_datetime > DATEADD(DAY, -365, CONVERT(DATE, GETDATE()))
                AND c.course_uid = ri.course_uid
                AND hrc.race_instance_uid =* hr.race_instance_uid
                AND hrc.horse_uid =* hr.horse_uid
                AND gt.going_type_code =* ri.going_type_code
                AND rg.race_group_uid = ri.race_group_uid
                AND rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceType' => $raceType,
                'horseUid' => $horseUid,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows('horse_uid');

        return $returnArray;
    }

    /**
     * @param string $raceDate
     * @param bool $isFullList
     * @return array
     * @throws Resultset\ResultsetException
     */
    public function getMeetingByDate($raceDate, $isFullList = false)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                DISTINCT t.course_uid,
                t.mixed_course_uid,
                t.course_name,
                t.course_style_name,
                t.rp_abbrev_3,
                t.country_code,
                t.course_type_code,
                t.latitude,
                t.longitude,
                t.race_date,
                CASE
                    WHEN SUM( t.finished_race ) > 0 THEN 1
                    ELSE 0
                END has_finished_race,
                CASE
                    WHEN SUM( t.abandoned ) = COUNT( t.race_instance_uid ) THEN 1
                    ELSE 0
                END abandoned,
                t.going_desc,
                t.stalls_position,
                t.pmd_going_desc,
                t.race_status_code,
                t.pre_weather_desc,
                t.fgn 'foreign',
                t.meeting_number,
                t.digital_colour,
                t.digital_order,
                t.rails,
                t.tote_jackpot_yn,
                aw_surface_type =(
                    CASE
                        WHEN t.race_type_code IN (" . Constants::RACE_TYPE_AW . ") THEN(
                            SELECT
                                ral.race_attrib_desc
                            FROM
                                race_attrib_join raj,
                                race_attrib_lookup ral
                            WHERE
                                raj.race_attrib_uid = ral.race_attrib_uid
                                AND raj.race_instance_uid = t.race_instance_uid
                                AND raj.race_attrib_uid BETWEEN 402 AND 411
                        )
                        ELSE null
                    END
                ),
                races = NULL,
                cards_order = NULL,
                complete_card = NULL,
                early_complete_card = NULL
            FROM
                (
                    SELECT
                        ri.race_instance_uid,
                        ri.race_type_code,
                        ri.race_status_code,
                        c.course_uid,
                        CASE
                            WHEN c2.course_uid IS NOT NULL
                            AND c2.course_uid != c.course_uid THEN c2.course_uid
                        END mixed_course_uid,
                        c.course_name,
                        c.style_name course_style_name,
                        c.rp_abbrev_3,
                        country_code = rtrim( c.country_code ),
                        CASE
                            WHEN c2.course_type_code IS NOT NULL THEN c2.course_type_code
                            ELSE c.course_type_code
                        END course_type_code,
                        c.latitude,
                        c.longitude,
                        CONVERT(
                            varchar(10),
                            ri.race_datetime,
                            101
                        ) race_date,
                        ri.race_datetime,
                        CASE
                            WHEN c.country_code IN(
                                'GB',
                                'IRE'
                            )
                            AND ri.race_datetime > {$this->getReadConnection()->escapeString($raceDate.' 00:00:00.0')}
                            AND ri.race_status_code =" . Constants::RACE_STATUS_RESULTS . "
                            AND ri.formbook_yn = 'Y' THEN 1
                            ELSE 0
                        END finished_race,
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_ABANDONED . " THEN 1
                            ELSE 0
                        END abandoned,
                        md.going_desc,
                        md.stalls_position,
                        md.rails,
                        pmd.going_desc as pmd_going_desc,
                        pmd.weather_details pre_weather_desc,
                        CASE
                            WHEN c.country_code IN(
                                'GB',
                                'IRE'
                            ) THEN 0
                            ELSE 1
                        END fgn,
                        mc.meeting_number,
                        mdc.meeting_digital_number digital_colour,
                        mdc.meeting_digital_order digital_order,
                        CASE
                            WHEN mdc.meeting_digital_order IS NULL THEN 1
                            ELSE 0
                        END additional_ordering,
                        pmd.tote_jackpot_yn
                    FROM
                        race_instance ri
                    JOIN pre_race_instance pri ON
                        pri.race_instance_uid = ri.race_instance_uid
                    INNER JOIN course c ON
                        c.course_uid = ri.course_uid
                    LEFT JOIN course c2 ON
                        -- Mixed meeting checking
                        c.rp_abbrev_3 = c2.rp_abbrev_3
                        AND c.country_code = c2.country_code
                        AND c2.course_uid IN (" . Constants::MIXED_COURSES_IDS . ")
                        AND EXISTS(
                            SELECT
                                1
                            FROM
                                race_instance ri2
                            WHERE
                                ri2.race_datetime BETWEEN :dayStart AND :dayEnd
                                AND DAY(ri2.race_datetime)= DAY(ri.race_datetime)
                                AND ri2.course_uid != c.course_uid
                                AND ri2.course_uid = c2.course_uid
                        )
                    LEFT JOIN pre_meeting_details pmd ON
                        pmd.course_uid = CASE
                            WHEN c2.course_uid IS NOT NULL THEN c2.course_uid
                            ELSE c.course_uid
                        END
                        AND pmd.meeting_date = :meetingDate
                    LEFT JOIN meeting_details md ON
                        md.course_uid =(
                            CASE
                                WHEN c2.course_uid IS NOT NULL THEN c2.course_uid
                                ELSE c.course_uid
                            END
                        )
                        AND md.meeting_date =:meetingDate
                    LEFT JOIN meeting_colours mc ON
                        mc.course_uid = c.course_uid
                        AND mc.meeting_date = :meetingDate
                    LEFT JOIN meeting_digital_colours mdc ON
                        mdc.course_uid = c.course_uid
                        AND mdc.meeting_date = :meetingDate
                    LEFT JOIN course_local_time clt ON
                        clt.course_uid = ri.course_uid
                        AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
                    WHERE
                        ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                        AND ri.race_datetime BETWEEN :dayStartWide AND :dayEndWide
                        AND(
                            datediff(
                                day,
                                dateadd(
                                    MINUTE,
                                    isnull(
                                        clt.hours_difference,
                                        0
                                    )* 60,
                                    ri.race_datetime
                                ),
                                :meetingDate
                            )= 0
                            OR datediff(
                                day,
                                ri.race_datetime,
                                :meetingDate
                            )= 0
                        )
                        AND CASE
                            WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1'
                            ELSE CASE
                                WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN '0'
                                ELSE pri.race_status_code
                            END
                        END =(
                            SELECT
                                MIN(CASE
                                      WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1'
                                      ELSE CASE
                                            WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN '0'
                                            ELSE ipri.race_status_code
                                           END
                                    END
                                )
                            FROM
                                pre_race_instance ipri
                            WHERE
                                ipri.race_instance_uid = ri.race_instance_uid
                            GROUP BY
                                ipri.race_instance_uid
                        ) /*{WHERE}*/
                ) AS t
            GROUP BY
                course_uid
            ORDER BY
                (
                    CASE
                        WHEN t.country_code IN(
                            'GB',
                            'IRE'
                        )
                        AND abandoned = 0 THEN 0
                        WHEN t.country_code IN(
                            'GB',
                            'IRE'
                        )
                        AND abandoned = 1 THEN 2
                        WHEN t.country_code = 'ARO' THEN 3
                        ELSE 1
                    END
                ),
                MIN( race_datetime ),
                t.rp_abbrev_3
        ");

        if (!$isFullList) {
            $exclusion = parent::getSpecialFlagExclusionCondition();
            $builder->where("AND {$exclusion}");
        }

        $builder
            ->setParam('dayStartWide', date("Y-m-d H:i:s", strtotime($raceDate . " 00:00:00 -12 hours")))
            ->setParam('dayEndWide', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59 +12 hours")))
            ->setParam('dayStart', $raceDate . ' 00:00:00.0')
            ->setParam('dayEnd', $raceDate . ' 23:59:59.0')
            ->setParam('meetingDate', $raceDate);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new Resultset\General(
            null,
            new \Api\Row\Meeting(),
            $result
        );

        return $collection->toArrayWithRows('course_uid');
    }

    /**
     * @param string $raceDate
     * @param bool   $isFullList
     *
     * @return array
     */
    public function getRacesListByDate($raceDate, $isFullList = false)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                t.course_uid,
                t.replaced_aw,
                t.race_instance_uid,
                t.race_datetime,
                t.race_instance_title,
                t.race_group_uid,
                t.race_type_code,
                t.distance_yard,
                t.rp_ages_allowed_desc,
                t.race_status_code,
                t.mnemonic,
                t.rp_abbrev_3,
                t.race_selection_type,
                t.satelite_tv_txt,
                t.terrestrial_tv_txt,
                t.rp_tv_text,
                t.count_runners,
                t.declared_runners,
                t.no_of_runners,
                t.spotlight_tipped_horse_name,
                t.country_code,
                t.local_meeting_race_datetime,
                t.hours_difference,
                is_fast_result = 0,
                t.int_1,
                t.lookup_uid,
                (
                    SELECT DISTINCT ral.race_attrib_desc
                        FROM race_attrib_join raj, race_attrib_lookup ral
                        WHERE t.race_instance_uid = raj.race_instance_uid
                        AND raj.race_attrib_uid = ral.race_attrib_uid
                        AND ral.race_attrib_code = (
                            CASE WHEN t.country_code = 'GB' THEN 'Class_subset'  ELSE 'Class' END
                        )
                ) AS race_class,
                t.is_worldwide_stake,
                t.is_scoop6_race,
                (
                    SELECT DISTINCT ral.race_attrib_desc
                        FROM race_attrib_join raj, race_attrib_lookup ral
                        WHERE t.race_instance_uid = raj.race_instance_uid
                        AND raj.race_attrib_uid = ral.race_attrib_uid
                        AND ral.race_attrib_code = 'Surface'
                ) AS surface,
                t.early_closing_race_yn,
                perform_race_uid_atr = (
                        SELECT MAX(perform_race_uid)
                        FROM perform_race
                        WHERE perform_race.race_instance_uid = t.race_instance_uid AND isATR = 1
                    ),
                perform_race_uid_ruk = (
                        SELECT MAX(perform_race_uid)
                        FROM perform_race
                        WHERE perform_race.race_instance_uid = t.race_instance_uid AND isATR IS NULL
                    ),
                t.prize,
                t.pool_prize_sterling,
                t.straight_round_jubilee_code,
                t.duplicate_race,
                t.rp_confirmed,
                official_rating_band_desc = rtrim(t.official_rating_band_desc),
                t.free_to_air_yn
            FROM
                (
                    SELECT DISTINCT
                        pric.rp_tv_text,
                        c.course_uid,
                        CASE WHEN c2.course_uid IS NOT NULL AND c2.course_uid != c.course_uid
                             THEN c2.course_uid END mixed_course_uid,
                        CASE WHEN c.mnemonic != c2.mnemonic THEN 1 ELSE NULL END replaced_aw,
                        ri.race_instance_uid,
                        ri.race_datetime,
                        ri.race_instance_title,
                        ri.race_type_code,
                        ri.distance_yard,
                        aa.rp_ages_allowed_desc,
                        ri.race_status_code,
                        ri.race_group_uid,
                        ri.pool_prize_sterling,
                        rig.int_1,
                        rig.lookup_uid,
                        c.mnemonic,
                        c.rp_abbrev_3,
                        sel.race_selection_type,
                        satelite_tv_txt =
                            CASE WHEN pric.rp_tv_text NOT IN (:tvCodes)
                                 THEN pric.rp_tv_text ELSE '' END,
                        terrestrial_tv_txt =
                            CASE WHEN pric.rp_tv_text IN (:tvCodes)
                                 THEN pric.rp_tv_text ELSE '' END,
                        count_runners = (
                            SELECT
                                count(*)
                            FROM
                                pre_horse_race phr
                            WHERE
                                phr.race_instance_uid = ri.race_instance_uid
                                AND phr.race_status_code =
                                    CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                         THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                         ELSE ri.race_status_code
                                     END
                        ),
                        country_code = rtrim(c.country_code),
                        h_ts_spotlight.style_name AS spotlight_tipped_horse_name,
                        is_worldwide_stake = CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                                                AND ri.race_group_uid IN (1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 13)
                                            THEN 1 ELSE 0
                                       END,
                        is_scoop6_race = CASE WHEN sel.race_selection_type LIKE 'S6' THEN 1 ELSE 0 END,
                        no_of_runners =
                            CASE
                                WHEN pri.race_status_code IN (" . Constants::RACE_STATUS_6DAYS
            . "," . Constants::RACE_STATUS_5DAYS
            . "," . Constants::RACE_STATUS_4DAYS
            . "," . Constants::RACE_STATUS_3DAYS . ")
                                THEN CASE
                                        WHEN pric.rp_confirmed IS NULL
                                        THEN pri.no_of_runners ELSE pric.rp_confirmed END
                            WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN
                                (SELECT
                                    COUNT(*)
                                FROM
                                    pre_horse_race phr1
                                WHERE phr1.race_instance_uid = ri.race_instance_uid
                                    AND phr1.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                    AND (phr1.doubtful_runner IS NULL OR phr1.doubtful_runner != 'Y')
                                    AND (phr1.non_runner IS NULL OR phr1.non_runner != 'Y')
                                    AND (phr1.irish_reserve_yn IS NULL OR phr1.irish_reserve_yn != 'Y')
                                )
                            ELSE pri.no_of_runners
                        END,
                        declared_runners = pri.no_of_runners,
                        early_closing_race_yn = CASE WHEN upper(pri.early_closing_race_yn) = 'Y' 
                                                     THEN 'Y'  ELSE 'n' 
                                                END,
                        prize = CASE WHEN c.country_code = 'IRE' THEN rip.prize_euro ELSE rip.prize_sterling END,
                        srjc.straight_round_jubilee_code,
                        duplicate_race =
                            CASE
                              WHEN DAY(ri.race_datetime) !=
                                   DAY(dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime))
                              THEN 'Y' ELSE 'N'
                            END,
                        local_meeting_race_datetime =
                            dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime),
                        clt.hours_difference,
                        pric.rp_confirmed,
                        orb.official_rating_band_desc,
                        t.free_to_air_yn
                    FROM
                        race_instance ri
                        INNER JOIN course c ON
                            ri.course_uid = c.course_uid
                            
                        INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                        LEFT JOIN course c2 ON -- Mixed meeting checking
                            c.rp_abbrev_3 = c2.rp_abbrev_3
                            AND c.country_code = c2.country_code
                            AND c2.course_uid = 31
                            AND EXISTS (
                                SELECT 1
                                FROM race_instance ri2
                                WHERE ri2.race_datetime BETWEEN :dayStart: AND :dayEnd:
                                    AND DAY(ri2.race_datetime) = DAY(ri.race_datetime)
                                    AND ri2.course_uid != c.course_uid
                                    AND ri2.course_uid = c2.course_uid
                                )
                        LEFT JOIN race_selection sel ON
                            ri.race_instance_uid = sel.race_instance_uid
                        LEFT JOIN pre_race_instance_comments pric ON
                            pric.race_instance_uid = ri.race_instance_uid
                        LEFT JOIN ages_allowed aa ON
                            aa.ages_allowed_uid = ri.ages_allowed_uid
                        LEFT JOIN tipster_selection ts_spotlight ON
                            ts_spotlight.race_instance_uid = ri.race_instance_uid
                            AND ts_spotlight.newspaper_uid = 1
                        LEFT JOIN horse h_ts_spotlight ON
                            h_ts_spotlight.horse_uid = ts_spotlight.horse_uid
                        LEFT JOIN race_instance_prize rip
                            ON rip.race_instance_uid = ri.race_instance_uid AND rip.position_no = 1
                        LEFT JOIN straight_round_jubilee srjc
                            ON ri.straight_round_jubilee_code = srjc.straight_round_jubilee_code
                        LEFT JOIN course_local_time clt ON
                            clt.course_uid = ri.course_uid AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
                        LEFT JOIN official_rating_band orb ON orb.official_rating_band_uid = ri.official_rating_band_uid
                        LEFT JOIN tvchannel t ON t.tvchannel_name = pric.rp_tv_text
                        LEFT JOIN race_instance_genlkup rig ON
                            ri.race_instance_uid = rig.race_instance_uid
                            AND rig.lookup_uid = " . Constants::LIVESTREAM_LOOKUP_ID . "
                    WHERE
                        ri.race_datetime BETWEEN :dayStartWide: AND :dayEndWide:
                        AND (
                            datediff(
                                DAY,
                                dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime),
                                :meetingDate:
                            ) = 0
                          OR
                            datediff(DAY, ri.race_datetime  , :meetingDate:) = 0
                          )
                          AND CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                 THEN '-1'
                                 ELSE
                                    CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                         THEN '0' ELSE pri.race_status_code
                                    END
                            END = (
                                SELECT MIN(
                                    CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                         THEN '-1'
                                         ELSE
                                            CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                                 THEN '0' ELSE ipri.race_status_code
                                            END
                                    END
                            )
                            FROM pre_race_instance ipri
                            WHERE ipri.race_instance_uid = ri.race_instance_uid
                            GROUP BY ipri.race_instance_uid
                        )
                        /*{WHERE}*/
                ) AS t
            ORDER BY
                t.race_datetime ASC
        ");

        if (!$isFullList) {
            $builder->where("
                AND NOT EXISTS (
                    SELECT 1
                    FROM race_attrib_join
                    WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = :raceAttribUid:
                )
            ");
        }

        $builder
            ->setParam('dayStartWide', date("Y-m-d H:i:s", strtotime($raceDate . " 00:00:00 -12 hours")))
            ->setParam('dayEndWide', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59 +12 hours")))
            ->setParam('dayStart', $raceDate . ' 00:00:00.0')
            ->setParam('dayEnd', $raceDate . ' 23:59:59.0')
            ->setParam('meetingDate', $raceDate)
            ->setParam('raceAttribUid', Constants::INCOMPLETE_CARD_ATTRIBUTE_ID)
            ->setParam('tvCodes', Constants::SATELLITE_TV_CODES);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param string $raceDate
     *
     * @return array
     */
    public function checkFastResults($raceDate)
    {
        $sql = "
            SELECT
                ri.race_instance_uid,
                fri.fast_race_instance_uid
            FROM
                race_instance ri
                LEFT JOIN course_local_time clt ON
                        clt.course_uid = ri.course_uid AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
                JOIN fast_race_instance fri ON ri.race_datetime = fri.race_datetime
                JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                ri.race_datetime BETWEEN :dayStartWide AND :dayEndWide
                AND (
                    datediff(DAY, dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime) , :meetingDate) = 0
                  OR
                    datediff(DAY, ri.race_datetime  , :meetingDate) = 0
                  )
                AND ri.race_status_code != " . Constants::RACE_STATUS_RESULTS . "
                AND (
                    UPPER(c.course_name) LIKE UPPER(fri.course_name) + '%'
                    OR UPPER(fri.course_name) LIKE UPPER(c.course_name) + '%'
                )
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'dayStartWide' => date("Y-m-d H:i:s", strtotime($raceDate . " 00:00:00 -12 hours")),
                'dayEndWide' => date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59 +12 hours")),
                'meetingDate' => $raceDate,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows('race_instance_uid');

        return $returnArray;
    }

    public function getRunnersIndexByDate($raceDate)
    {
        $exclusion = parent::getSpecialFlagExclusionCondition();

        $sql = "
            SELECT h.style_name,
                   h.country_origin_code,
                   '' runners_index_outcome,
                   '' odds_desc,
                   c1.course_uid,
                   c1.rp_abbrev_3,
                   c1.course_name,
                   course_style_name = c1.style_name,
                   j.jockey_uid,
                   jockey_style_name = j.style_name,
                   o1.owner_uid,
                   owner_style_name = o1.style_name,
                   ri.race_datetime,
                   ri.race_instance_uid,
                   ri.race_status_code,
                   ten_to_follow_horse = htf.horse_uid,
                   htf.reasoning,
                   ri.race_type_code,
                   h.horse_uid
            FROM race_instance ri 
            INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
            INNER JOIN horse h ON h.horse_uid = phr.horse_uid
            INNER JOIN course c1 ON c1.course_uid = ri.course_uid
            INNER JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid
            INNER JOIN owner o1 ON o1.owner_uid = ho.owner_uid
            LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
            LEFT JOIN horse_to_follow htf ON htf.horse_uid = h.horse_uid 
                AND htf.to_follow_uid = " . Constants::TEN_TO_FOLLOW_HORSE_FOLLOW_ID ."
            WHERE ri.race_datetime BETWEEN :raceDate: AND :raceDateEnd:
            AND   ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
            AND   ho.owner_change_date = isnull(
                        (SELECT MIN(hoi.owner_change_date)
                          FROM horse_owner hoi
                          WHERE hoi.horse_uid = ho.horse_uid
                          AND hoi.owner_change_date >= ri.race_datetime)
                        , CONVERT(DATETIME, '1 jan 1900')
                    )
            AND   phr.race_status_code = ri.race_status_code
            AND   ISNULL(phr.non_runner, '') != 'Y'
            AND   h.country_origin_code != 'ARO'
            AND NOT EXISTS (SELECT 1 FROM race_attrib_join WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = 432)
            AND NOT EXISTS (
                SELECT 1 FROM horse_race hr
                WHERE hr.race_instance_uid = ri.race_instance_uid
                AND   h.horse_uid = hr.horse_uid
            )
            UNION ALL
            SELECT h.style_name,
                   h.country_origin_code,
                   str_replace(
                        str_replace(
                            (case when ro.race_outcome_position = 0
                                then ro.race_outcome_code
                                else ro.race_outcome_desc
                            end), 'Dead-heat', 'DH'),
                        'Deadheat', 'DH') runners_index_outcome,
                   o.odds_desc,
                   c1.course_uid,
                   c1.rp_abbrev_3,
                   c1.course_name,
                   course_style_name = c1.style_name,
                   j.jockey_uid,
                   jockey_style_name = j.style_name,
                   o1.owner_uid,
                   owner_style_name = o1.style_name,
                   ri.race_datetime,
                   ri.race_instance_uid,
                   ri.race_status_code,
                   ten_to_follow_horse = htf.horse_uid,
                   htf.reasoning,
                   ri.race_type_code,
                   h.horse_uid
            FROM race_instance ri
                INNER JOIN horse_race hr ON
                    hr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON
                    h.horse_uid = hr.horse_uid
                INNER JOIN course c1 ON
                    c1.course_uid = ri.course_uid
                INNER JOIN horse_owner ho ON
                    ho.horse_uid = hr.horse_uid
                    AND ho.owner_change_date = isnull(
                        (SELECT MIN(hoi.owner_change_date)
                          FROM horse_owner hoi
                          WHERE hoi.horse_uid = ho.horse_uid
                          AND hoi.owner_change_date >= ri.race_datetime)
                        , CONVERT(DATETIME, '1 jan 1900')
                    )
                INNER JOIN owner o1 ON
                    o1.owner_uid = ho.owner_uid
                INNER JOIN race_outcome ro ON
                    ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                LEFT JOIN jockey j ON
                    j.jockey_uid = hr.jockey_uid
                LEFT JOIN odds o ON
                    o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN horse_to_follow htf ON htf.horse_uid = h.horse_uid 
                    AND htf.to_follow_uid = " . Constants::TEN_TO_FOLLOW_HORSE_FOLLOW_ID ."
            WHERE ri.race_datetime BETWEEN :raceDate: AND :raceDateEnd:
                AND   ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND   h.country_origin_code != 'ARO'
                AND $exclusion
            ORDER BY h.style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceDate' => $raceDate . ' 00:00:00.0',
                'raceDateEnd' => $raceDate . ' 23:59:59.0',
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows();

        return $returnArray;
    }

    public function getNonRunnersIndexByDate($raceDate)
    {
        $sql = "
            SELECT DISTINCT h.style_name style_name,
                     h.country_origin_code,
                     c1.rp_abbrev_3,
                     c1.course_uid,
                     c1.course_name,
                     course_style_name = c1.style_name,
                     j.jockey_uid,
                     jockey_style_name = j.style_name,
                     o1.owner_uid,
                     owner_style_name = o1.style_name,
                     ri.race_datetime,
                     ri.race_instance_uid,
                     ten_to_follow_horse = htf.horse_uid,
                     htf.reasoning,
                     ri.race_type_code,
                     h.horse_uid,
                     ri.race_status_code
                FROM race_instance ri 
                INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                INNER JOIN course c1 ON c1.course_uid = ri.course_uid
                INNER JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid
                INNER JOIN owner o1 ON o1.owner_uid = ho.owner_uid
                LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
                LEFT JOIN horse_to_follow htf ON htf.horse_uid = h.horse_uid 
                    AND htf.to_follow_uid = " . Constants::TEN_TO_FOLLOW_HORSE_FOLLOW_ID ."
                WHERE ri.race_datetime BETWEEN :raceDate AND :raceDateEnd
                AND   ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND   ho.owner_change_date = isnull(
                        (SELECT MIN(hoi.owner_change_date)
                          FROM horse_owner hoi
                          WHERE hoi.horse_uid = ho.horse_uid
                          AND hoi.owner_change_date >= ri.race_datetime)
                          , CONVERT(DATETIME, '1 jan 1900')
                      )
                AND   phr.race_status_code = ri.race_status_code
                AND   h.country_origin_code != 'ARO'
                AND   phr.non_runner = 'Y'
                AND NOT EXISTS (SELECT 1 FROM race_attrib_join WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = 432)

                UNION
                SELECT DISTINCT h.style_name style_name,
                     h.country_origin_code,
                     c1.rp_abbrev_3,
                     c1.course_uid,
                     c1.course_name,
                     course_style_name = c1.style_name,
                     j.jockey_uid,
                     jockey_style_name = j.style_name,
                     o1.owner_uid,
                     owner_style_name = o1.style_name,
                     ri.race_datetime,
                     ri.race_instance_uid,
                     ten_to_follow_horse = htf.horse_uid,
                     htf.reasoning,
                     ri.race_type_code,
                     h.horse_uid,
                     ri.race_status_code
                FROM race_instance ri
                INNER JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = hr.horse_uid
                INNER JOIN course c1 ON c1.course_uid = ri.course_uid
                INNER JOIN horse_owner ho ON ho.horse_uid = hr.horse_uid
                INNER JOIN owner o1 ON o1.owner_uid = ho.owner_uid
                INNER JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                LEFT JOIN horse_to_follow htf ON htf.horse_uid = h.horse_uid 
                    AND htf.to_follow_uid = " . Constants::TEN_TO_FOLLOW_HORSE_FOLLOW_ID ."
                WHERE ri.race_datetime BETWEEN :raceDate AND :raceDateEnd
                AND   ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND   ho.owner_change_date = isnull(
                        (SELECT MIN(hoi.owner_change_date)
                          FROM horse_owner hoi
                          WHERE hoi.horse_uid = ho.horse_uid
                          AND hoi.owner_change_date >= ri.race_datetime)
                          , CONVERT(DATETIME, '1 jan 1900')
                      )  
                AND   h.country_origin_code != 'ARO'
                AND   ro.race_outcome_code IN (" . Constants::NON_RUNNER_CODES . ")
                AND NOT EXISTS (SELECT 1 FROM race_attrib_join WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = 432)
                ORDER BY style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceDate' => $raceDate . ' 00:00:00',
                'raceDateEnd' => $raceDate . ' 23:59:59',
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows();

        return $returnArray;
    }

    public function getRprRatingData($raceUid, \Models\Selectors $selectors)
    {
        $ageSql = $selectors->getHorseAgeSQL('h.horse_date_of_birth', 'h.country_origin_code', 'ri.race_datetime');

        $sql = "
            SELECT
                h.style_name,
                h.country_origin_code,
                phr.weight_carried_lbs,
                ri.race_status_code,
                ri.race_type_code,
                h.horse_uid,
                horse_age = %s,
                phr.rp_topspeed - (CASE WHEN prhs.wfa_allow IS NULL THEN 0 ELSE prhs.wfa_allow END) rp_tops_old,
                CASE WHEN pd.num_topspeed_best_rating < 1 THEN 0 WHEN pd.num_topspeed_best_rating IS NULL THEN 0 ELSE pd.num_topspeed_best_rating END rp_topspeed,
                CASE WHEN phr.rp_postmark < 1 THEN 0 WHEN phr.rp_postmark IS NULL THEN 0 ELSE phr.rp_postmark END rp_postmark,
                rp_pm_chars = rtrim(phr.rp_pm_chars),
                NULL last_12_months,
                NULL going,
                NULL distance,
                NULL course,
                ri.race_datetime,
                prhs.adjustment,
                c.course_uid,
                c.country_code,
                c.style_name course_name,
                gt.rp_going_type_desc,
                ri.distance_yard,
                NULL last_races,
                rpr_selections = (SELECT CASE WHEN count(ts.horse_uid) > 0 THEN 'Y' ELSE 'N' END
                    FROM newspapers np, tipster_selection ts
                    WHERE ts.race_instance_uid = ri.race_instance_uid
                        AND np.newspaper_uid IN (2,78)
                        AND np.newspaper_uid = ts.newspaper_uid
                        AND ts.horse_uid = phr.horse_uid
                ),
                race_group_code = CASE WHEN isnull(rg.race_group_code,'0') = '0' THEN NULL ELSE rg.race_group_code END,
                phr.extra_weight_lbs,
                ht.trainer_uid,
                ri.race_instance_uid
            FROM race_instance ri
            INNER JOIN pre_horse_race phr ON
                ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = (CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END)
            INNER JOIN horse h ON
                h.horse_uid = phr.horse_uid
            LEFT JOIN pre_rfu_horse_stats prhs ON
                prhs.race_instance_uid = phr.race_instance_uid
                AND prhs.horse_uid = phr.horse_uid
            LEFT JOIN postdata_results_new pd ON
                pd.race_instance_uid = phr.race_instance_uid
                AND pd.horse_uid = phr.horse_uid
            LEFT JOIN going_type gt ON
                gt.going_type_code = ri.going_type_code
            INNER JOIN course c ON
                c.course_uid = ri.course_uid       
            LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid
                AND  ht.trainer_change_date = '1900' 
            LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
            WHERE ri.race_instance_uid = :raceUid
            ORDER BY phr.rp_postmark DESC, phr.saddle_cloth_no
        ";

        $res = $this->getReadConnection()->query(
            sprintf($sql, $ageSql),
            [
                'raceUid' => $raceUid,
            ]
        );

        $collection = new Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }


    /**
     * @param array $horseUids
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getRprLast12Month(array $horseUids, array $raceTypeCodes)
    {
        $sql = "
            SELECT
                hr.horse_uid
                , hr.rp_postmark
                , rp_topspeed = CASE WHEN hr.rp_topspeed = -1 THEN NULL ELSE hr.rp_topspeed END
                , c.course_uid
                , c.style_name AS crs_name
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , race_outcome_code = rtrim(ro.race_outcome_code)
                , services_desc = rtrim(gt.services_desc)
                , no_runners = (SELECT count(*)
                     FROM horse_race hr3
                     WHERE hr3.race_instance_uid = ri.race_instance_uid
                     AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            FROM
                horse_race hr
                , race_outcome ro
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
                , (SELECT
                        hr.horse_uid
                        , race_datetime = max(ri.race_datetime)
                        , rp_postmark = max(hr.rp_postmark)
                    FROM
                        horse_race hr
                        , race_instance ri
                    WHERE hr.horse_uid IN (:horseIDs)
                        AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        AND ri.race_instance_uid = hr.race_instance_uid
                        AND ri.race_datetime > dateadd(YY, -1, getdate())
                        AND ri.race_type_code LIKE :raceTypeCodes
                        AND hr.rp_postmark = (
                            SELECT MAX(hr2.rp_postmark)
                            FROM horse_race hr2, race_instance ri2
                            WHERE hr2.horse_uid = hr.horse_uid
                                AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                                AND ri2.race_instance_uid = hr2.race_instance_uid
                                AND ri2.race_datetime > dateadd(YY, -1, getdate())
                                AND ri2.race_type_code LIKE :raceTypeCodes)
                    GROUP BY hr.horse_uid
                    ) m
            WHERE
                hr.horse_uid = m.horse_uid
                AND hr.rp_postmark = m.rp_postmark
                AND ri.race_datetime = m.race_datetime
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.race_type_code LIKE :raceTypeCodes
                AND c.course_uid = ri.course_uid
                AND hrc.race_instance_uid =* hr.race_instance_uid
                AND hrc.horse_uid =* hr.horse_uid
                AND gt.going_type_code =* ri.going_type_code
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIDs' => $horseUids,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param array  $horseUids
     * @param array  $raceTypeCodes
     * @param string $goingTypeDesc
     *
     * @return array
     */
    public function getRprGoing(array $horseUids, array $raceTypeCodes, $goingTypeDesc)
    {
        $sql = "
            SELECT
                hr.horse_uid
                , hr.rp_postmark
                , rp_topspeed = CASE WHEN hr.rp_topspeed = -1 THEN NULL ELSE hr.rp_topspeed END
                , c.course_uid
                , c.style_name AS crs_name
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , race_outcome_code = rtrim(ro.race_outcome_code)
                , services_desc = rtrim(gt.services_desc)
                , no_runners = (SELECT count(*)
                     FROM horse_race hr3
                     WHERE hr3.race_instance_uid = ri.race_instance_uid
                     AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            FROM
                horse_race hr
                , race_outcome ro
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
            WHERE
                hr.horse_uid IN (:horseIDs)
                AND hr.rp_postmark =
                    (SELECT max(hr2.rp_postmark)
                     FROM horse_race hr2, race_instance ri2, going_type gt2
                     WHERE
                         hr2.horse_uid = hr.horse_uid
                         AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                         AND ri2.race_instance_uid = hr2.race_instance_uid
                         AND ri2.race_type_code LIKE :raceTypeCodes
                         AND gt2.going_type_code = ri2.going_type_code
                         AND upper(gt2.rp_going_type_desc) = upper(:goingTypeDesc)
                    )
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.race_type_code LIKE :raceTypeCodes
                AND c.course_uid = ri.course_uid
                AND hrc.race_instance_uid =* hr.race_instance_uid
                AND hrc.horse_uid =* hr.horse_uid
                AND gt.going_type_code = ri.going_type_code
                AND upper(gt.rp_going_type_desc) = upper(:goingTypeDesc)
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIDs' => $horseUids,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
                'goingTypeDesc' => $goingTypeDesc,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param array $horseUids
     * @param array $raceTypeCodes
     * @param int   $distanceFrom
     * @param int   $distanceTo
     *
     * @return array
     */
    public function getRprDistance(array $horseUids, array $raceTypeCodes, $distanceFrom, $distanceTo)
    {
        $sql = "
            SELECT
                hr.horse_uid
                , hr.rp_postmark
                , rp_topspeed = CASE WHEN hr.rp_topspeed = -1 THEN NULL ELSE hr.rp_topspeed END
                , c.course_uid
                , c.style_name
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , race_outcome_code = rtrim(ro.race_outcome_code)
                , services_desc = rtrim(gt.services_desc)
                , no_runners = (SELECT count(*)
                     FROM horse_race hr3
                     WHERE hr3.race_instance_uid = ri.race_instance_uid
                     AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            FROM
                horse_race hr
                , race_outcome ro
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
            WHERE
                hr.horse_uid IN (:horseIDs)
                AND hr.rp_postmark =
                    (SELECT max(hr2.rp_postmark)
                     FROM horse_race hr2, race_instance ri2, going_type gt2
                     WHERE
                        hr2.horse_uid = hr.horse_uid
                        AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        AND ri2.race_instance_uid = hr2.race_instance_uid
                        AND ri2.race_type_code LIKE :raceTypeCodes
                        AND gt2.going_type_code = ri2.going_type_code
                        AND ri2.distance_yard BETWEEN :distanceFrom AND :distanceTo
                    )
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.race_type_code LIKE :raceTypeCodes:
                AND c.course_uid = ri.course_uid
                AND hrc.race_instance_uid =* hr.race_instance_uid
                AND hrc.horse_uid =* hr.horse_uid
                AND gt.going_type_code =* ri.going_type_code
                AND ri.distance_yard BETWEEN :distanceFrom AND :distanceTo
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIDs' => $horseUids,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
                'distanceFrom' => $distanceFrom,
                'distanceTo' => $distanceTo,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param array  $horseUids
     * @param array  $raceTypeCodes
     * @param string $course
     *
     * @return array
     */
    public function getRprCourse(array $horseUids, array $raceTypeCodes, $course)
    {
        $sql = "
            SELECT
                hr.horse_uid
                , hr.rp_postmark
                , rp_topspeed = CASE WHEN hr.rp_topspeed = -1 THEN NULL ELSE hr.rp_topspeed END
                , c.course_uid
                , c.style_name AS crs_name
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , ri.race_instance_title
                , ri.distance_yard
                , hrc.rp_close_up_comment
                , race_outcome_code = rtrim(ro.race_outcome_code)
                , services_desc = rtrim(gt.services_desc)
                , no_runners = (SELECT count(*)
                     FROM horse_race hr3
                     WHERE hr3.race_instance_uid = ri.race_instance_uid
                     AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            FROM
                horse_race hr
                , race_outcome ro
                , course c
                , race_instance ri
                , horse_race_comments hrc
                , going_type gt
            WHERE
                hr.horse_uid IN (:horseIDs)
                AND hr.rp_postmark =
                    (SELECT max(hr2.rp_postmark)
                     FROM horse_race hr2, race_instance ri2, going_type gt2, course c2
                     WHERE
                        hr2.horse_uid = hr.horse_uid
                        AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        AND ri2.race_instance_uid = hr2.race_instance_uid
                        AND ri2.race_type_code LIKE :raceTypeCodes
                        AND gt2.going_type_code = ri2.going_type_code
                        AND c2.course_uid = ri2.course_uid
                        AND c2.course_name = upper(:course)
                    )
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.race_type_code LIKE :raceTypeCodes
                AND c.course_uid = ri.course_uid
                AND hrc.race_instance_uid =* hr.race_instance_uid
                AND hrc.horse_uid =* hr.horse_uid
                AND gt.going_type_code =* ri.going_type_code
                AND c.course_name = upper(:course)
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIDs' => $horseUids,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
                'course' => $course,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param int    $horseUid
     * @param string $raceDate
     * @param array  $raceTypeCodes
     *
     * @return array
     */
    public function getRprLastRaces($horseUid, $raceDate, $raceTypeCodes)
    {
        $sql = "
            SELECT TOP 6
                ri.race_instance_uid,
                ri.race_datetime,
                ri.race_type_code,
                CASE WHEN hr.rp_postmark < 1 THEN 0 WHEN hr.rp_postmark IS NULL THEN 0 ELSE hr.rp_postmark END rp_postmark,
                c.course_uid,
                c.style_name course_name,
                ri.distance_yard,
                race_outcome_code = rtrim(ro.race_outcome_code),
                services_desc = rtrim(gt.services_desc),
                CASE WHEN hr.rp_topspeed < 1 THEN 0 WHEN hr.rp_topspeed IS NULL THEN 0 ELSE  hr.rp_topspeed END rp_tops,
                hrc.rp_close_up_comment,
                race_group_code = case when isnull(rg.race_group_code,'0') = '0' then null else rg.race_group_code end,
                calc_no_runners = (SELECT COUNT(*) FROM horse_race hr3
                               WHERE hr3.race_instance_uid = ri.race_instance_uid
                                   AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            FROM horse_race hr
                INNER JOIN race_instance ri ON
                    hr.race_instance_uid = ri.race_instance_uid
                    AND ri.race_datetime < {$this->getReadConnection()->escapeString($raceDate)}
                    AND ri.race_type_code like :raceTypeCodes:
                INNER JOIN course c ON
                    c.course_uid = ri.course_uid
                LEFT JOIN going_type gt ON
                    gt.going_type_code = ri.going_type_code
                INNER JOIN race_outcome ro ON
                    ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code not in (" . Constants::NON_RUNNER_CODES . ")
                LEFT JOIN horse_race_comments hrc ON
                    hrc.race_instance_uid = hr.race_instance_uid
                    AND hrc.horse_uid = hr.horse_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
            WHERE
                hr.horse_uid = :horseUid:
            ORDER BY ri.race_datetime DESC
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseUid' => $horseUid,
                'raceTypeCodes' => '[' . implode('', $raceTypeCodes) . ']',
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param $raceId
     *
     * @return array
     */
    public function getQuotes($raceId)
    {
        $sql = "
            SELECT
                phr.horse_uid,
                h.horse_name,
                h.country_origin_code,
                ri.race_instance_uid,
                ri.race_datetime,
                c.course_name course_name,
                c.style_name course_style_name,
                ri.distance_yard,
                ri.race_instance_title,
                hrn.notes notes,
                phrq.quotes,
                phrq.key_quote_yn,
                phrq.expire_on
            FROM race_instance ri
                INNER JOIN pre_horse_race phr
                    ON ri.race_instance_uid = phr.race_instance_uid
                      AND phr.race_status_code = (CASE
                          WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                          THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                          ELSE ri.race_status_code
                      END)
                INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                INNER JOIN course c ON c.course_uid = ri.course_uid
                LEFT JOIN horse_race_notes hrn
                    ON hrn.race_instance_uid = phr.race_instance_uid
                      AND hrn.horse_uid = phr.horse_uid
                      AND hrn.notes_type_code = " . Constants::NOTES_TYPE_CODE_QUOTES . "
                LEFT JOIN pre_horse_race_quotes phrq
                    ON ri.race_instance_uid = phrq.race_instance_uid
                      AND phr.horse_uid = phrq.horse_uid
            WHERE ri.race_instance_uid = :raceId:
            ORDER BY ri.race_datetime DESC
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $result = new Resultset\General(
            null,
            new Row\General(),
            $result
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getStatsData($raceId)
    {
        $sql = "
            SELECT
                pre_horse_race.horse_uid
                , horse_name = h.style_name
                , h.country_origin_code
                , horse_trainer.trainer_uid
                , trainer_name = (SELECT style_name FROM trainer WHERE trainer_uid = horse_trainer.trainer_uid)
                , jockey.jockey_uid
                , jockey_name = jockey.style_name
            FROM race_instance
                JOIN pre_horse_race ON
                    pre_horse_race.race_instance_uid = race_instance.race_instance_uid
                    AND pre_horse_race.race_status_code =
                    (
                    CASE
                        WHEN race_instance.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE race_instance.race_status_code
                    END
                    )
                LEFT JOIN horse_trainer ON
                    horse_trainer.horse_uid = pre_horse_race.horse_uid
                    AND horse_trainer.trainer_change_date = ISNULL(
                            (
                            SELECT MIN(t2.trainer_change_date)
                            FROM horse_trainer t2
                            WHERE
                                t2.horse_uid = pre_horse_race.horse_uid
                                AND t2.trainer_change_date > race_instance.race_datetime
                            ),
                        '1 jan 1900'
                    )
                LEFT JOIN jockey ON pre_horse_race.jockey_uid = jockey.jockey_uid
                LEFT JOIN horse h ON h.horse_uid = pre_horse_race.horse_uid
            WHERE
                race_instance.race_instance_uid = :raceId:
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $ids = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return [
            'trainers' => $ids->toArrayWithRows('trainer_uid'),
            'jockeys' => $ids->toArrayWithRows('jockey_uid'),
            'horses' => $ids->toArrayWithRows('horse_uid'),
        ];
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return array
     */
    public function getUpcomingRaces($request)
    {
        $builder = new Builder();

        $hideUncompleted = true;

        if ($request->isParameterProvided('limit')) {
            $builder->expression('limit', 'TOP ' . $request->getLimit());
        } else {
            $builder->expression('limit', '');
            if ($request->getLimit() === INF) {
                $builder->expression('date', '>= :startDate');
                $builder->where("
                    pri.race_datetime >= :startDate
                    AND (SELECT COUNT(*) FROM pre_horse_race phr 
                        WHERE phr.race_instance_uid = pri.race_instance_uid 
                        AND phr.race_status_code = pri.race_status_code) > 0");
                $hideUncompleted = false;
            }
        }

        if ($hideUncompleted) {
            $builder->expression('date', 'BETWEEN :startDate AND :endDate');
            $builder->where("
                pri.race_datetime BETWEEN :startDate AND :endDate
                AND c.country_code IN ('GB', 'IRE')
                AND NOT EXISTS (
                    SELECT 1
                    FROM race_attrib_join
                    WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = :raceAttribUid
                )");
        }

        $builder->setSqlTemplate("
            SELECT /*{EXPRESSION(limit)}*/
                t.course_uid,
                t.course_name,
                t.race_instance_uid,
                t.race_datetime
            FROM
                (
                    SELECT DISTINCT
                        CASE WHEN c2.course_uid IS NOT NULL THEN c2.course_uid ELSE c.course_uid END course_uid,
                        CASE WHEN c2.course_name IS NOT NULL THEN c2.course_name ELSE c.course_name END course_name,
                        ri.race_instance_uid,
                        ri.race_datetime
                    FROM
                        race_instance ri
                        JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                        JOIN course c ON ri.course_uid = c.course_uid
                        LEFT JOIN course c2 ON
                            c2.rp_abbrev_3 = c.rp_abbrev_3
                            AND c2.country_code = c.country_code
                            AND c2.course_name NOT LIKE '%(A.W)%'
                            AND c2.course_uid IN (
                                SELECT course_uid
                                FROM race_instance
                                WHERE race_datetime /*{EXPRESSION(date)}*/
                            )
                    WHERE
                        ri.race_type_code != :raceTypeP2P 
                        AND CASE 
                            WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                THEN '0'
                                ELSE pri.race_status_code 
                            END = (
                                SELECT 
                                    MIN(
                                        CASE
                                            WHEN pri2.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                            THEN '0'
                                            ELSE pri2.race_status_code
                                        END
                                    )
                                FROM pre_race_instance pri2
                                WHERE pri2.race_instance_uid = pri.race_instance_uid
                                GROUP BY pri2.race_instance_uid
                            )
                        /*{WHERE}*/    
                ) AS t
            ORDER BY
                t.race_datetime ASC
        ");

        $startDate = date("Y-m-d H:i:s");
        $endDate = date("Y-m-d") . ' 23:59:59';

        $builder
            ->setParam('startDate', $startDate)
            ->setParam('endDate', $endDate)
            ->setParam('raceAttribUid', Constants::INCOMPLETE_CARD_ATTRIBUTE_ID)
            ->setParam('raceTypeP2P', Constants::RACE_TYPE_P2P);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @return array
     */
    public function getBigRaces()
    {
        $sql = "
            SELECT
                t.course_uid,
                t.course_name,
                t.course_style_name,
                t.rp_abbrev_3,
                t.country_code,
                t.race_instance_uid,
                t.race_datetime,
                t.race_instance_title,
                t.distance_yard,
                t.race_type_code,
                t.race_status_code,
                t.going_type_code,
                rp_going_type_desc = (
                    SELECT rp_going_type_desc
                    FROM going_type
                    WHERE going_type_code = t.going_type_code
                    ),
                race_class = (
                    SELECT DISTINCT ral.race_attrib_desc
                    FROM race_attrib_join raj, race_attrib_lookup ral
                    WHERE t.race_instance_uid = raj.race_instance_uid
                        AND raj.race_attrib_uid = ral.race_attrib_uid
                        AND ral.race_attrib_code = (CASE
                            WHEN t.country_code = 'GB'
                            THEN " . Constants::RACE_CLASS_SUB . "
                            ELSE " . Constants::RACE_CLASS . "
                        END)
                    ),
                t.rp_ages_allowed_desc
            FROM
                (
                SELECT DISTINCT
                    c.course_uid,
                    c.course_name,
                    course_style_name = c.style_name,
                    c.rp_abbrev_3,
                    c.country_code,
                    ri.race_instance_uid,
                    ri.race_datetime,
                    ri.race_instance_title,
                    ri.distance_yard,
                    ri.race_type_code,
                    ri.race_status_code,
                    ri.going_type_code,
                    aa.rp_ages_allowed_desc
                FROM
                    race_instance ri
                    JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                    INNER JOIN course c ON
                        ri.course_uid = c.course_uid
                    LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
                WHERE
                    ri.race_datetime > getdate()
                    AND pri.early_closing_race_yn = 'Y'
                    AND CASE 
                            WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            THEN '0'
                            ELSE pri.race_status_code
                        END =
                        (
                            SELECT
                                MIN(
                                    CASE
                                        WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                        THEN '0'
                                        ELSE ipri.race_status_code
                                        END
                                    )
                            FROM pre_race_instance ipri
                            WHERE ipri.race_instance_uid = ri.race_instance_uid
                            GROUP BY ipri.race_instance_uid
                        )
                    AND pri.no_of_runners > 0
                    AND EXISTS(
                        SELECT
                            1
                        FROM
                            pre_horse_race phr
                        WHERE
                            phr.race_instance_uid = ri.race_instance_uid
                            AND (phr.race_status_code = " . Constants::RACE_STATUS_CALENDAR . "
                                OR (phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                    AND c.country_code NOT IN ('GB', 'IRE'))
                                )
                    )
                    AND NOT EXISTS (
                        SELECT 1
                        FROM race_attrib_join WHERE race_instance_uid = ri.race_instance_uid
                        AND race_attrib_uid = 432)
                ) AS t
            ORDER BY
                t.race_datetime ASC
        ";

        $res = $this->getReadConnection()->query($sql);

        $collection = new Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $res
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param bool $isExcludePTP
     *
     * @return Row\General
     */
    public function getNextRace($isExcludePTP)
    {
        $result = $this->getReadConnection()->query(
            "
            SELECT  TOP 1
                ri.race_instance_uid,
                ri.race_datetime,
                c.course_name,
                c.style_name course_style_name,
                country_code = rtrim(c.country_code),
                c.course_uid
            FROM  race_instance ri
                INNER JOIN course c ON (c.course_uid = ri.course_uid)
                INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
            WHERE
                1 = (CASE 
                        WHEN c.course_type_code = '" . Constants::COURSE_TYPE_P2P_CODE . "'
                            AND c.country_code = 'GB' 
                        THEN 0 ELSE 1 
                    END)
                AND ri.race_datetime > getdate()
                AND ri.race_status_code != " . Constants::RACE_STATUS_ABANDONED . "
                AND pri.race_status_code != " . Constants::RACE_STATUS_RESULTS . "
                AND CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                        THEN '0'
                        ELSE pri.race_status_code
                    END = (
                    SELECT MIN(CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                               THEN '0' ELSE ipri.race_status_code
                           END)
                    FROM pre_race_instance ipri
                    WHERE ipri.race_instance_uid = ri.race_instance_uid 
                        AND ipri.race_status_code != " . Constants::RACE_STATUS_RESULTS . "
                    GROUP BY ipri.race_instance_uid
                    )
                AND c.country_code IN ('GB', 'IRE')
                AND NOT EXISTS (
                    SELECT *
                    FROM race_attrib_join raj
                    WHERE
                        raj.race_instance_uid = ri.race_instance_uid
                        AND raj.race_attrib_uid = 432)
                " . ($isExcludePTP ? " AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . " " : "") . "
            ORDER BY
                ri.race_datetime
        "
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $result
        );

        $resultArray = $collection->toArrayWithRows();

        return isset($resultArray[0]) ? $resultArray[0] : null;
    }

    /**
     * @param $race
     *
     * @return array
     */
    public function getHorsesAttributes($race)
    {
        $raceId = $race->race_instance_uid;
        $raceStatus = $race->race_status_code;
        $raceDate = $race->race_datetime;
        $raceType = $race->race_type_code;

        $sql = "
            SELECT
                phr.horse_uid
                , phr.race_instance_uid
                , phr.weight_carried_lbs
                , age = datediff(YEAR, h.horse_date_of_birth, :race_date)
            INTO #race_horses
            FROM
                pre_horse_race phr
                , horse h
            WHERE
                phr.race_instance_uid = :race_id
                AND phr.horse_uid = h.horse_uid
                AND phr.race_status_code = :race_status
        ";

        $this->getReadConnection()->query(
            $sql,
            [
                'race_date' => $raceDate,
                'race_id' => $raceId,
                'race_status' => $raceStatus,
            ],
            [
                'race_date' => Column::BIND_PARAM_STR,
                'race_id' => Column::BIND_PARAM_INT,
                'race_status' => Column::BIND_PARAM_STR,
            ],
            false
        );

        $sql = "
            SELECT age
            FROM #race_horses
            WHERE
                horse_uid = (
                    SELECT max(horse_uid) FROM #race_horses
                    WHERE weight_carried_lbs = (SELECT max(weight_carried_lbs) FROM #race_horses)
                )
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            null,
            null,
            false
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $topAge = $collection->toArrayWithRows();
        $topAge = (!empty($topAge)) ? $topAge[0]['age'] : 0;

        if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false) {
            if ($topAge > 5) {
                $topAge = 5;
            }
        } else {
            if (strpos(Constants::RACE_TYPE_HURDLE, $raceType) !== false) {
                if ($topAge > 5) {
                    $topAge = 5;
                }
            } else {
                if ($topAge > 6) {
                    $topAge = 6;
                }
            }
        }

        $race->top_age = $topAge;

        $curMonth = intval(date('n', strtotime($race->race_datetime)));
        $curDay = intval(date('j', strtotime($race->race_datetime)));
        if ($curMonth == 2) {
            $curMonthHalf = $curDay < 15 ? 1 : 2;
        } else {
            $curMonthHalf = $curDay < 16 ? 1 : 2;
        }

        $sql = "
            SELECT
                t.horse_uid
                , t.weight_carried_lbs
                , t.race_instance_uid
                
                , t.age
                , rp_postmark = 0
                , rp_topspeed = 0
                , wfage =
                    CASE
                    WHEN :race_type IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                        CASE
                            WHEN t.wfage > 3 AND :top_age = 3 THEN 3
                            WHEN t.wfage > 4 THEN 4
                            ELSE t.wfage
                        END
                    WHEN :race_type IN (" . Constants::RACE_TYPE_HURDLE . ") THEN
                        CASE
                            WHEN t.wfage <= 3 OR (t.wfage > 3 AND :top_age = 3) THEN 3
                            WHEN t.wfage > 3 AND (:top_age != 3 OR :top_age = 0) THEN 4
                            ELSE t.wfage
                        END
                    WHEN :race_type LIKE '[CUZ]' THEN
                        CASE
                            WHEN t.wfage < 5 OR (t.wfage > 4 AND :top_age = 4) THEN 4
                            WHEN t.wfage > 4 AND (:top_age != 4 OR :top_age = 0) THEN 5
                            ELSE t.wfage
                        END
                    END
                , adjusted_age =
                    CASE
                    WHEN :race_type IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                        CASE WHEN t.adjusted_age > 5 THEN 5 ELSE t.adjusted_age END
                    ELSE
                        CASE
                            WHEN :race_type NOT IN (" . Constants::RACE_TYPE_HURDLE . ") AND t.adjusted_age > 6 THEN 6
                            WHEN :race_type NOT IN (" . Constants::RACE_TYPE_HURDLE . ") AND t.adjusted_age > 5 THEN 5
                            ELSE t.adjusted_age
                        END
                    END
                , force_deduct_wfa =
                    CASE
                        WHEN :race_type NOT IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                            CASE WHEN :max_age != :min_age AND :top_age != :min_age
                                AND convert(VARCHAR, :race_group_code) != " . Constants::RACE_GROUP_CODE_HANDICAP . "
                            THEN 1 ELSE 0
                            END
                        ELSE 0
                    END
                , wfa_control_flag =
                    CASE
                        WHEN :race_type IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                            CASE
                                WHEN :max_age != :min_age AND :min_age >= 5 THEN 1
                                WHEN :max_age != :min_age THEN 2
                                ELSE 0
                            END
                        WHEN :race_type NOT IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                            CASE
                                WHEN :max_age != :min_age AND :top_age < :min_age THEN 2
                                ELSE 0
                            END
                    END
                , wfa_flat = isnull((SELECT convert(INT, fwfa.weight_allowance_lbs)
                        FROM
                            flat_weight_for_age fwfa
                        WHERE
                            fwfa.distance_furlongs = :furlong
                            AND fwfa.age = t.wfage
                            AND fwfa.month = :month
                            AND convert(INT, fwfa.month_half_1_or_2) = :month_half
                            AND fwfa.weight_allowance_lbs != 0), 0)
                , wfa_topspeed_flat = isnull((SELECT convert(INT, tfwfa.weight_allowance_lbs)
                        FROM
                            topspeed_flat_weight_for_age tfwfa
                        WHERE
                            tfwfa.distance_furlongs = :furlong
                            AND tfwfa.age = t.wfage
                            AND tfwfa.month = :month
                            AND convert(INT, tfwfa.month_half_1_or_2) = :month_half
                            AND tfwfa.weight_allowance_lbs != 0), 0)
                , wfa_jump = isnull((SELECT convert(INT, jwfa.weight_allowance_lbs)
                        FROM
                            jump_weight_for_age jwfa
                        WHERE
                            jwfa.distance_furlongs = :furlong
                            AND jwfa.age = t.wfage
                            AND jwfa.month = :month
                            AND jwfa.race_type_code = :race_type_code
                            AND jwfa.weight_allowance_lbs != 0), 0)
            FROM
                (SELECT
                    t2.horse_uid
                    , t2.race_instance_uid
                    , t2.weight_carried_lbs
                    , t2.age
                    , t2.wfage
                    , t2.adjusted_age
                FROM
                    (SELECT
                        rh.horse_uid
                        , rh.race_instance_uid
                        , rh.weight_carried_lbs
                        , rh.age
                        , wfage = CASE WHEN rh.age BETWEEN 2 AND 20 THEN rh.age ELSE 0 END
                        , adjusted_age = CASE WHEN rh.age BETWEEN 2 AND 20 THEN rh.age ELSE 0 END
                    FROM
                        #race_horses rh
                    ) t2
                 ) t
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'furlong' => $race->furlong,
                'top_age' => $topAge,
                'month' => $curMonth,
                'month_half' => $curMonthHalf,
                'race_type' => $raceType,
                'max_age' => $race->max_age,
                'min_age' => $race->min_age,
                'race_group_code' => $race->race_group_code,
                'race_type_code' => $race->race_type_code,
            ],
            null,
            false
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $out = $collection->toArrayWithRows('horse_uid');
        $this->dropTempTable('#race_horses');

        return $out;
    }

    /**
     * @param $race
     * @param $horses
     *
     * @return array
     */
    public function getHorsesTopspeed($horses)
    {
        $sql = "
            SELECT
                hr.horse_uid,
                ri.race_type_code,
                rp_topspeed = CASE WHEN max(hr.rp_topspeed) = -1 THEN 0 ELSE max(hr.rp_topspeed) END
            FROM
                horse_race hr
                , race_instance ri
            WHERE
                ri.race_datetime > dateadd(DD, -425, getdate())
                AND hr.race_instance_uid = ri.race_instance_uid
                AND hr.horse_uid IN (:horse_ids)
            GROUP BY hr.horse_uid,ri.race_type_code
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horse_ids' => $horses
            ],
            null,
            false
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->getGroupedResult([
            'horse_uid',
            'race_types' => [
                'race_type_code',
                'topspeed' => [
                    'rp_topspeed'
                ]
            ]
        ], ['horse_uid', 'race_type_code']);
    }

    /**
     * @param array $raceIds
     *
     * @return mixed
     */
    public function getRaceAdditionalData($raceIds)
    {
        $sql = "
            SELECT
                t.race_instance_uid
                , t.distance_yard
                , t.race_datetime
                , t.race_type_code
                , t.race_group_code
                , t.country_code
                , t.min_weight
                , t.race_status_code
                , t.weight_adjustment
                , t.min_age
                , t.max_age
                , t.top_age
                , furlong =
                    CASE
                    WHEN t.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                        CASE
                            WHEN t.furlong < 6 THEN 5
                            WHEN t.furlong = 17 THEN 16
                            WHEN t.furlong = 19 THEN 18
                            WHEN t.furlong > 19 THEN 20
                            ELSE t.furlong
                        END
                   ELSE
                        CASE
                            WHEN t.furlong > 23 THEN 24
                            WHEN t.furlong > 19 THEN 20
                            WHEN t.furlong > 15 THEN 16
                            ELSE t.furlong
                        END
                   END
            FROM (
                SELECT
                    ri.race_instance_uid
                    , ri.distance_yard
                    , c.country_code
                    , furlong = round(ri.distance_yard * 1.0 / 220, 0)
                    , race_datetime = ri.race_datetime
                    , race_type_code = ri.race_type_code
                    , race_group_code = rg.race_group_code
                    , min_weight = ri.minimum_weight_lbs
                    , race_status_code = ri.race_status_code
                    , weight_adjustment =
                        CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN 140 ELSE 168 END
                    , t2.min_age
                    , t2.max_age
                    , top_age = (SELECT max(datepart(YEAR, getdate()) - datepart(YEAR, horse_date_of_birth))
                                FROM pre_horse_race
                                JOIN horse ON horse.horse_uid = pre_horse_race.horse_uid
                                WHERE
                                    pre_horse_race.horse_uid = (
                                        SELECT max(horse_uid) FROM pre_horse_race
                                        WHERE weight_carried_lbs = (SELECT max(weight_carried_lbs) 
                                                                        FROM pre_horse_race 
                                                                        WHERE race_instance_uid = pri.race_instance_uid)
                                              AND race_instance_uid = pri.race_instance_uid
                                    )
                                    AND race_instance_uid = pri.race_instance_uid
                                    )
                FROM
                   pre_race_instance pri
                   JOIN race_instance ri ON pri.race_instance_uid = ri.race_instance_uid
                        AND pri.race_status_code = CASE WHEN  ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                                THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                                ELSE ri.race_status_code
                                              END
                   JOIN course c ON ri.course_uid = c.course_uid
                   JOIN (SELECT
                         pri2.race_instance_uid
                         , max_age = max(datepart(YEAR, getdate()) - datepart(YEAR, h2.horse_date_of_birth))
                         , min_age = min(datepart(YEAR, getdate()) - datepart(YEAR, h2.horse_date_of_birth))
                      FROM
                         pre_race_instance pri2
                         , pre_horse_race phr2
                         , horse h2
                      WHERE
                         pri2.race_instance_uid IN (:raceIds)
                         AND pri2.race_instance_uid = phr2.race_instance_uid
                         AND h2.horse_uid = phr2.horse_uid
                         AND phr2.race_status_code = pri2.race_status_code
                                                        
                      GROUP BY pri2.race_instance_uid
                   ) t2 ON pri.race_instance_uid = t2.race_instance_uid
                   LEFT JOIN race_group rg ON ri.race_group_uid = rg.race_group_uid
                WHERE
                   pri.race_instance_uid IN (:raceIds)
            ) t
            ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceIds' => $raceIds,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows('race_instance_uid');

        return $returnArray;
    }

    /**
     * @param int $raceId
     *
     * @return boolean
     */
    public function checkRaceAbandoned($raceId)
    {
        $sql = "
            SELECT
                ri.race_status_code
            FROM
                race_instance ri
            WHERE
                ri.race_instance_uid = :raceId
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceId' => $raceId,
            ]
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows();

        return !empty($returnArray)
            && strpos(Constants::RACE_STATUS_ABANDONED, $returnArray[0]->race_status_code) !== false;
    }

    public function getRaceRunners($raceId): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT
                    phr.horse_uid,
                    phr.saddle_cloth_no as horse_number
               FROM race_instance ri
                  INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
               WHERE phr.race_status_code =
                        (CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
                    AND ri.race_instance_uid = :raceId"
        );

        $builder->setParam("raceId", $raceId);
        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $res = new \Phalcon\Mvc\Model\Resultset\General(null, $builder->getRow(), $res);

        return $res->toArrayWithRows('horse_uid');
    }

    public function getBettingForecast($raceId, Selectors $selectors)
    {
        $exclusion = parent::getSpecialFlagExclusionCondition();

        $sql = "
               SELECT
                    h.horse_uid,
                    h.style_name horse_name,
                    h.country_origin_code,
                    phr.saddle_cloth_no start_number,
                    odf.odds_value forecast_odds_value,
                    odf.odds_desc forecast_odds_desc

               FROM race_instance ri
                  INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                  INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                  LEFT JOIN odds odf ON (phr.forecast_sp_uid = odf.odds_uid AND odf.odds_desc != 'No Odds')
                  WHERE phr.race_status_code =
                            (CASE
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                ELSE ri.race_status_code
                            END)
                        AND ri.race_instance_uid = :raceId:
                        AND ($exclusion)

               ORDER BY ri.race_datetime, phr.saddle_cloth_no, h.style_name";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $collection = new Resultset\General(
            null,
            new \Api\Row\Results\Horse(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    public function getNapsTable()
    {
        $res = $this->getReadConnection()->query(
            "SELECT
                horse_style_name = h.style_name
                , h.country_origin_code
                , horse_uid = h.horse_uid
                , npc.nap_time
                , npc.course
                , npc.newspaper
                , npc.tipster
                , npc.level_stake
                , naps_count = (SELECT count(1) FROM ss_nap_comp_today npc2 WHERE h.horse_uid = npc2.nap_horse_uid)
                , ri.race_instance_uid
                , c.course_uid
                , course_name = c.style_name
                , ho.owner_uid
                , phr.rp_owner_choice
                , naps_table_outcome = str_replace(
                    str_replace(
                        (CASE WHEN ro.race_outcome_position = 0
                            THEN ro.race_outcome_code
                            ELSE ro.race_outcome_desc
                        END), 'Dead-heat', 'DH'),
                    'Deadheat', 'DH')
                , o.odds_desc
            FROM
               ss_nap_comp_today npc
           LEFT JOIN
               horse h ON h.horse_uid = npc.nap_horse_uid
           LEFT JOIN
               pre_horse_race phr ON phr.horse_uid = h.horse_uid and phr.race_status_code LIKE '[OR]'
           LEFT JOIN
               race_instance ri ON ri.race_instance_uid = phr.race_instance_uid and ri.race_datetime = npc.nap_time
           LEFT JOIN
               course c ON c.course_uid = ri.course_uid and c.rp_abbrev_4 = npc.course
           LEFT JOIN
               horse_owner ho ON ho.horse_uid = h.horse_uid and isnull(ho.owner_change_date, '" . Constants::EMPTY_DATE_AND_TIME . "') = '" . Constants::EMPTY_DATE_AND_TIME . "'
           LEFT JOIN
               horse_race hr ON hr.horse_uid = phr.horse_uid AND hr.race_instance_uid = phr.race_instance_uid
           LEFT JOIN
               race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
           LEFT JOIN
               odds o ON o.odds_uid = hr.starting_price_odds_uid
               
           WHERE ri.race_instance_uid = phr.race_instance_uid
           ORDER BY
                npc.level_stake DESC
                , npc.wins DESC"
        );

        $collection = new Resultset\General(
            null,
            new RaceCards\NapsTable(),
            $res
        );

        return $collection->toArrayWithRows();
    }

    /**
     * @param string $tableName
     */
    private function dropTempTable($tableName)
    {
        $sql = "
            IF OBJECT_ID('{$tableName}') IS NOT NULL
            DROP TABLE {$tableName}
        ";
        $this->getReadConnection()->execute($sql, null, null, false);
    }

    /**
     * @return General[]
     */
    public function getTopNaps()
    {
        $res = $this->getReadConnection()->query(
            "SELECT
                h.horse_uid
                , horse_style_name = h.style_name
                , h.horse_name
                , h.country_origin_code
                , ri.race_datetime
                , ri.race_instance_uid
                , ri.race_instance_title
                , c.course_uid
                , course_style_name = c.style_name
                , o.owner_uid
                , o.owner_name
                , owner_style_name = o.style_name
                , owner_choice = phr.rp_owner_choice
                , t.trainer_uid
                , trainer_style_name = t.style_name
                , t.trainer_name
                , j.jockey_uid
                , jockey_style_name = j.style_name
                , j.jockey_name
                , nt.naps_count
            FROM (
                SELECT
                    snc.nap_horse_uid
                    , naps_count = COUNT(*)
                FROM
                    ss_nap_comp_today snc
                GROUP BY
                    snc.nap_horse_uid
                HAVING
                    COUNT(*) = MAX(COUNT(*))
            ) nt
            JOIN
                horse h ON h.horse_uid = nt.nap_horse_uid
            JOIN
                pre_horse_race phr ON phr.horse_uid = h.horse_uid
            JOIN
                race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
            JOIN
                course c ON c.course_uid = ri.course_uid
            JOIN
                horse_owner ho ON ho.horse_uid = h.horse_uid
            JOIN
                owner o ON o.owner_uid = ho.owner_uid
            JOIN
                horse_trainer ht ON ht.horse_uid = h.horse_uid
            JOIN
                trainer t ON t.trainer_uid = ht.trainer_uid
            JOIN
                jockey j ON j.jockey_uid = phr.jockey_uid
            WHERE
                phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND ri.race_datetime BETWEEN getDate() AND '" . date('Y-m-d') . " 23:59:59'
                AND isnull(ho.owner_change_date, '" . Constants::EMPTY_DATE_AND_TIME . "') = '" . Constants::EMPTY_DATE_AND_TIME . "'
                AND isnull(ht.trainer_change_date, '" . Constants::EMPTY_DATE_AND_TIME . "') = '" . Constants::EMPTY_DATE_AND_TIME . "'"
        );

        $collection = new Resultset\General(
            null,
            new Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * Method to retrieve the publish time of a given race
     * @param $raceId
     * @return string
     */
    public function getPublishTime($raceId)
    {
        $sql =
            " SELECT
                    race_content_publish_time
               FROM
                    race_content_publish_time
               WHERE
                    race_content_publish_race_uid = :raceId
               AND
                    race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
            ";

        $params = [
            'raceId' => $raceId,
        ];

        $result = $this->getReadConnection()->query($sql, $params);
        $result = new Resultset\General(
            null,
            new Row\General(),
            $result
        );
        return $result->getFirst();
    }
}
