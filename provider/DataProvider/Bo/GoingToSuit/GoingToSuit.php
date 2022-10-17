<?php

namespace Api\DataProvider\Bo\GoingToSuit;

use Api\Input\Request\Horses\GoingToSuit as Request;
use Api\Constants\Horses as Constants;

/**
 * Class GoingToSuit
 *
 * @package Api\DataProvider\Bo\GoingToSuit
 */
class GoingToSuit extends \Phalcon\Mvc\DataProvider
{
    const NO_ODDS_DESCRIPTION = 'No Odds';

    /**
     * @param Request\Index $request
     *
     * @return mixed
     */
    public function getHorsesByRaceId(Request\Index $request)
    {
        $sql = "
            SELECT
                ri.race_instance_uid,
                ri.race_instance_title,
                ri.race_datetime,
                ri.race_status_code,
                ri.going_type_code,
                ri.distance_yard,
                ri.race_type_code,
                going_type_desc = (
                    SELECT gt.going_type_desc
                    FROM going_type gt
                    WHERE gt.going_type_code = ri.going_type_code
                ),
                no_of_runners = CASE
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_CALENDAR . "
                        THEN ISNULL(rif.forfeit_number, pri.no_of_runners)
                    WHEN pri.race_status_code IN (" . Constants::RACE_STATUS_6DAYS . "," . Constants::RACE_STATUS_5DAYS
            . "," . Constants::RACE_STATUS_4DAYS . "," . Constants::RACE_STATUS_3DAYS . ") 
                        THEN ISNULL(pric.rp_confirmed, pri.no_of_runners)
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " 
                        THEN (
                            SELECT
                                COUNT(*)
                            FROM
                                pre_horse_race phr
                            WHERE phr.race_instance_uid = :raceId
                                AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                AND ISNULL(phr.doubtful_runner, 'N') != 'Y'
                                AND ISNULL(phr.non_runner, 'N') != 'Y'
                                AND ISNULL(phr.irish_reserve_yn, 'N') != 'Y'
                        )
                    ELSE pri.no_of_runners
                END,
                rg.race_group_code,
                rg.race_group_desc,
                perform_race_uid_atr = (
                    SELECT MAX(perform_race_uid)
                    FROM perform_race
                    WHERE race_instance_uid = ri.race_instance_uid
                        AND isATR = 1
                ),
                perform_race_uid_ruk = (
                    SELECT MAX(perform_race_uid)
                    FROM perform_race
                    WHERE race_instance_uid = ri.race_instance_uid
                    AND isATR IS NULL
                ),
                c.country_code,
                c.course_uid,
                course_style_name = c.style_name,
                c.course_name,
                h.horse_uid,
                horse_style_name = h.style_name,
                h.horse_name,
                sire_uid = s.horse_uid,
                sire_style_name = s.style_name,
                sire_country = s.country_origin_code,
                j.jockey_uid,
                jockey_style_name = j.style_name,
                t.trainer_uid,
                trainer_style_name = t.style_name,
                o.owner_uid,
                owner_style_name = o.style_name,
                phr.non_runner,
                phr.draw,
                pd.num_topspeed_best_rating rp_topspeed,
                phr.rp_postmark,
                phr.rp_owner_choice,
                phr.saddle_cloth_no start_number,
                going_form = NULL,
                declared_runners = 
                    CASE 
                        WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " 
                        THEN pri.no_of_runners
                    END
            FROM race_instance ri
                INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                INNER JOIN horse hsire ON hsire.horse_uid = h.sire_uid
                INNER JOIN horse hdam ON hdam.horse_uid = h.dam_uid
                INNER JOIN course c ON c.course_uid = ri.course_uid
                LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
                LEFT JOIN pre_rfu_horse_stats prhs ON prhs.race_instance_uid = ri.race_instance_uid AND prhs.horse_uid = phr.horse_uid
                LEFT JOIN postdata_results_new pd ON pd.race_instance_uid = phr.race_instance_uid AND pd.horse_uid = phr.horse_uid
                LEFT JOIN pre_horse_race_genlkup phrg ON phrg.race_instance_uid = ri.race_instance_uid AND phrg.horse_uid = phr.horse_uid
                LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid AND
                    ho.owner_change_date = isnull((
                            SELECT MIN(hoi.owner_change_date)
                            FROM horse_owner hoi
                            WHERE hoi.horse_uid = ho.horse_uid
                                AND hoi.owner_change_date >= ri.race_datetime
                            ), CONVERT(DATETIME, '" . Constants::EMPTY_DATE . "')
                    )
                LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
                LEFT JOIN odds odf ON (phr.forecast_sp_uid = odf.odds_uid
                    AND odf.odds_desc != '" . self::NO_ODDS_DESCRIPTION . "')
                LEFT JOIN horse_trainer ht ON ht.horse_uid = phr.horse_uid
                    AND ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                LEFT JOIN horse s ON s.horse_uid = h.sire_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
                LEFT JOIN race_instance_forfeit rif
                    ON rif.race_instance_uid = ri.race_instance_uid
                        AND rif.stage = (
                            SELECT MAX(stage)
                            FROM race_instance_forfeit rif2
                            WHERE rif2.race_instance_uid = ri.race_instance_uid
                        )
            WHERE phr.race_status_code =
                (CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                    ELSE ri.race_status_code
                END)
                AND ri.race_instance_uid = :raceId
                AND CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    THEN '-1'
                    ELSE CASE
                        WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                        THEN '0' ELSE pri.race_status_code
                    END 
                END = (
                    SELECT MIN(
                        CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " 
                            THEN '-1' 
                            ELSE CASE
                                WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                THEN '0'
                                ELSE ipri.race_status_code
                            END
                        END)
                    FROM pre_race_instance ipri
                    WHERE ipri.race_instance_uid = ri.race_instance_uid
                    GROUP BY ipri.race_instance_uid
                    )
            ORDER BY phr.saddle_cloth_no, h.style_name
            PLAN '(nested (nl_join (i_scan ri) (i_scan c) (i_scan phr) (i_scan h)) (subq (i_scan hoi) ))'
        ";

        $result = $this->query($sql, ['raceId' => $request->getRaceId()]);
        $dataSet = $result->getGroupedResult(
            [
                'race_instance_uid',
                'race_instance_title',
                'race_datetime',
                'race_status_code',
                'going_type_code',
                'going_type_desc',
                'distance_yard',
                'race_type_code',
                'race_group_code',
                'race_group_desc',
                'perform_race_uid_atr',
                'perform_race_uid_ruk',
                'no_of_runners',
                'country_code',
                'course_uid',
                'course_name',
                'course_style_name',
                'declared_runners',
                'horses' => [
                    'horse_uid',
                    'horse_style_name',
                    'horse_name',
                    'sire_uid',
                    'sire_style_name',
                    'sire_country',
                    'jockey_uid',
                    'jockey_style_name',
                    'trainer_uid',
                    'trainer_style_name',
                    'owner_uid',
                    'owner_style_name',
                    'non_runner',
                    'draw',
                    'rp_topspeed',
                    'rp_postmark',
                    'rp_owner_choice',
                    'start_number',
                    'going_form',
                ]
            ]
        );

        return current($dataSet);
    }
}
