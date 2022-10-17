<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Predictor;

use Api\Constants\Horses as Constants;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Api\Row\RaceInstance as RiRow;
use \Phalcon\Mvc\DataProvider;

/**
 * Class RaceInstance
 *
 * @package Api\DataProvider\Bo\Predictor
 */
class RaceInstance extends DataProvider
{
    /**
     * @param int $raceId
     *
     * @return bool
     */
    public function isRaceExists(int $raceId): bool
    {
        $sql = "
            SELECT 1
            FROM
                race_instance ri
            WHERE
                ri.race_instance_uid = :raceId
        ";

        $res = $this->query(
            $sql,
            [
                'raceId' => $raceId
            ]
        );

        return ($res->count() > 0);
    }

    /**
     * @param int $raceId
     *
     * @return RiRow|null
     * @throws ResultsetException
     */
    public function getRace(int $raceId): ? RiRow
    {
        $sql = "
            SELECT
                ri.race_instance_uid
              , ri.race_type_code
              , ri.race_datetime
              , ri.race_status_code
              , course = ISNULL(c2.course_name, c.course_name)
              , course_uid = ISNULL(c2.course_uid, c.course_uid)
              , c.country_code
              , pri.distance_yard
              , going = gt.going_type_desc        
              , ages_allowed = aa.rp_ages_allowed_desc
              , c.latitude
              , c.longitude
            FROM race_instance ri
                INNER JOIN pre_race_instance pri ON ri.race_instance_uid = pri.race_instance_uid
                INNER JOIN course c ON c.course_uid = ri.course_uid
                LEFT JOIN course c2 ON c.rp_abbrev_3 = c2.rp_abbrev_3
                    AND c.country_code = c2.country_code
                    AND c2.course_name NOT LIKE '%(A.W)%'
                    AND c2.course_uid = ri.course_uid
                LEFT JOIN going_type gt ON gt.going_type_code = ri.going_type_code
                LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
            WHERE ri.race_instance_uid = :raceId
                AND pri.race_status_code =
                    (CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                    ELSE ri.race_status_code
                    END)
        ";
        $res = $this->query(
            $sql,
            [
                'raceId' => $raceId
            ],
            new RiRow
        );

        return ($res->count() > 0) ? $res->getFirst() : null;
    }

    /**
     * Retrieves correct next race_instance_uid for predictor
     * So predictor's data is available for all race_instance_uid which this method returns
     * As example, this method selects only races from GB and IRE
     *
     * @return int|null
     * @throws ResultsetException
     */
    public function getNextRaceId(): ? int
    {

        $sql = "
            SELECT TOP 1
              ri.race_instance_uid
            FROM race_instance AS ri
                INNER JOIN course AS c
                    ON (c.course_uid = ri.course_uid)
                LEFT JOIN fast_race_instance AS fri
                    ON (ri.race_datetime = fri.race_datetime
                        AND (UPPER(c.course_name) LIKE UPPER(fri.course_name) + '%'
                            OR UPPER(fri.course_name) LIKE UPPER(c.course_name) + '%'))
            WHERE ri.race_datetime BETWEEN getdate() AND dateadd(DD, 14, getdate())
                AND ri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND c.country_code IN ('GB', 'IRE')
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND fri.fast_race_instance_uid IS NULL
            ORDER BY ri.race_datetime";

        $res = $this->query($sql);

        return $res->count() > 0 ? $res->getFirst()->race_instance_uid : null;
    }

    /**
     * @param int    $raceId
     *
     * @return array
     */
    public function getHorses(int $raceId): array
    {
        $sql = "
            SELECT
                ri.race_instance_uid
              , h.style_name
              , h.country_origin_code
              , h.horse_uid             horse_id
              , phr.saddle_cloth_no     start_number
              , phr.rp_owner_choice     owner_choice
              , phr.non_runner          non_runner
              , ho.owner_uid            owner_uid
              , o.style_name            owner_name
            FROM race_instance ri
            INNER JOIN pre_horse_race phr   ON phr.race_instance_uid = ri.race_instance_uid
            INNER JOIN horse h  ON h.horse_uid = phr.horse_uid
            INNER JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid
            INNER JOIN owner o ON o.owner_uid = ho.owner_uid
            INNER JOIN horse hsire ON hsire.horse_uid = h.sire_uid
            INNER JOIN horse hdam ON hdam.horse_uid = h.dam_uid

            WHERE phr.race_status_code = (
                CASE
                  WHEN ri.race_status_code =  " . Constants::RACE_STATUS_RESULTS
            . " THEN  " . Constants::RACE_STATUS_OVERNIGHT . " 
                    ELSE ri.race_status_code 
                END
                )
            AND ri.race_instance_uid = :raceId
            AND ho.owner_change_date = isnull((
                SELECT MIN(hoi.owner_change_date)
                FROM horse_owner hoi
                WHERE hoi.horse_uid = ho.horse_uid
                AND hoi.owner_change_date >= ri.race_datetime
                ), convert(DATETIME, '1 jan 1900')
            )";

        $horses = $this->query(
            $sql,
            [
                'raceId' => $raceId
            ],
            new RiRow
        );

        return $horses->toArrayWithRows('horse_id');
    }

    /**
     * @param int $raceId
     *
     * @return array
     */
    public function getPostdata($raceId)
    {
        $query = "
            SELECT
                  h.style_name                horse_style_name
                , pd.trainer_record_output
                , pd.trainer_form_output
                , pd.going_output
                , pd.distance_output
                , pd.course_output
                , pd.ability_output
                , pd.recent_form_output
                , pd.group_race
                , phr.saddle_cloth_no
                , h.horse_uid
                , rp_tops = pd.num_topspeed_best_rating
                , phr.rp_pm_chars
                , phr.official_rating
                , pd.draw_output
                , pd.race_instance_uid
                , pd.jockey_no_wins_flag
                , pd.first_time_blinkers
                , pd.jockey_wins
                , pd.jockey_stable_wins
                , is_first_time = hhg.first_time_yn
                , ri.race_datetime
                , c.course_name
                , phrs.trainer_id
                , top_speed = pd.num_topspeed_best_rating
                , RPR = phr.rp_postmark
                , form_points = pd.recent_form_points   
            FROM postdata_results_new pd
            INNER JOIN horse h ON pd.horse_uid = h.horse_uid
            INNER JOIN race_instance ri ON pd.race_instance_uid = ri.race_instance_uid
            INNER JOIN pre_horse_race phr ON phr.race_instance_uid = pd.race_instance_uid
            INNER JOIN course c ON c.course_uid = ri.course_uid
            LEFT JOIN horse_head_gear hhg ON hhg.horse_head_gear_uid = phr.horse_head_gear_uid
            LEFT JOIN pre_horse_race_stats phrs ON (phrs.race_instance_uid = phr.race_instance_uid AND phrs.horse_uid = phr.horse_uid)
            WHERE pd.race_instance_uid = :race_instance_uid
            AND phr.horse_uid = h.horse_uid
            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
        ";

        $res = $this->query(
            $query,
            [
                'race_instance_uid' => $raceId
            ],
            new RiRow()
        );

        return $res->toArrayWithRows();
    }
}
